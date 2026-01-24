<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Ordre d'exécution important !
        $this->call('UtilisateurSeeder');    // 1. Utilisateurs d'abord
        $this->call('CategorieSeeder');       // 2. Categories
        $this->call('ThemeSeeder');           // 3. Themes (dépend de categories)
        $this->call('QuizSeeder');            // 4. Quizzes (dépend de themes et utilisateurs)
        $this->call('QuestionSeeder');        // 5. Questions et Answers (dépend de quizzes)
    }
}