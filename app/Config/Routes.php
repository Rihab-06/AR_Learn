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
// Route pour le dashboard admin
$routes->get('/admin_dash', 'AdminController::dashboard', ['filter' => 'auth:admin']); 
// Route pour la liste des utilisateurs
$routes->get('/admin/users', 'AdminController::listUsers');
$routes->get('/admin/users/delete/(:num)', 'AdminController::deleteUser/$1');
    // Route de déconnexion admin
$routes->get('/admin_logout', 'AdminController::logout');
   // editer un utilisateur
$routes->get('/admin/users/edit/(:num)', 'AdminController::editUser/$1');
   // update un utilisateur
$routes->post('/admin/users/update/(:num)', 'AdminController::updateUser/$1');





