<?php

namespace App\Domain\User\Data;

/**
 * Data Model.
 */
final class UserData
{
    public ?int $id_usu = null;

    public ?string $nombres = null;


    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $this->id_usu = isset($data['id_usu']) ? $data['id_usu'] : null;
        $this->nombres = isset($data['nombres']) ? $data['nombres'] : null;
    }
}
