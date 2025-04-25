<?php
declare(strict_types=1);

namespace App\Interfaces\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function save(User $user): User;
    public function findByEmail(string $email): ?User;
}
