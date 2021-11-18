<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use Illuminate\Database\Connection;

use DomainException;


/**
 * Repository.
 */
final class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Connection
     */
    protected $connection;


    protected $userModel;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll() : array
    {
        $rows = $this->connection->table('usuarios')->get()->toArray();
    
        if(!$rows) {
            throw new \DomainException(sprintf('Users not found'));
        }       
    
        return $rows;

    }

    public function getById(int $userId) : UserData
    {
        $row = $this->connection->table('usuarios')->where('id_usu', $userId)->first();
        // $row = $this->connection->select("SELECT * FROM usuarios WHERE id_usu = $userId");

        if(empty($row)) {
            throw new DomainException(sprintf('User not found: %s', $userId));
        }       
    
        return new UserData($row);
    }

    /**
     * Check user id.
     *
     * @param int $userId The user id
     *
     * @return bool True if exists
     */
    public function existsUserId(int $userId): bool
    {
        $row = $this->connection->table('usuarios')->where('id_usu', $userId)->first();
        
        return (bool) (isset($row['id_usu']) ? true : false);
    }

    /**
     * Insert user row.
     *
     * @param UserData $user The user data
     *
     * @return int The new ID
     */
    public function add(UserData $user) : int
    {
        $id = $this->connection->table('usuarios')
        ->insertGetId([
            'nombres' => $user->nombres
        ]);
        
        return (int)$id;
    }

    /**
     * Update user row.
     *
     * @param UserData $user The user
     *
     * @return void
     */
    public function updateUser(UserData $user): void
    {
        $this->connection->table('usuarios')
        ->where('id_usu', $user->id_usu)
        ->update(['nombres' => $user->nombres]);
    }    

    /**
     * Delete user row.
     *
     * @param int $userId The user id
     *
     * @return void
     */
    public function deleteUserById(int $userId): void
    {
        $this->connection->table('usuarios')
        ->where('id_usu', $userId)
        ->delete();
    }    
}