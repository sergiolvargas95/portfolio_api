<?php

namespace App\Http\Controllers;

use App\DTO\User\AuthUserDTO;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $service
    ) {}

    public function registerUser(RegisterUserRequest $request): JsonResponse {
        try {
            $dto = AuthUserDTO::fromRequest($request);
            $response = $this->service->registerUser($dto);

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'user' => $response['user']
            ], 201)->header('Authorization', 'Bearer ' . $response['token']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function loginUser(LoginUserRequest $request): JsonResponse {
        try {
            $result = $this->service->loginUser(
                $request->email,
                $request->password
            );

            return response()->json([
                'status' => true,
                'message' => 'User logged in Successfully',
                'user' => $result['user']
            ], 200)->header('Authorization', 'Bearer ' . $result['token']);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
