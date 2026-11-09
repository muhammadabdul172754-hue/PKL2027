<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Definisikan filter role di sini
$allRole = ['filter' => 'auth'];
$intRole = ['filter' => 'role:admin,petugas'];

// --- RUTE DASHBOARD & HOME ---
$routes->get('/', function() {
    return view('layouts/dashboard');
});
$routes->get('/dashboard', 'Home::index');

// --- RUTE AUTHENTICATION ---
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register/process', 'Auth::store_register');

// --- RUTE BIODATA TIM ---
$routes->get('/tim/abdul', 'Biodata::abdul');
$routes->get('/tim/wildan', 'Biodata::wildan');
$routes->get('/tim/gumelar', 'Biodata::gumelar');
$routes->get('/tim/arya', 'Biodata::arya');
$routes->get('/tim/nandra', 'Biodata::nandra');

// --- RUTE CHATROOM ---
$routes->get('chat', 'Chat::index');
$routes->post('chat/send', 'Chat::send');
$routes->get('chat/fetch', 'Chat::fetch');
$routes->get('chat/delete/(:num)', 'Chat::delete/$1');
$routes->get('chat/pin/(:num)', 'Chat::pin/$1');

// --- RUTE USERS ---
$routes->get('/users', 'Users::index', $intRole);
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole);
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole);
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole);
$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole);
$routes->get('users/print', 'Users::print', $allRole);
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole);
$routes->get('uploads/users/(:segment)', 'Users::serveImage/$1');

// --- RUTE JURNAL KERJA PKL ---
$routes->group('jurnal', function ($routes) {
    $routes->get('/', 'JurnalController::index');
    $routes->get('create', 'JurnalController::create');
    $routes->post('store', 'JurnalController::store');
    $routes->get('show/(:num)', 'JurnalController::show/$1');
    $routes->get('edit/(:num)', 'JurnalController::edit/$1');
    $routes->post('update/(:num)', 'JurnalController::update/$1');
    $routes->get('delete/(:num)', 'JurnalController::delete/$1');
    $routes->get('verifikasi', 'JurnalController::verifikasiIndex');
    $routes->post('verifikasi-update/(:num)', 'JurnalController::verifikasiUpdate/$1');
});