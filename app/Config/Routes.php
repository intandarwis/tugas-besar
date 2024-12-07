<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Book
$routes->get('/buku', 'Book::index');
$routes->get('/buku/create', 'Book::create');
$routes->post('/buku/store', 'Book::store');
$routes->get('/buku/edit/(:segment)', 'Book::edit/$1');
$routes->post('/buku/update/(:segment)', 'Book::update/$1');
$routes->post('/buku/delete/(:segment)', 'Book::delete/$1');

//kategori
$routes->get('/kategori', 'Category::index');
$routes->get('/kategori/create', 'Category::create');
$routes->post('/kategori/store', 'Category::store');
$routes->get('/kategori/edit/(:segment)', 'Category::edit/$1');
$routes->post('/kategori/update/(:segment)', 'Category::update/$1');
$routes->post('/kategori/delete/(:segment)', 'Category::delete/$1');
$routes->get('/kategori/detail/(:num)', 'Category::detail/$1');

// Pengunjung
$routes->get('/pengunjung', 'Visitors::index');
$routes->get('/pengunjung/create', 'Visitors::create');
$routes->post('/pengunjung/store', 'Visitors::store');
$routes->get('/pengunjung/edit/(:segment)', 'Visitors::edit/$1');
$routes->post('/pengunjung/update/(:segment)', 'Visitors::update/$1');
$routes->get('/pengunjung/delete/(:segment)', 'Visitors::delete/$1');
$routes->get('/pengunjung/exportToPdf', 'Visitors::exportPDF');
$routes->get('/pengunjung/exportVisitorToPdf/(:segment)', 'Visitors::exportVisitorPDF/$1');

//Stok
$routes->get('/stok', 'Stock::index');
$routes->get('/stok/create', 'Stock::create');
$routes->post('/stok/store', 'Stock::store');
$routes->get('/stok/edit/(:segment)', 'Stock::edit/$1');
$routes->post('/stok/update/(:segment)', 'Stock::update/$1');
$routes->post('/stok/delete/(:segment)', 'Stock::delete/$1');

//Peminjaman
$routes->get('/loan', 'Loan::index');
$routes->post('/loan/add', 'Loan::add');
$routes->get('/loan/edit/(:num)', 'Loan::getLoan/$1');
$routes->post('/loan/update', 'Loan::update');
$routes->post('/loan/delete/(:num)', 'Loan::delete/$1');
$routes->get('/loan/exportAllLoansToPdf', 'Loan::exportAllLoansToPdf');
$routes->get('/loan/exportLoanToPdf/(:num)', 'Loan::exportLoanToPdf/$1');


//Pengembalian
$routes->get('/pengembalian', 'ReturnController::index');
$routes->post('/pengembalian/store', 'ReturnController::store');
$routes->get('/pengembalian/edit/(:segment)', 'ReturnController::edit/$1');
$routes->post('/pengembalian/update/(:segment)', 'ReturnController::update/$1');
$routes->post('/pengembalian/delete/(:segment)', 'ReturnController::delete/$1');
$routes->get('/pengembalian/exportToPdf', 'ReturnController::exportToPdf');
$routes->get('/pengembalian/printSingleReturn/(:num)', 'ReturnController::printSingleReturn/$1');

//Aktivitas
$routes->get('/aktivitas', 'AktivitasController::index');
