<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Shield'ın register rotalarını KULLANMA, diğerlerini kullan
$routes->get('test-takim/(:num)', function($id) {
    return "Test OK. Takım ID: " . $id;
});


$routes->get('maclar', 'Web\MacController::index');
service('auth')->routes($routes);
service('auth')->routes($routes, ['except' => ['register']]);

$routes->get('takimlar', 'Web\TakimController::index');
$routes->get('takimlar/(:num)', 'Web\TakimController::show/$1');

 $routes->get('register', 'Auth\RegisterController::registerView');
$routes->post('register', 'Auth\RegisterController::registerAction');
$routes->get('register', 'Auth\RegisterController::index');
$routes->post('register', 'Auth\RegisterController::store');
// Ana sayfa
$routes->get('/', 'Web\HomeController::index');
// Diğer rotalar...
$routes->get('turnuvalar', 'Web\TurnuvaController::index');
$routes->get('turnuvalar/(:segment)', 'Web\TurnuvaController::show/$1');
$routes->get('takimlar', 'Web\TakimController::index');
$routes->get('media-value', 'Tools\MediaValueController::index');
$routes->get('profil', 'Web\ProfilController::index', ['filter' => 'session']);
$routes->get('dashboard', 'Web\DashboardController::index', ['filter' => 'session']);

// Admin grubu
$routes->group('admin', ['filter' => 'group:admin'], function($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('turnuvalar', 'Admin\TurnuvaController::index');
    $routes->get('turnuvalar/new', 'Admin\TurnuvaController::new');
    $routes->post('turnuvalar', 'Admin\TurnuvaController::create');
    $routes->get('turnuvalar/edit/(:num)', 'Admin\TurnuvaController::edit/$1');
    $routes->post('turnuvalar/update/(:num)', 'Admin\TurnuvaController::update/$1');
    $routes->get('turnuvalar/delete/(:num)', 'Admin\TurnuvaController::delete/$1');
    
    $routes->get('takimlar', 'Admin\TakimController::index');
    $routes->get('takimlar/(:num)', 'Web\TakimController::show/$1');
    $routes->get('takimlar/new', 'Admin\TakimController::new');
    $routes->post('takimlar', 'Admin\TakimController::create');
    $routes->get('takimlar/edit/(:num)', 'Admin\TakimController::edit/$1');
     $routes->get('takimlar/show/(:num)', 'Admin\TakimController::show/$1');
    $routes->post('takimlar/update/(:num)', 'Admin\TakimController::update/$1');
    $routes->get('takimlar/delete/(:num)', 'Admin\TakimController::delete/$1');


    // Maçlar
       $routes->get('maclar', 'Admin\MacController::index');
    $routes->get('maclar/new', 'Admin\MacController::new');
    $routes->post('maclar', 'Admin\MacController::create');
    $routes->get('maclar/edit/(:num)', 'Admin\MacController::edit/$1');
    $routes->post('maclar/update/(:num)', 'Admin\MacController::update/$1');
    $routes->get('maclar/delete/(:num)', 'Admin\MacController::delete/$1');

});