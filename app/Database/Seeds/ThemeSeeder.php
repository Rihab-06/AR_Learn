<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        // ✅ Récupérer les IDs des catégories depuis la base
        $mathematiques = $this->db->table('categories')->where('slug', 'mathematiques')->get()->getRow();
        $developpementWeb = $this->db->table('categories')->where('slug', 'developpement-web')->get()->getRow();
        $espagnol = $this->db->table('categories')->where('slug', 'espagnol')->get()->getRow();
        
        // Vérifier que les catégories existent
        if (!$mathematiques || !$developpementWeb || !$espagnol) {
            throw new \RuntimeException('Les catégories nécessaires n\'existent pas. Exécutez CategorieSeeder d\'abord.');
        }
        
        $data = [
            // Thèmes pour Mathématiques
            [
                'id_categorie' => $mathematiques->id_categorie,
                'name' => 'Algèbre Niveau 1',
                'slug' => 'algebre-niveau-1',
                'icon' => '🔢',
                'description' => 'Équations, inéquations et fonctions de base',
                'difficulty' => 'facile',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_categorie' => $mathematiques->id_categorie,
                'name' => 'Géométrie',
                'slug' => 'geometrie',
                'icon' => '📐',
                'description' => 'Triangles, cercles, aires et volumes',
                'difficulty' => 'moyen',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_categorie' => $mathematiques->id_categorie,
                'name' => 'Statistiques',
                'slug' => 'statistiques',
                'icon' => '📊',
                'description' => 'Moyennes, médianes, probabilités',
                'difficulty' => 'difficile',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Thèmes pour Développement Web
            [
                'id_categorie' => $developpementWeb->id_categorie,
                'name' => 'PHP Fondamentaux',
                'slug' => 'php-fondamentaux',
                'icon' => '🐘',
                'description' => 'Variables, boucles, fonctions en PHP',
                'difficulty' => 'facile',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_categorie' => $developpementWeb->id_categorie,
                'name' => 'JavaScript ES6+',
                'slug' => 'javascript-es6',
                'icon' => '⚡',
                'description' => 'Arrow functions, Promises, async/await',
                'difficulty' => 'moyen',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_categorie' => $developpementWeb->id_categorie,
                'name' => 'HTML5 & CSS3',
                'slug' => 'html5-css3',
                'icon' => '🎨',
                'description' => 'Structure HTML moderne et stylisation CSS',
                'difficulty' => 'facile',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Thèmes pour Espagnol
            [
                'id_categorie' => $espagnol->id_categorie,
                'name' => 'Espagnol Débutant',
                'slug' => 'espagnol-debutant',
                'icon' => '🇪🇸',
                'description' => 'Vocabulaire de base et phrases courantes',
                'difficulty' => 'facile',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_categorie' => $espagnol->id_categorie,
                'name' => 'Conjugaison Espagnole',
                'slug' => 'conjugaison-espagnole',
                'icon' => '📖',
                'description' => 'Présent, passé, futur et subjonctif',
                'difficulty' => 'moyen',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('themes')->insertBatch($data);
    }
}