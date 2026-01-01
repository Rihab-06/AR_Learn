<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReponsesUtilisateursTable extends Migration
{
    public function up()
    {
        $this->forge->addField ([
            'id_reponse_utilisateur' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,   
            ],
            'historique_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'question_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'option_choisie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'est_correcte' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'temps_passee' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'comment' => 'Temps passe en secondes',
            ],
            'date_reponse' => [
                'type' => 'DATETIME',
                'null' => false,
                
            ],
    
            ]);
            $this->forge->addKey('id_reponse_utilisateur', true);
            $this->forge->addKey('historique_id');
            $this->forge->addKey('question_id');
            $this->forge->addForeignKey(
                'historique_id',
                'historiques',
                'id_historique',
                'CASCADE',
                'CASCADE'
            );
            $this->forge->addForeignKey(
                'question_id',
                'questions',
                'id_question',
                'CASCADE',
                'CASCADE'
            );
            $this->forge->addForeignKey(
                'option_choisie_id',
                'options_reponses',
                'id_option_reponse',
                'CASCADE',
                'CASCADE'
            );
            $this->forge->createTable('reponses_utilisateurs');
    }

    


    public function down()
    {
        $this->forge->dropTable('reponses_utilisateurs');
    }
}
