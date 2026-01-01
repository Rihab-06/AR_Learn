<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_test' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'titre' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',  
            ],
            // cle etrangere vers la table categories
            'categorie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'createur_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'duree_minutes' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'num_questions' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'difficulty_level' => [
                'type' => 'ENUM',
                'constraint' => ['easy', 'medium', 'hard'],
                'default' => 'medium',
            ],
            'melange_questions' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'afficher_correction' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'actif' => [
                'type' => 'BOOLEAN',
                'default' => true,
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
        $this->forge->addKey('id_test', true);
        //Les indexes pour les cles etrangeres
        $this->forge->addKey('categorie_id');
        $this->forge->addKey('createur_id');
        //Les contraintes pour les cles etrangeres
        $this->forge->addForeignKey(
            'categorie_id', //colonne locale 
            'categories',   //Table de reference 
            'id_categorie', //colonne de reference
            //Si la ligne parent est supprimée/modifiée, les lignes enfants sont aussi supprimées/modifiées
            'CASCADE',  // action on delete
            'CASCADE'   // action on update
        );
        $this->forge->addForeignKey(
            'createur_id', 
            'utilisateurs', 
            'id_utilisateur', 
            'CASCADE', 
            'CASCADE'
        );
        $this->forge->createTable('tests', true);

    }

    public function down()
    {
        $this->forge->dropTable('tests');
    }
}
