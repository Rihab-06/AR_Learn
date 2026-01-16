<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserQuizAttemptsTable extends Migration
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
            'id_utilisateur' => [  // ✅ CHANGÉ : user_id → id_utilisateur
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'quiz_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'score' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'total_questions' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0.00,
            ],
            'started_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'completed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        // Clé primaire
        $this->forge->addKey('id', true);
        
        // Index
        $this->forge->addKey('id_utilisateur');  // ✅ CHANGÉ
        $this->forge->addKey('quiz_id');
        
        // Clés étrangères
        $this->forge->addForeignKey('id_utilisateur', 'utilisateurs', 'id_utilisateur', 'CASCADE', 'CASCADE');  // ✅ CHANGÉ
        $this->forge->addForeignKey('quiz_id', 'quizzes', 'id', 'CASCADE', 'CASCADE');
        
        // Créer la table
        $this->forge->createTable('user_quiz_attempts', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('user_quiz_attempts');
    }
}