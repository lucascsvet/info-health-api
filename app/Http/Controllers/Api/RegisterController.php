<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\AuthService;
use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    private $registerService;
    private $authService;

    public function __construct(
        RegisterService $registerService,
        AuthService $authService
    ) {
        $this->registerService = $registerService;
        $this->authService = $authService;
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        if ($request->user()->currentAccessToken()->name === 'auth-public-token') {
            return response()->json(['message' => 'Acesso negado.'], 403);
        }

        $user = $this->registerService->update($request->user(), $request->validated());

        $user->makeVisible('public_password');

        $data = $user->toArray();
        $data['is_public_login'] = false;

        return response()->json($data);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->registerService->register($request->validated());

        $result = $this->authService->login(
            $request->validated('email'),
            $request->validated('password')
        );

        return response()->json([
            'user' => $result['user'],
            'token' => $result['token'],
            'token_type' => $result['token_type'],
        ], 201);
    }
}
