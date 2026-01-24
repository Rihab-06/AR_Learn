<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        // ✅ ÉTAPE 1 : Insérer les catégories PARENTES d'abord (parent_id = NULL)
        $categoriesParentes = [
            [
                'nom' => 'Sciences',
                'slug' => 'sciences',
                'icon' => '🔬',
                'color' => '#4A90E2',
                'explication' => 'Découvrez les mystères de la nature et de l\'univers',
                'parent_id' => null,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Informatique',
                'slug' => 'informatique',
                'icon' => '💻',
                'color' => '#00B894',
                'explication' => 'Programmation, réseaux, bases de données',
                'parent_id' => null,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Langues',
                'slug' => 'langues',
                'icon' => '🌍',
                'color' => '#A29BFE',
                'explication' => 'Apprenez de nouvelles langues du monde entier',
                'parent_id' => null,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('categories')->insertBatch($categoriesParentes);
        
        // ✅ ÉTAPE 2 : Récupérer les IDs des catégories parentes
        $sciences = $this->db->table('categories')->where('slug', 'sciences')->get()->getRow();
        $informatique = $this->db->table('categories')->where('slug', 'informatique')->get()->getRow();
        $langues = $this->db->table('categories')->where('slug', 'langues')->get()->getRow();
        
        // ✅ ÉTAPE 3 : Insérer les sous-catégories avec les bons parent_id
        $sousCategories = [
            // Sous-catégories de Sciences
            [
                'nom' => 'Mathématiques',
                'slug' => 'mathematiques',
                'icon' => '📐',
                'color' => '#E94B3C',
                'explication' => 'Algèbre, géométrie, statistiques et calculs',
                'parent_id' => $sciences->id_categorie,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Physique',
                'slug' => 'physique',
                'icon' => '⚛️',
                'color' => '#6C5CE7',
                'explication' => 'Mécanique, électricité, thermodynamique',
                'parent_id' => $sciences->id_categorie,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Sous-catégories d'Informatique
            [
                'nom' => 'Développement Web',
                'slug' => 'developpement-web',
                'icon' => '🌐',
                'color' => '#FDCB6E',
                'explication' => 'HTML, CSS, JavaScript, PHP, frameworks',
                'parent_id' => $informatique->id_categorie,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Sous-catégories de Langues
            [
                'nom' => 'Espagnol',
                'slug' => 'espagnol',
                'icon' => '🇪🇸',
                'color' => '#FFA502',
                'explication' => 'Vocabulaire, grammaire et culture espagnole',
                'parent_id' => $langues->id_categorie,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Anglais',
                'slug' => 'anglais',
                'icon' => '🇬🇧',
                'color' => '#0984E3',
                'explication' => 'Grammaire, vocabulaire et conversation anglaise',
                'parent_id' => $langues->id_categorie,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('categories')->insertBatch($sousCategories);
    }
}