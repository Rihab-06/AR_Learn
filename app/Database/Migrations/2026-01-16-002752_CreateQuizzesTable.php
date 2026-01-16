<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
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
            'theme_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'id_utilisateur' => [  // ✅ CHANGÉ : user_id → id_utilisateur
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_published' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
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
        $this->forge->addKey('theme_id');
        $this->forge->addKey('id_utilisateur');  // ✅ CHANGÉ
        
        // Clés étrangères
        $this->forge->addForeignKey('theme_id', 'themes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_utilisateur', 'utilisateurs', 'id_utilisateur', 'CASCADE', 'CASCADE');  // ✅ CHANGÉ
        
        // Créer la table
        $this->forge->createTable('quizzes', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('quizzes');
    }
}