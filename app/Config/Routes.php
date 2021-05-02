<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// * Admin/Mitra/List 

// $routes->add('/', 'Home::index'); Change this if it is complete


$routes->add('/admin', 'Admin\Mitra::list'); // Temporary

$routes->add('/admin/mitra/', 'Admin\Mitra::list'); // Mitra Home
$routes->get('/admin/mitra/ajax-list/(:any)', 'Admin\Mitra::ajax_list/$1');
$routes->get('/admin/mitra/ajax-single', 'Admin\Mitra::ajax_list/');
$routes->add('/admin/mitra/(:any)', 'Admin\Mitra::$1'); // Mitra Re-route method

$routes->add('/admin/pengguna/', 'Admin\Admin::list'); // Admin Re-route method
$routes->post('/admin/pengguna/', 'Admin\Admin::remove'); // Admin Re-route method
$routes->add('/admin/pengguna/(:any)', 'Admin\Admin::$1'); // Admin Re-route method


$routes->add('/admin/postingan/', 'Admin\Artikel::list'); // Postingan Artikel Re-route method

$routes->add('/admin/postingan/artikel/', 'Admin\Artikel::list'); // Postingan Artikel Re-route method
$routes->add('/admin/postingan/artikel/(:any)', 'Admin\Artikel::$1'); // Postingan Artikel Re-route method

$routes->add('/admin/postingan/halaman/', 'Admin\Halaman::list'); // Postingan Halaman Re-route method
$routes->add('/admin/postingan/halaman/(:any)', 'Admin\Halaman::$1'); // Postingan Halaman Re-route method

// $routes->add('/mitra', 'Mitra::index'); // Front-end Mitra (Cari Mitra); Change this if it is complete
$routes->add('/mitra/list', 'Mitra::list'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/ajax_list/(:segment)', 'Mitra::ajax_list/$1'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/dynamic_form_kelurahan', 'Mitra::dynamic_form_kelurahan'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/(:any)', 'Mitra::detail/$1'); // Front-end Mitra (Detail Mitra);

$routes->get('/login', 'Admin\Auth::index');
$routes->post('/login', 'Admin\Auth::do_login');
$routes->get('/logout', 'Admin\Auth::logout');

// Demo Purpose 
$routes->add('/', 'Mitra::list');
$routes->add('/mitra', 'Mitra::list'); // Front-end Mitra (Cari Mitra);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
