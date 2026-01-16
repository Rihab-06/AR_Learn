<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAnswersTable extends Migration
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
            'attempt_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'question_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'answer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'is_correct' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'answered_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('attempt_id');
        
        $this->forge->addForeignKey('attempt_id', 'user_quiz_attempts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('question_id', 'questions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('answer_id', 'answers', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('user_answers', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('user_answers');
    }
}