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
$routes->add('/', 'Home::index');

$routes->add('/admin/mitra/', 'Admin\Mitra::list'); // Mitra Home
$routes->get('/admin/mitra/ajax-list/(:segment)', 'Admin\Mitra::ajax_list/$1');
$routes->get('/admin/mitra/ajax-single', 'Admin\Mitra::ajax_list/');
$routes->add('/admin/mitra/(:segment)', 'Admin\Mitra::$1'); // Mitra Re-route method
$routes->post('/admin/mitra/', 'Admin\Mitra::insert'); // Mitra Insert
$routes->put('/admin/mitra/(:num)', 'Admin\Mitra::update/$1'); // Mitra Update
$routes->delete('/admin/mitra/(:num)', 'Admin\Mitra::delete/$1'); // Mitra Delete
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
