<?php
declare(strict_types=1);

namespace App\DTO\User;

use App\Models\User;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {}

    public static function fromModel(User $user): self {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }
}
