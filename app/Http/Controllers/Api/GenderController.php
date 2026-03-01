<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GenderRepositoryInterface;
use Illuminate\Http\JsonResponse;

class GenderController extends Controller
{
    private $genderRepository;

    public function __construct(
        GenderRepositoryInterface $genderRepository
    ) {
        $this->genderRepository = $genderRepository;
    }

    public function all(): JsonResponse
    {
        return response()->json($this->genderRepository->all());
    }
}
