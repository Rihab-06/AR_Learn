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
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_categorie', true);
        
        $this->forge->addForeignKey('parent_id', 'categories', 'id_categorie', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('categories', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('categories');
    }
}