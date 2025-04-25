<?php
declare(strict_types=1);

namespace App\Factories\User;

use App\Interfaces\User\UserDTOInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory
{
    public static function createFromDTO(UserDTOInterface $dto): User {
        return new User([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password)
        ]);
    }
}
