<?php
$routes->group("vdc_municipality", ["namespace" => 'App\Modules\vdc_municipality\Controllers'], function ($routes) {

	//$routes->get("/", "vdc_municipality::index");
	$routes->get('/', 'vdc_municipality::index', ['filter' => 'auth']);
	$routes->get('index', 'vdc_municipality::index', ['filter' => 'auth']);
	$routes->get('ajaxData', 'vdc_municipality::ajaxData', ['filter' => 'auth']);

	$routes->match(['get','post'],'create', 'vdc_municipality::create/', ['filter' => 'auth']);
    $routes->match(['get','post'],'create/(:any)', 'vdc_municipality::create/$1', ['filter' => 'auth']);

    $routes->match(['get','post'],'delete/(:any)', 'vdc_municipality::delete/$1', ['filter' => 'auth']);

});