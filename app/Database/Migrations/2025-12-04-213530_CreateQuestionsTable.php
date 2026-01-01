<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_question' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'test_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'texte_question' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'explication' => [
                'type' => 'TEXT',
                'comment' => 'Explication de la bonne reponse ',
                'null' => true,
            ],
            'point' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
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
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_question', true);
        $this->forge->addKey('test_id');
        $this->forge->addForeignKey(
            'test_id', //colonne locale 
            'tests', // la table de reference 
            'id_test',  //la colonne de reference 
            'CASCADE', // action on delete 
            'CASCADE' // action on update 
        );
        $this->forge->createTable('questions');

    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}
