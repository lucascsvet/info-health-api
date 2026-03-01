<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BloodTypeRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BloodTypeController extends Controller
{
    private $bloodTypeRepository;

    public function __construct(
        BloodTypeRepositoryInterface $bloodTypeRepository
    ) {
        $this->bloodTypeRepository = $bloodTypeRepository;
    }

    public function all(): JsonResponse
    {
        return response()->json($this->bloodTypeRepository->all());
    }
}
