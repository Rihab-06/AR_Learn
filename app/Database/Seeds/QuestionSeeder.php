<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Questions pour les quizzes
        $questionsData = [
            // Quiz 1 - Algèbre
            ['quiz_id' => 1, 'question_text' => 'Quel est le résultat de 2 + 2 ?', 'order_num' => 1],
            ['quiz_id' => 1, 'question_text' => 'Quel est le carré de 5 ?', 'order_num' => 2],
            ['quiz_id' => 1, 'question_text' => 'Résoudre : x + 3 = 7', 'order_num' => 3],
            ['quiz_id' => 1, 'question_text' => 'Quel est le résultat de 10 - 3 ?', 'order_num' => 4],
            
            // Quiz 2 - PHP
            ['quiz_id' => 2, 'question_text' => 'Quel est le symbole pour commencer une variable en PHP ?', 'order_num' => 1],
            ['quiz_id' => 2, 'question_text' => 'Quelle fonction affiche du contenu en PHP ?', 'order_num' => 2],
            ['quiz_id' => 2, 'question_text' => 'Quel est le type de donnée pour un nombre décimal en PHP ?', 'order_num' => 3],
            ['quiz_id' => 2, 'question_text' => 'Comment déclarer un tableau en PHP ?', 'order_num' => 4],
            
            // Quiz 3 - Español
            ['quiz_id' => 3, 'question_text' => '¿Cómo se dice "bonjour" en español?', 'order_num' => 1],
            ['quiz_id' => 3, 'question_text' => '¿Cuál es el verbo "ser" en primera persona?', 'order_num' => 2],
            ['quiz_id' => 3, 'question_text' => '¿Cómo se dice "au revoir" en español?', 'order_num' => 3],
            ['quiz_id' => 3, 'question_text' => '¿Qué significa "Gracias"?', 'order_num' => 4],
            
            // Quiz 4 - Géométrie
            ['quiz_id' => 4, 'question_text' => 'Quelle est la formule de l\'aire d\'un cercle ?', 'order_num' => 1],
            ['quiz_id' => 4, 'question_text' => 'Combien de degrés dans un triangle ?', 'order_num' => 2],
            ['quiz_id' => 4, 'question_text' => 'Quelle est la formule du volume d\'un cube ?', 'order_num' => 3],
            
            // Quiz 5 - JavaScript
            ['quiz_id' => 5, 'question_text' => 'Comment déclarer une constante en JS ?', 'order_num' => 1],
            ['quiz_id' => 5, 'question_text' => 'Quelle méthode ajoute un élément à un tableau ?', 'order_num' => 2],
            ['quiz_id' => 5, 'question_text' => 'Comment créer une arrow function ?', 'order_num' => 3],
        ];
        
        $this->db->table('questions')->insertBatch($questionsData);
        
        // Réponses pour les questions
        $answersData = [
            // Q1 - 2+2
            ['question_id' => 1, 'answer_text' => '4', 'is_correct' => 1],
            ['question_id' => 1, 'answer_text' => '3', 'is_correct' => 0],
            ['question_id' => 1, 'answer_text' => '5', 'is_correct' => 0],
            
            // Q2 - 5²
            ['question_id' => 2, 'answer_text' => '25', 'is_correct' => 1],
            ['question_id' => 2, 'answer_text' => '20', 'is_correct' => 0],
            ['question_id' => 2, 'answer_text' => '15', 'is_correct' => 0],
            
            // Q3 - x+3=7
            ['question_id' => 3, 'answer_text' => 'x = 4', 'is_correct' => 1],
            ['question_id' => 3, 'answer_text' => 'x = 10', 'is_correct' => 0],
            ['question_id' => 3, 'answer_text' => 'x = 3', 'is_correct' => 0],
            
            // Q4 - 10-3
            ['question_id' => 4, 'answer_text' => '7', 'is_correct' => 1],
            ['question_id' => 4, 'answer_text' => '6', 'is_correct' => 0],
            ['question_id' => 4, 'answer_text' => '8', 'is_correct' => 0],
            
            // Q5 - PHP symbole
            ['question_id' => 5, 'answer_text' => '$', 'is_correct' => 1],
            ['question_id' => 5, 'answer_text' => '@', 'is_correct' => 0],
            ['question_id' => 5, 'answer_text' => '#', 'is_correct' => 0],
            
            // Q6 - PHP affiche
            ['question_id' => 6, 'answer_text' => 'echo', 'is_correct' => 1],
            ['question_id' => 6, 'answer_text' => 'print_r', 'is_correct' => 0],
            ['question_id' => 6, 'answer_text' => 'log', 'is_correct' => 0],
            
            // Q7 - PHP float
            ['question_id' => 7, 'answer_text' => 'float', 'is_correct' => 1],
            ['question_id' => 7, 'answer_text' => 'integer', 'is_correct' => 0],
            ['question_id' => 7, 'answer_text' => 'string', 'is_correct' => 0],
            
            // Q8 - PHP tableau
            ['question_id' => 8, 'answer_text' => 'array()', 'is_correct' => 1],
            ['question_id' => 8, 'answer_text' => 'list()', 'is_correct' => 0],
            ['question_id' => 8, 'answer_text' => 'table()', 'is_correct' => 0],
            
            // Q9 - Español hola
            ['question_id' => 9, 'answer_text' => 'Hola', 'is_correct' => 1],
            ['question_id' => 9, 'answer_text' => 'Adiós', 'is_correct' => 0],
            ['question_id' => 9, 'answer_text' => 'Buenos días', 'is_correct' => 0],
            
            // Q10 - Español ser
            ['question_id' => 10, 'answer_text' => 'Soy', 'is_correct' => 1],
            ['question_id' => 10, 'answer_text' => 'Eres', 'is_correct' => 0],
            ['question_id' => 10, 'answer_text' => 'Es', 'is_correct' => 0],
            
            // Q11 - Español adiós
            ['question_id' => 11, 'answer_text' => 'Adiós', 'is_correct' => 1],
            ['question_id' => 11, 'answer_text' => 'Hasta luego', 'is_correct' => 0],
            ['question_id' => 11, 'answer_text' => 'Buenas noches', 'is_correct' => 0],
            
            // Q12 - Gracias
            ['question_id' => 12, 'answer_text' => 'Merci', 'is_correct' => 1],
            ['question_id' => 12, 'answer_text' => 'S\'il vous plaît', 'is_correct' => 0],
            ['question_id' => 12, 'answer_text' => 'De rien', 'is_correct' => 0],
            
            // Q13 - Aire cercle
            ['question_id' => 13, 'answer_text' => 'π × r²', 'is_correct' => 1],
            ['question_id' => 13, 'answer_text' => '2πr', 'is_correct' => 0],
            ['question_id' => 13, 'answer_text' => 'πr', 'is_correct' => 0],
            
            // Q14 - Triangle degrés
            ['question_id' => 14, 'answer_text' => '180°', 'is_correct' => 1],
            ['question_id' => 14, 'answer_text' => '360°', 'is_correct' => 0],
            ['question_id' => 14, 'answer_text' => '90°', 'is_correct' => 0],
            
            // Q15 - Volume cube
            ['question_id' => 15, 'answer_text' => 'a³', 'is_correct' => 1],
            ['question_id' => 15, 'answer_text' => 'a²', 'is_correct' => 0],
            ['question_id' => 15, 'answer_text' => '6a²', 'is_correct' => 0],
            
            // Q16 - JS const
            ['question_id' => 16, 'answer_text' => 'const', 'is_correct' => 1],
            ['question_id' => 16, 'answer_text' => 'var', 'is_correct' => 0],
            ['question_id' => 16, 'answer_text' => 'let', 'is_correct' => 0],
            
            // Q17 - JS push
            ['question_id' => 17, 'answer_text' => 'push()', 'is_correct' => 1],
            ['question_id' => 17, 'answer_text' => 'add()', 'is_correct' => 0],
            ['question_id' => 17, 'answer_text' => 'append()', 'is_correct' => 0],
            
            // Q18 - Arrow function
            ['question_id' => 18, 'answer_text' => '() => {}', 'is_correct' => 1],
            ['question_id' => 18, 'answer_text' => 'function() {}', 'is_correct' => 0],
            ['question_id' => 18, 'answer_text' => 'func() {}', 'is_correct' => 0],
        ];
        
        $this->db->table('answers')->insertBatch($answersData);
    }
}