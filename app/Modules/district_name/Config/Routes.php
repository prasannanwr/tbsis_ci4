<?php
$routes->group("district_name", ["namespace" => "App\Modules\district_name\Controllers"], function ($routes) {

	//$routes->get("/", "province::index");
	$routes->get('/', 'district_name::index', ['filter' => 'auth']);
	$routes->get('index', 'district_name::index', ['filter' => 'auth']);

	$routes->match(['get','post'],'create', 'district_name::create/', ['filter' => 'auth']);
    $routes->match(['get','post'],'create/(:any)', 'district_name::create/$1', ['filter' => 'auth']);

    $routes->match(['get','post'],'delete/(:any)', 'district_name::delete/$1', ['filter' => 'auth']);

});