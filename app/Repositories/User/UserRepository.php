<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): User {
        if(!$user->save()) {
            throw new \Exception('the user could not be created');
        }
        return $user;
    }

    public function findByEmail(string $email): User {
        return User::Where('email', $email)->first();
    }
}
