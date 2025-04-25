<?php
declare(strict_types=1);

namespace App\Interfaces\User;

interface UserDTOInterface
{
    public static function fromRequest($request): self;
}
