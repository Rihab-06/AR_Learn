<?php

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

// Route du dashboard utilisateur
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);
// Route de déconnexion utilisateur
$routes->get('/logout', 'DashboardController::logout');

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
    // Déconnexion
    $routes->get('admin_logout', 'AdminController::logout');
});


