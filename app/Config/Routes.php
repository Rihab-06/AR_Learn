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
==============USER ROUTES WITH AUTHENTICATION=====================
==================================================================*/
// Route pour le dashboard admin
$routes->get('/admin_dash', 'AdminController::dashboard', ['filter' => 'auth:admin']);
// Route de déconnexion admin
$routes->get('/admin_logout', 'AdminController::logout');