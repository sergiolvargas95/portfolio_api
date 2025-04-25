<?php
declare(strict_types=1);

namespace App\DTO\User;

use App\Interfaces\User\UserDTOInterface;

class AuthUserDTO implements UserDTOInterface
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function fromRequest($request): self {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );
    }
}
