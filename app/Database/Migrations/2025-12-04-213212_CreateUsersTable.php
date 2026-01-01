<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_utilisateur' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
             'prenom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
             ],
             'date_naissance' => [
                'type' => 'DATE',
                'null' => false,
            ],
             'email' => [
                'type' => 'VARCHAR',
                'constraint' => '120',
                'null' => false,
                
             ],
             'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                ],
             'role' =>[
                'type' => 'ENUM',
                'constraint' =>['admin', 'utilisateur'],
                'default' =>'utilisateur',
             ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                    
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'null' => true,
                    
                ],
             
            ]);
            // Maintenant, on va definir la cle primaire 
            $this->forge->addKey('id_utilisateur',true);
            // ici, on a les indexes
            $this->forge->addKey('email');
            // Maintenant, on cree la table
            $this->forge->createTable('utilisateurs', true);
    }

    public function down()
    {
        $this->forge->dropTable('utilisateurs');
    }
}
