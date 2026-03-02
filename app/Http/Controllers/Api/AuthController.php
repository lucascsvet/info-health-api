<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PublicLoginRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $authService;
    private $userRepository;

    public function __construct(
        AuthService $authService,
        UserRepositoryInterface $userRepository
    ) {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login(
                $request->validated('email'),
                $request->validated('password')
            );

            return response()->json([
                'user' => $result['user'],
                'token' => $result['token'],
                'token_type' => $result['token_type'],
                'is_public_login' => false,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'As credenciais informadas não correspondem aos nossos registros.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Erro interno do servidor. Tente novamente.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function userExists(int $id): JsonResponse
    {
        if (!$this->userRepository->exists($id)) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        return response()->json(['exists' => true]);
    }

    public function publicLogin(PublicLoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->publicLogin(
                (int) $request->validated('user_id'),
                $request->validated('public_password')
            );

            return response()->json([
                'user' => $result['user'],
                'token' => $result['token'],
                'token_type' => $result['token_type'],
                'is_public_login' => true,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'A senha pública informada não está correta.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Erro interno do servidor. Tente novamente.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function user(Request $request): JsonResponse
    {
        $user = $this->userRepository->findById($request->user()->id);
        $isPublicLogin = $request->user()->currentAccessToken()->name === 'auth-public-token';

        if (!$isPublicLogin) {
            $user->makeVisible('public_password');
        }

        $data = $user->toArray();
        $data['is_public_login'] = $isPublicLogin;

        return response()->json($data);
    }
}
