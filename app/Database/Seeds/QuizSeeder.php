<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // ✅ Récupérer les IDs des thèmes depuis la base
        $algebre = $this->db->table('themes')->where('slug', 'algebre-niveau-1')->get()->getRow();
        $php = $this->db->table('themes')->where('slug', 'php-fondamentaux')->get()->getRow();
        $espagnol = $this->db->table('themes')->where('slug', 'espagnol-debutant')->get()->getRow();
        $geometrie = $this->db->table('themes')->where('slug', 'geometrie')->get()->getRow();
        $javascript = $this->db->table('themes')->where('slug', 'javascript-es6')->get()->getRow();
        
        // ✅ Récupérer l'ID de l'admin
        $admin = $this->db->table('utilisateurs')->where('role', 'admin')->get()->getRow();
        
        // Vérifier que tout existe
        if (!$algebre || !$php || !$espagnol || !$geometrie || !$javascript || !$admin) {
            throw new \RuntimeException('Les thèmes ou utilisateur admin n\'existent pas. Exécutez les seeders précédents d\'abord.');
        }
        
        $data = [
            // Quiz pour Algèbre
            [
                'theme_id' => $algebre->id,
                'id_utilisateur' => $admin->id_utilisateur,
                'title' => 'Quiz Algèbre Niveau 1',
                'description' => 'Testez vos connaissances en algèbre de base',
                'is_published' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Quiz pour PHP
            [
                'theme_id' => $php->id,
                'id_utilisateur' => $admin->id_utilisateur,
                'title' => 'Quiz PHP Fondamentaux',
                'description' => 'Maîtrisez les bases de PHP',
                'is_published' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Quiz pour Espagnol
            [
                'theme_id' => $espagnol->id,
                'id_utilisateur' => $admin->id_utilisateur,
                'title' => 'Quiz Espagnol Débutant',
                'description' => 'Vocabulaire et phrases de base en espagnol',
                'is_published' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Quiz pour Géométrie
            [
                'theme_id' => $geometrie->id,
                'id_utilisateur' => $admin->id_utilisateur,
                'title' => 'Quiz Géométrie',
                'description' => 'Aires, volumes et théorèmes géométriques',
                'is_published' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Quiz pour JavaScript
            [
                'theme_id' => $javascript->id,
                'id_utilisateur' => $admin->id_utilisateur,
                'title' => 'Quiz JavaScript ES6',
                'description' => 'Fonctionnalités modernes de JavaScript',
                'is_published' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('quizzes')->insertBatch($data);
    }
}