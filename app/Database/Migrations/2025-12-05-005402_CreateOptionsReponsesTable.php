<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOptionsReponsesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_option_reponse' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'question_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'texte_option' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'est_correcte' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'ordre' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            
        ]);
        $this->forge->addKey('id_option_reponse', true);
        $this->forge->addKey('question_id');
        $this->forge->addForeignKey(
            'question_id', //colonne locale
            'questions', // la table de reference
            'id_question',  //la colonne de reference
            'CASCADE', // action on delete
            'CASCADE' // action on update
        );
        $this->forge->createTable('options_reponses');
    }

    public function down()
    {
        $this->forge->dropTable('options_reponses');
    }
}
