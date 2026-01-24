<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateThemesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_categorie' => [ 
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => '📖',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'difficulty' => [
                'type' => 'ENUM',
                'constraint' => ['facile', 'moyen', 'difficile'],
                'default' => 'moyen',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        // Clé primaire
        $this->forge->addKey('id', true);
        
        // Index
        $this->forge->addKey('id_categorie');  // ✅ CHANGÉ
        $this->forge->addKey('slug');
        
        // Clé étrangère
        $this->forge->addForeignKey('id_categorie', 'categories', 'id_categorie', 'CASCADE', 'CASCADE');  // ✅ CHANGÉ
        
        // Créer la table
        $this->forge->createTable('themes', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('themes');
    }
}