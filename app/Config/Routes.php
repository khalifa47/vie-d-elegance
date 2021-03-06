<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

// api routes

// users api
$routes->get('/api/users/(:num)', 'api\UsersAPI::single/$1');
$routes->get('/api/users/(:segment)', 'api\UsersAPI::multiple/$1');
$routes->get('/api/users', 'api\UsersAPI::multiple');

// products api
$routes->get('/api/products/(:num)', 'api\ProductsAPI::single/$1');
$routes->get('/api/products/(:segment)', 'api\ProductsAPI::multiple/$1');
$routes->get('/api/products', 'api\ProductsAPI::multiple');

// transactions api
$routes->get('/api/transactions/(:num)', 'api\TransactionAPI::single/$1');
$routes->get('/api/transactions/(:segment)', 'api\TransactionAPI::multiple/$1');
$routes->get('/api/transactions', 'api\TransactionAPI::multiple');

// api portal
$routes->get('/api/(:segment)', 'api\UsersAPI::portal/$1');
$routes->post('/api/generateToken', 'api\UsersAPI::generateToken');
$routes->post('/api/generateKey', 'api\UsersAPI::generateKey');






// page routes
$routes->get('items/(:segment)', 'ItemsController::view/$1');
$routes->get('items', 'ItemsController::index');
$routes->get('users/(:segment)', 'UsersController::view/$1');
$routes->get('users', 'UsersController::index');
$routes->get('logout', 'UsersController::logout');
$routes->get('receipt/(:segment)', 'OrdersController::generateReceipt/$1');
$routes->get('/analytics', 'Pages::analytics');
$routes->get('/orders', 'OrdersController::index');
$routes->get('/cart', 'CartController::index');
$routes->get('/login', 'Pages::login');
$routes->get('/register', 'Pages::login');
$routes->get('/add-user', 'Pages::addUser');
$routes->get('/address', 'AddressController::index');
$routes->get('/edit-profile', 'Pages::editProfile');
$routes->get('/edit-password', 'Pages::editPassword');
$routes->get('/add-category', 'Pages::addCategory');
$routes->get('/add-item', 'Pages::addItem');
$routes->get('/', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
