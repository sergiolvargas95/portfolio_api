<?php
declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\AuthUserDTO;
use App\DTO\User\UserDTO;
use App\Factories\User\UserFactory;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function registerUser(AuthUserDTO $dto) {
        $user = UserFactory::createFromDTO($dto);

        $user = $this->userRepository->save($user);

        $token = $this->createToken($user);

        $userDto = UserDTO::fromModel($user);

        return [
            'user' => $userDto,
            'token' => $token
        ];
    }

    public function loginUser(string $email, string $password):array {
        if(!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new \Exception('Email or Password do not match with our records');
        }

        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $token = $this->createToken($user);

        $userDto = UserDTO::fromModel($user);

        return [
            'user' => $userDto,
            'token' => $token
        ];
    }

    private function createToken(User $user): string {
        return $user->createToken("API TOKEN")->plainTextToken;
    }
}
