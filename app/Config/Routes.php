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
$routes->setDefaultController('Blog');
$routes->setDefaultMethod('homepage');
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



$routes->add('/admin/mitra/', 'Admin\Mitra::list'); // Mitra Home
$routes->add('/admin/mitra/ajax-list/(:any)', 'Admin\Mitra::ajax_list/$1');
$routes->add('/admin/mitra/ajax-single', 'Admin\Mitra::ajax_list/');
$routes->add('/admin/mitra/(:any)', 'Admin\Mitra::$1'); // Mitra Re-route method

$routes->add('/admin', 'Admin\Dashboard::index'); // Dashboard
$routes->add('/admin/dashboard/', 'Admin\Dashboard::index'); // Dashboard Re-route method
$routes->add('/admin/dashboard/(:any)', 'Admin\Dashboard::$1'); // Dashboard Re-route method

$routes->add('/admin/pengguna/', 'Admin\Admin::list'); // Admin Re-route method
$routes->post('/admin/pengguna/', 'Admin\Admin::remove'); // Admin Re-route method
$routes->add('/admin/pengguna/(:any)', 'Admin\Admin::$1'); // Admin Re-route method


$routes->add('/admin/postingan/', 'Admin\Artikel::list'); // Postingan Artikel Re-route method

$routes->add('/admin/postingan/artikel/', 'Admin\Artikel::list'); // Postingan Artikel Re-route method
$routes->add('/admin/postingan/artikel/(:any)', 'Admin\Artikel::$1'); // Postingan Artikel Re-route method

$routes->add('/admin/postingan/halaman/', 'Admin\Halaman::list'); // Postingan Halaman Re-route method
$routes->add('/admin/postingan/halaman/(:any)', 'Admin\Halaman::$1'); // Postingan Halaman Re-route method

$routes->add('/admin/tataletak/', 'Admin\TataLetak::homepage'); // Tataletak Index page
$routes->add('/admin/tataletak/(:any)', 'Admin\TataLetak::$1'); // Tataletak Pages

$routes->add('/admin/konfigurasi/', 'Admin\Konfigurasi::index'); // Tataletak Index page
$routes->add('/admin/konfigurasi/(:any)', 'Admin\Konfigurasi::$1'); // Tataletak Pages

$routes->add('/login', 'Admin\Auth::index');
$routes->post('/login', 'Admin\Auth::do_login');
$routes->add('/logout', 'Admin\Auth::logout');

$routes->add('/mitra', 'Mitra::list'); // Front-end Mitra (Cari Mitra);

// $routes->add('/mitra', 'Mitra::index'); // Front-end Mitra (Cari Mitra); Change this if it is complete
$routes->add('/mitra/list', 'Mitra::list'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/ajax_list/(:segment)', 'Mitra::ajax_list/$1'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/dynamic_form_kelurahan', 'Mitra::dynamic_form_kelurahan'); // Front-end Mitra (List pencarian Mitra);
$routes->add('/mitra/(:any)', 'Mitra::detail/$1'); // Front-end Mitra (Detail Mitra);

$routes->add('/', 'Blog::homepage');
$routes->add('/terkini', 'Blog::terkini');
$routes->add('/terpopuler', 'Blog::terpopuler');
$routes->add('/kategori/(:any)', 'Blog::kategori/$1');
$routes->add('/penulis/(:any)', 'Blog::penulis/$1');
$routes->add('/halaman/(:segment)', 'Blog::detail_halaman/$1');
$routes->add('/(:segment)', 'Blog::detail_artikel/$1');
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
