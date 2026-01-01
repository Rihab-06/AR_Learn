<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use COM;

class CreateHistoriquesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_historique' => 
            [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'utilisateur_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'test_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'date_passage' => [
                'type' => 'DATETIME',
                'null' => false,
                
            ],
            'score' => [
                'type' => 'DECIMAL(5,2)',
                'null' => false,
            ],
            'temps_total' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'comment' => 'Temps total en secondes',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['en_cours', 'termine', 'abandonne'],
                'default' => 'en_cours ',
            ],
        ]);
        $this->forge->addKey('id_historique', true);
        $this->forge->addKey('utilisateur_id');
        $this->forge->addKey('test_id');
        $this->forge->addKey('date_passage');
        $this->forge->addForeignKey(
            'utilisateur_id', //colonne locale
            'utilisateurs', // la table de reference
            'id_utilisateur',  //la colonne de reference
            'CASCADE', // action on delete
            'CASCADE' // action on update
        );
        $this->forge->addForeignKey(
            'test_id', //colonne locale 
            'tests',
            'id_test',
            'CASCADE', // action on delete 
            'CASCADE' // action on update 
        );
        $this->forge->createTable('historiques');
    }

    public function down()
    {
        $this->forge->dropTable('historiques');
    }
}
