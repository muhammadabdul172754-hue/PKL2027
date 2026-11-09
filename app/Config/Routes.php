<?php

// Definisikan filter role di sini
$allRole = ['filter' => 'auth']; // Wajib login (semua role)
$intRole = ['filter' => 'role:admin,petugas']; // Hanya admin & petugas

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::index');

$routes->get('/', function() {
    return view('layouts/dashboard'); // Sesuaikan dengan nama folder dan file view kamu
});

// Rute Register
$routes->get('/register', 'Auth::register');
$routes->post('/register/process', 'Auth::store_register');

//biodata
// Rute Biodata Tim
$routes->get('/tim/abdul', 'Biodata::abdul');
$routes->get('/tim/wildan', 'Biodata::wildan');
$routes->get('/tim/gumelar', 'Biodata::gumelar');
$routes->get('/tim/arya', 'Biodata::arya');
$routes->get('/tim/nandra', 'Biodata::nandra');

//chatroom
$routes->get('chat', 'Chat::index');
$routes->post('chat/send', 'Chat::send');
$routes->get('chat/fetch', 'Chat::fetch');
$routes->get('chat/delete/(:num)', 'Chat::delete/$1');
$routes->get('chat/pin/(:num)', 'Chat::pin/$1');

//users
$routes->get('/users/create', 'Users::create'); // form tambah user
$routes->post('/users/store', 'Users::store'); // aksi simpan user
$routes->get('/users', 'Users::index', $intRole); // menampilkan data user hanya untuk admin dan petugas
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole); // form edit user
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole); // aksi update user
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole); // aksi hapus user
$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole); // aksi detail user
$routes->get('users/print', 'Users::print', $allRole); // aksi print data user
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole); // aksi kirim ke whatsapp

$routes->get('uploads/users/(:segment)', 'Users::serveImage/$1');



//login
// --- RUTE LOGIN & LOGOUT ---
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', function() {
    return view('layouts/dashboard'); // Tambahkan 'layouts/'
});

