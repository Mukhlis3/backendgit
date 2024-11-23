<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/login','Auth::login');
$routes->get('/register','Auth::register');

$routes->post('authenticate','Auth::authenticate');

$routes->get('/register/store','Auth::store');

$routes->get('/register', 'AuthController::register');
$routes->post('/register/store', 'AuthController::store');
