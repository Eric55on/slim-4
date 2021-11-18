<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;


interface UserRepositoryInterface
{
    public function getAll();
    
    public function getById(int $userId);

    public function add(UserData $user);
}