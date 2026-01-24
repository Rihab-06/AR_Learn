<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnswerModel;
use App\Models\CategorieModel;
use App\Models\QuestionModel;
use App\Models\UserQuizAttemptModel;
use App\Models\QuizModel;
use App\Models\ThemeModel;
use CodeIgniter\HTTP\ResponseInterface;

class UtilisateurController extends BaseController
{
    public function addCategorie()
    {

        return view('user/gestion-categories/categorie-creation');
    }
        public function storeCategories()
{
    
    // Validation
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]',
        'slug' => 'required|is_unique[categories.slug]|min_length[3]|max_length[50]',
        'explication' => 'min_length[10]|max_length[255]'


    ], [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
        ],
        'slug' => [
            'required' => 'Le slug est obligatoire',
            'min_length' => 'Le slug doit contenir au moins 3 caractères',
            'max_length' => 'Le slug ne peut pas dépasser 50 caractères'
        ],
        'explication' => [
            'min_length' => 'L\'explication doit contenir au moins 10 caractères',
            'max_length' => 'L\'explication ne peut pas dépasser 255 caractères'
        ],
        'icon' => [
            'required' => 'L\'icône est obligatoire'
        ],
        'color' => [
            'required' => 'La couleur est obligatoire'
        ]
    ]);
    
    if (!$validation) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }
    
    
    // Préparer les données
        $data = [
            'nom' => $this->request->getPost('nom'),
            'slug' => $this->request->getPost('slug'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'explication' => $this->request->getPost('explication'),
            'parent_id' => null, 
            'is_active' => 1
        ];
    // Sauvegarde
    $categorieModel = new CategorieModel();
    if ($categorieModel->save($data)) {
        return redirect()->to('/dashboard')->with('success', 'Catégorie créée avec succès.');
    }
    else {
        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la catégorie.');
    }


}

public function viewSousCategories($id)
{
    // Récupérer la session
    $session = session();
    
    // Préparer les modèles
    $sousCategorieModel = new CategorieModel();
    
    
    // Récupérer la catégorie parent (exemple : Sciences)
    $categorieParent = $sousCategorieModel->find($id);
    
    // Récupérer les sous-catégories (exemple : Maths, Physique, Chimie)
    $sousCategories = $sousCategorieModel->where('parent_id', $id)->findAll();
    // Préparer les données pour la vue
    $data = [
        // Infos utilisateur
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        
        // Infos catégories
        'id' => $id,
        'categorieParent' => $categorieParent,
        'sousCategories' => $sousCategories
    ];
    
    // Afficher la vue
    return view('user/gestion-sous-categories/index', $data);
}

    public function addSousCategorie($id){
        $categorieModel = new CategorieModel();
        // les infos de la categorie parente de la sous-categorie 
        // hadi ghadi nkhdmo biha f le button annuler bach nrj3 nchof ga3 les sous-categories dial had l3jb(parent one)
        $data["parentCategory"] = $categorieModel->find($id);
        // hadi ghadi nkhdmo biha bach njib ga3 les categories parents o ndirohom f dak select
        $data["categories"] = $categorieModel->where('parent_id', null)->findAll();
        return view('user/gestion-sous-categories/sous-categorie-creation', $data);
    }
    public function storeSousCategories(){
        
    // Validation
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]',
        'slug' => 'required|is_unique[categories.slug]|min_length[3]|max_length[50]',
        'explication' => 'min_length[10]|max_length[255]'


    ], [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
        ],
        'slug' => [
            'required' => 'Le slug est obligatoire',
            'min_length' => 'Le slug doit contenir au moins 3 caractères',
            'max_length' => 'Le slug ne peut pas dépasser 50 caractères'
        ],
        'explication' => [
            'min_length' => 'L\'explication doit contenir au moins 10 caractères',
            'max_length' => 'L\'explication ne peut pas dépasser 255 caractères'
        ],
        'icon' => [
            'required' => 'L\'icône est obligatoire'
        ],
        'color' => [
            'required' => 'La couleur est obligatoire'
        ]
    ]);
    
    if (!$validation) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }
    
    // Préparation des données
    $parentId = $this->request->getPost('parent_id');
    
    // Préparer les données
        $data = [
            'nom' => $this->request->getPost('nom'),
            'slug' => $this->request->getPost('slug'),
            'icon' => $this->request->getPost('icon'),
            'color' => $this->request->getPost('color'),
            'explication' => $this->request->getPost('explication'),
            'parent_id' => !empty($parentId) ? $parentId : null,
            'is_active' => 1
        ];
    // Sauvegarde
    $categorieModel = new CategorieModel();
    
    if ($categorieModel->save($data)) {
        return redirect()->to('/user/categorie/sous-categorie/' . $data['parent_id'])->with('success', 'Catégorie créée avec succès.');
    }
    else {
        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la catégorie.');
    }}
  public function viewTheme($slug, $id) 
{
    $session = session();
    $themeModel = new ThemeModel();
    $categorieModel = new CategorieModel();

    // ✅ Récupérer la catégorie par ID
    $categorie = $categorieModel->find($id);

    $parentId = $categorie['parent_id'];
    
    // ✅ Vérification de sécurité : catégorie existe + slug correspond
    if (!$categorie) {
        return redirect()->to('/dashboard')->with('error', 'Catégorie introuvable');
    }
    
    // ✅ Récupérer tous les thèmes de cette catégorie
    $themes = $themeModel->where('id_categorie', $id)->findAll();

    // ✅ Préparer les données
    $data = [
        // Infos utilisateur
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        
        // Infos catégorie et thèmes
        'id' => $id,
        'categorie' => $categorie,
        'parentId' => $parentId,
        'themes' => $themes 
    ];
    
    // Afficher la vue
    return view('user/gestion-themes/index', $data);
}
    public function addTheme($id){
        
        $categorieModel = new CategorieModel();
        
        $data['categorie'] = $categorieModel->find($id);
        return view('user/gestion-themes/theme-creation', $data);
    }
  public function storeTheme()
{
    // ✅ VALIDATION
    $validation = $this->validate([
        'name' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|min_length[3]|max_length[100]|alpha_dash|is_unique[themes.slug]',
        'description' => 'max_length[500]',
        'icon' => 'required',
        'difficulty' => 'required|in_list[facile,moyen,difficile]',
        'id_categorie' => 'required|numeric|is_not_unique[categories.id_categorie]'
    ], [
        'name' => [
            'required' => 'Le nom du thème est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 100 caractères'
        ],
        'slug' => [
            'required' => 'Le slug est obligatoire',
            'min_length' => 'Le slug doit contenir au moins 3 caractères',
            'max_length' => 'Le slug ne peut pas dépasser 100 caractères',
            'alpha_dash' => 'Le slug ne peut contenir que des lettres, chiffres, tirets et underscores',
            'is_unique' => 'Ce slug existe déjà, veuillez en choisir un autre'
        ],
        'description' => [
            'max_length' => 'La description ne peut pas dépasser 500 caractères'
        ],
        'icon' => [
            'required' => 'Veuillez choisir une icône'
        ],
        'difficulty' => [
            'required' => 'Veuillez sélectionner une difficulté',
            'in_list' => 'Difficulté invalide'
        ],
        'id_categorie' => [
            'required' => 'La catégorie est obligatoire',
            'numeric' => 'ID de catégorie invalide',
            'is_not_unique' => 'Cette catégorie n\'existe pas'
        ]
    ]);
    
    if (!$validation) {
        return redirect()
            ->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }
    
    // ✅ PRÉPARATION DES DONNÉES
    $id_categorie = $this->request->getPost('id_categorie');
    
    $data = [
        'id_categorie' => $id_categorie,
        'name' => $this->request->getPost('name'),
        'slug' => strtolower($this->request->getPost('slug')),
        'description' => $this->request->getPost('description'),
        'icon' => $this->request->getPost('icon'),
        'difficulty' => $this->request->getPost('difficulty'),
        'is_active' => 1
    ];
    
    // ✅ SAUVEGARDE
    $themeModel = new ThemeModel();
    
    if ($themeModel->save($data)) {
        // Rester sur la même page avec message de succès
        return redirect()
            ->back()
            ->with('success', 'Le thème "' . $data['name'] . '" a été créé avec succès !');
    } else {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Erreur lors de la création du thème.');
    }
}
public function viewQuiz($slug, $id_categorie, $id_theme)
{
    $session = session();
    $themeModel = new ThemeModel();
    $categorieModel = new CategorieModel();
    $quizModel = new QuizModel();
    
    // Récupérer le thème
    $theme = $themeModel->find($id_theme);
    
    // Récupérer la catégorie
    $categorie = $categorieModel->find($id_categorie);
    
    // Vérifier que les données existent
    if (!$theme || !$categorie) {
        return redirect()->to('dashboard')->with('error', 'Thème ou catégorie introuvable');
    }
    
    // Récupérer tous les quiz de ce thème
    $quizzes = $quizModel->where('theme_id', $id_theme)->findAll();
    
    // Préparer les données
    $data = [
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        'theme' => $theme,
        'categorie' => $categorie,
        'quizzes' => $quizzes
    ];
    
    return view('user/gestion-quizzes/index', $data);
}
     /**
     * Démarrer un quiz
     */
public function viewQuestions($id_quiz)
{
    $session = session();
    
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('login');
    }
    
    $quizModel = new QuizModel();
    $questionModel = new QuestionModel();
    $themeModel = new ThemeModel();
    $categorieModel = new CategorieModel();
    
    // Récupérer le quiz
    $quiz = $quizModel->find($id_quiz);
    
    if (!$quiz) {
        return redirect()->to('dashboard')->with('error', 'Quiz introuvable');
    }
    
    // Récupérer les questions
    $questions = $questionModel->where('quiz_id', $id_quiz)->findAll();
    
    if (empty($questions)) {
        return redirect()->back()->with('error', 'Ce quiz ne contient aucune question');
    }
    
    // Récupérer thème et catégorie
    $theme = $themeModel->find($quiz['theme_id']);
    $categorie = null;
    if ($theme) {
        $categorie = $categorieModel->find($theme['id_categorie']);
    }
    
    // Stocker les infos en session
    $session->set([
        'current_quiz_id' => $quiz['id'],
        'quiz_title' => $quiz['title'],
        'quiz_description' => $quiz['description'] ?? '',
        'quiz_theme_name' => $theme['name'] ?? 'Thème',
        'quiz_categorie_name' => $categorie['nom'] ?? 'Catégorie',
        'quiz_questions' => $questions,
        'current_question_index' => 0,
        'quiz_score' => 0,
        'quiz_answers' => []
    ]);
    
    return redirect()->to('quiz/question');
}
public function question()
{
    $session = session();
    
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('login');
    }
    
    $questions = $session->get('quiz_questions');
    $currentIndex = $session->get('current_question_index');
    
    // Vérifier si le quiz est terminé
    if (!$questions || $currentIndex >= count($questions)) {
        return redirect()->to('quiz/results');
    }
    
    // Récupérer la question actuelle avec ses réponses
    $questionModel = new QuestionModel();
    $answerModel = new AnswerModel();
    
    $currentQuestion = $questions[$currentIndex];
    $question = $questionModel->find($currentQuestion['id']);
    
    if (!$question) {
        return redirect()->to('dashboard')->with('error', 'Question introuvable');
    }
    
    // Récupérer les réponses
    $answers = $answerModel->where('question_id', $question['id'])->findAll();
    
    // Mélanger les réponses
    shuffle($answers);
    
    $question['answers'] = $answers;
    
    // Préparer les données pour la vue
    $data = [
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        'quiz_title' => $session->get('quiz_title'),
        'quiz_description' => $session->get('quiz_description'),
        'theme_name' => $session->get('quiz_theme_name'),
        'categorie_name' => $session->get('quiz_categorie_name'),
        'question' => $question,
        'questionNumber' => $currentIndex + 1,
        'totalQuestions' => count($questions)
    ];
    
    return view('user/gestion-quizzes/afficher-quiz', $data);
}
public function submit()
{
    $session = session();
    
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('login');
    }
    
    $answerId = $this->request->getPost('answer_id');
    
    if (!$answerId) {
        return redirect()->back()->with('error', 'Veuillez sélectionner une réponse');
    }
    
    // Vérifier si la réponse est correcte
    $answerModel = new AnswerModel();
    $answer = $answerModel->find($answerId);
    
    if (!$answer) {
        return redirect()->back()->with('error', 'Réponse invalide');
    }
    
    $isCorrect = $answer['is_correct'] == 1;
    
    // Incrémenter le score si correct
    if ($isCorrect) {
        $currentScore = $session->get('quiz_score');
        $session->set('quiz_score', $currentScore + 1);
    }
    
    // Récupérer les infos
    $questions = $session->get('quiz_questions');
    $currentIndex = $session->get('current_question_index');
    $currentQuestionId = $questions[$currentIndex]['id'];
    
    // Sauvegarder l'historique des réponses EN SESSION SEULEMENT
    $quizAnswers = $session->get('quiz_answers') ?? [];
    $quizAnswers[] = [
        'question_id' => $currentQuestionId,
        'answer_id' => $answerId,
        'is_correct' => $isCorrect
    ];
    $session->set('quiz_answers', $quizAnswers);
    
    // Récupérer la question avec feedback
    $questionModel = new QuestionModel();
    $question = $questionModel->find($currentQuestionId);
    $answers = $answerModel->where('question_id', $question['id'])->findAll();
    $question['answers'] = $answers;
    
    // Préparer les données
    $data = [
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        'quiz_title' => $session->get('quiz_title'),
        'quiz_description' => $session->get('quiz_description'),
        'theme_name' => $session->get('quiz_theme_name'),
        'categorie_name' => $session->get('quiz_categorie_name'),
        'question' => $question,
        'questionNumber' => $currentIndex + 1,
        'totalQuestions' => count($questions),
        'submitted_answer_id' => $answerId,
        'is_correct' => $isCorrect,
        'feedback' => $isCorrect ? '✅ Bonne réponse !' : '❌ Mauvaise réponse.'
    ];
    
    return view('user/gestion-quizzes/afficher-quiz', $data);
}
public function next()
{
    $session = session();
    
    $currentIndex = $session->get('current_question_index');
    $session->set('current_question_index', $currentIndex + 1);
    
    return redirect()->to('quiz/question');
}
    
    /**
     * Afficher les résultats du quiz
     */
public function results()
{
    $session = session();
    
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('login');
    }
    
    $score = $session->get('quiz_score') ?? 0;
    $questions = $session->get('quiz_questions') ?? [];
    $total = count($questions);
    
    if ($total == 0) {
        return redirect()->to('dashboard')->with('error', 'Aucun résultat disponible');
    }
    
    $percentage = round(($score / $total) * 100);
    
    // Déterminer le message selon le score
    $message = '';
    if ($percentage >= 80) {
        $message = '🎉 Excellent travail !';
    } elseif ($percentage >= 60) {
        $message = '👍 Bon travail !';
    } elseif ($percentage >= 40) {
        $message = '📚 Continuez vos efforts !';
    } else {
        $message = '💪 Continuez à vous entraîner !';
    }
    
    // Préparer les données
    $data = [
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        'quiz_title' => $session->get('quiz_title'),
        'theme_name' => $session->get('quiz_theme_name'),
        'score' => $score,
        'total' => $total,
        'percentage' => $percentage,
        'message' => $message,
        'quiz_answers' => $session->get('quiz_answers') ?? []
    ];
    
    // Nettoyer la session
    $session->remove([
        'current_quiz_id',
        'quiz_title',
        'quiz_description',
        'quiz_theme_name',
        'quiz_categorie_name',
        'quiz_questions',
        'current_question_index',
        'quiz_score',
        'quiz_answers'
    ]);
    
    return view('user/gestion-quizzes/afficher-result', $data);
}

/**
 * Afficher le formulaire de création de quiz pour un thème spécifique
 */public function create($theme_id)
{
    $session = session();
    
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('login');
    }
    
    $themeModel = new ThemeModel();
    $categorieModel = new CategorieModel();
    
    // Récupérer le thème
    $theme = $themeModel->find($theme_id);
    
    if (!$theme) {
        return redirect()->back()->with('error', 'Thème introuvable');
    }
    
    // Récupérer la catégorie du thème
    $categorie = $categorieModel->find($theme['id_categorie']);
    
    $data = [
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        'theme' => $theme,
        'categorie' => $categorie
    ];
    
    return view('user/gestion-quizzes/create', $data);
}

/**
 * Enregistrer le nouveau quiz
 */
public function store()
{
    $session = session();
    
    // Récupérer les données
    $quizTitle = $this->request->getPost('quiz_title');
    $quizDescription = $this->request->getPost('quiz_description');
    $themeId = $this->request->getPost('theme_id');
    $questions = $this->request->getPost('questions');
    
    // Validation
    if (empty($quizTitle) || empty($themeId)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Veuillez remplir tous les champs obligatoires');
    }
    
    if (empty($questions)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Veuillez créer au moins une question');
    }
    
    $quizModel = new QuizModel();
    $questionModel = new QuestionModel();
    $answerModel = new AnswerModel();
    
    // Récupérer l'ID utilisateur depuis la session
    $userId = $session->get('user_id');
    
    // Vérifier que l'utilisateur est bien identifié
    if (!$userId) {
        return redirect()->to('login')->with('error', 'Session expirée. Veuillez vous reconnecter.');
    }
    
    // 1. Créer le quiz
    $quizData = [
        'title' => $quizTitle,
        'description' => $quizDescription,
        'theme_id' => $themeId,
        'id_utilisateur' => $userId,
        'is_published'=> 1
    ];
    
    $quizId = $quizModel->insert($quizData);
    
    if (!$quizId) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Erreur lors de la création du quiz');
    }
    
    // 2. Créer les questions et réponses
    foreach ($questions as $questionData) {
        // Vérifier que la question a du texte
        if (empty($questionData['text'])) {
            continue;
        }
        
        // Créer la question
        $questionId = $questionModel->insert([
            'quiz_id' => $quizId,
            'question_text' => $questionData['text']
        ]);
        
        if ($questionId && !empty($questionData['answers'])) {
            $correctAnswerIndex = $questionData['correct'] ?? 1;
            
            // Créer les réponses
            foreach ($questionData['answers'] as $index => $answerText) {
                if (!empty($answerText)) {
                    $answerModel->insert([
                        'question_id' => $questionId,
                        'answer_text' => $answerText,
                        'is_correct' => ($index == $correctAnswerIndex) ? 1 : 0
                    ]);
                }
            }
        }
    }
    
    // ✅ Rester sur la même page avec message de succès
    return redirect()->back()
        ->with('success', 'Le quiz "' . $quizTitle . '" a été créé avec succès !');
}}