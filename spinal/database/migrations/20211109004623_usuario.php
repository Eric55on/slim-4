<?php

use Phoenix\Migration\AbstractMigration;

class Usuario extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('usuarios', 'id_usu')
        ->setCharset('utf8mb4')
        ->setCollation('utf8mb4_unicode_ci')
        ->addColumn('id_usu', 'integer', ['autoincrement' => true])
        ->addColumn('nombres', 'string', ['null' => true])
        ->create();      

        //Seeding
        $this->insert('usuarios', [
            [
                'id_usu' => 1,
                'nombres' => 'Prueba 1',
            ],
            [
                'id_usu' => 2,
                'nombres' => 'Prueba 2',
            ],
        ]);        
        
    }

    protected function down(): void
    {
        $this->table('usuarios')
            ->drop();
    }
}
