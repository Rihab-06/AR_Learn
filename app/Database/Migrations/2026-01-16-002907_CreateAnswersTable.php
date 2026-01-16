<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnswersTable extends Migration
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
            'question_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'answer_text' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'is_correct' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('question_id');
        
        $this->forge->addForeignKey('question_id', 'questions', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('answers', true);
    }
    
    public function down()
    {
        $this->forge->dropTable('answers');
    }
}