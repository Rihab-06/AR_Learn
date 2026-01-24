<?php

use App\Controllers\UtilisateurController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
//Routs pour l'authentification
$routes->post('/process-login', 'AuthController::processLogin');
$routes->get('/login2', 'AuthController::log');
$routes->post('/login', 'AuthController::log');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->post('/signup', 'AuthController::processRegister');
/*================================================================
==============USER ROUTES WITH AUTHENTICATION=====================
==================================================================*/
$routes->group('', ['filter' => 'auth'], function($routes) {

    // Route pour ajout des catégories
    $routes->get('user/categorie/creation', 'UtilisateurController::addCategorie');
    // Route pour stocker les catégories
    $routes->post('user/categorie/store', 'UtilisateurController::storeCategories');

    // Route du dashboard utilisateur
    $routes->get('dashboard', 'DashboardController::index');
    // Route pour afficher les sous-catégories
    $routes->get('user/categorie/sous-categorie/(:num)', 'UtilisateurController::viewSousCategories/$1');
    //Route pour ajout des sous-categories
    $routes->get('user/sous-categorie/creation/(:num)', 'UtilisateurController::addSousCategorie/$1');
    // Route pour stocker les sous-categories
    $routes->post('user/sous-categorie/store', 'UtilisateurController::storeSousCategories' );
    // Route des themes 
    $routes->get('user/categorie/sous-categorie/(:segment)/(:num)', 'UtilisateurController::viewTheme/$1/$2');
    // Route pour ajouter un theme 
    $routes->get('user/sous-categories/theme/creation/(:num)', 'UtilisateurController::addTheme/$1');
    $routes->post('user/themes/store', 'UtilisateurController::storeTheme');
    // Route pour ajouter les quizs 
    $routes->get('user/themes/(:segment)/(:num)/quiz/(:num)','UtilisateurController::viewQuiz/$1/$2/$3' );
    // Route pour afficher les questions de quiz 
    $routes->get('/user/quiz/view/(:num)','UtilisateurController::viewQuestions/$1');
    // Afficher une question
    $routes->get('quiz/question', 'UtilisateurController::question');
    // Soumettre une réponse
    $routes->post('quiz/submit', 'UtilisateurController::submit');
    $routes->get('user/quiz/creation/(:num)', 'UtilisateurController::create/$1');
    $routes->post('user/quiz/store', 'UtilisateurController::store');
    // Question suivante
    $routes->get('quiz/next', 'UtilisateurController::next');
    // Résultats du quiz
    $routes->get('quiz/results', 'UtilisateurController::results');
    // Route de déconnexion utilisateur
    $routes->get('logout', 'DashboardController::logout');


});

/*================================================================
==============ADMIN ROUTES WITH AUTHENTICATION=====================
==================================================================*/
// Groupe sans préfixe - garde tes URLs actuelles
$routes->group('', ['filter' => 'auth:admin'], function($routes) {
    
    // Dashboard
    $routes->get('admin_dash', 'AdminController::dashboard');
    // ===== GESTION DES UTILISATEURS =====
    $routes->get('admin/users', 'AdminController::listUsers');
    $routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1');
    $routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1');
    $routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1'); 
    // ===== GESTION DES CATÉGORIES =====
    $routes->get('admin/categories', 'AdminController::listCategories');
    $routes->get('admin/categories/create', 'AdminController::addCategories');
    $routes->post('admin/categories/store', 'AdminController::storeCategories');
    $routes->get('admin/categories/edit/(:num)', 'AdminController::editCategories/$1');
    $routes->post('admin/categories/update/(:num)', 'AdminController::updateCategories/$1');
    $routes->get('admin/categories/delete/(:num)', 'AdminController::deleteCategories/$1');
    // ===== GESTION DES SOUS-CATÉGORIES =====
    $routes->get('admin/categories/view/(:num)', 'AdminController::viewCategories/$1');
    $routes->get('admin/sous-categories/create/(:num)', 'AdminController::addSousCategories/$1');
    $routes->post('admin/sous-categories/store', 'AdminController::storeSousCategories');
    $routes->get('admin/sous-categories/delete/(:num)', 'AdminController::deleteSousCategories/$1');
    $routes->get('admin/sous-categories/edit/(:num)', 'AdminController::editSousCategories/$1');
    $routes->post('admin/sous-categories/update/(:num)', 'AdminController::updateSousCategories/$1');
     // ===== GESTION DES THEMES =====
     $routes->get('/admin/theme/(:num)', 'AdminController::viewThemes/$1');
     $routes->get('admin/theme/delete/(:num)', 'AdminController::deleteThemes/$1');
      // ===== GESTION DES QUIZZES =====
    $routes->get('admin/theme/quiz/(:num)', 'AdminController::viewQuizzes/$1');
    $routes->get('admin/quizzes/delete/(:num)', 'AdminController::deleteQuizzes/$1');
    // ===== GESTION DES PARAMETRES DE L'ADMIN =====
    $routes->get('admin/settings', 'AdminController::manageSettings');
    $routes->get('admin/settings/admin/add', 'AdminController::addAdmin');
    $routes->post('admin/settings/admin/store', 'AdminController::storeAdmin');
    $routes->get('admin/settings/admin/edit/(:num)', 'AdminController::editAdmin/$1');
    $routes->post('admin/settings/admin/update/(:num)', 'AdminController::updateAdmin/$1');
    $routes->get('admin/settings/admin/delete/(:num)', 'AdminController::deleteAdmin/$1');

    // Déconnexion
    $routes->get('admin_logout', 'AdminController::logout');
});


