<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'beforelogin'], function ($routes) {
    $routes->get('/', 'Auth::index');
    // LOGIN
    $routes->get('auth','Auth::fn_login');
    $routes->post('validation', 'Auth::fn_validation');
    $routes->get('token', 'Auth::fn_token');
    $routes->post('verifytoken', 'Auth::fn_verifytoken');
});


$routes->group('', ['filter' => 'afterlogin'], function ($routes) {
    //HOME
    $routes->get('home', 'Home::fn_home');
});

$routes->get('logout','Auth::fn_logout');
$routes->get('getidtag', 'Attendance::fn_rfidtag');