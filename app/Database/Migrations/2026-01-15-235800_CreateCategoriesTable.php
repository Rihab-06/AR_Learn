<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_categorie' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,  
            ],
            'explication' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            // Colonnes ajoutées de la structure MySQL
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => '📚',
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => '#4A70A9',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
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
        
        // Clé primaire
        $this->forge->addKey('id_categorie', true);
        
        // Index sur slug
        $this->forge->addKey('slug');
        
        // Clé étrangère pour parent_id
        $this->forge->addForeignKey('parent_id', 'categories', 'id_categorie', 'CASCADE', 'CASCADE');
        
        // Créer la table
        $this->forge->createTable('categories', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('categories');
    }
}