<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;

/**
 * Service.
 */
final class UserReader
{
    private UserRepository $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user.
     *
     * @param int $userId The user id
     *
     * @return UserData The user data
     */
    public function getAll() : array
    {
        // Input validation
        // ...

        // Fetch data from the database
        $users = $this->repository->getAll();
        
        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $users;
    }


    /**
     * Read a user.
     *
     * @param int $userId The user id
     *
     * @return UserData The user data
     */
    public function getById(int $userId) : UserData
    {
        // Input validation
        // ...

        // Fetch data from the database
        $user = $this->repository->getById($userId);

        // Optional: Add or invoke your complex business logic here
        // ...

        // Optional: Map result
        // ...

        return $user;
    }
}
