<?php
$routes->group("reports", ["namespace" => "App\Modules\Reports\Controllers"], function ($routes) {

	// welcome page - URL: /student
	$routes->get("/", "Reports::index");

	//$routes->get("/user/login", "User::login");

	$routes->get('index', 'Reports::index', ['filter' => 'auth']);

	$routes->get('Gen_Dag_FYWise', 'Reports::Gen_Dag_FYWise', ['filter' => 'auth']);
	$routes->get('Gen_Dag_FYWise/(:any)', 'Reports::Gen_Dag_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Gen_Dag_DateWise/(:any)', 'Reports::Gen_Dag_DateWise/$1', ['filter' => 'auth']);
	$routes->get('Gen_Dag_DateWise', 'Reports::Gen_Dag_DateWise', ['filter' => 'auth']);

	$routes->get('Beneficiaries_FYWise', 'Reports::Beneficiaries_FYWise', ['filter' => 'auth']);
	$routes->get('Beneficiaries_FYWise/(:any)', 'Reports::Beneficiaries_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Beneficiaries_DateWise', 'Reports::Beneficiaries_DateWise', ['filter' => 'auth']);
	$routes->get('Beneficiaries_DateWise/(:any)', 'Reports::Beneficiaries_DateWise/$1', ['filter' => 'auth']);
	
	
});

$routes->post('reports/Gen_Dag_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dag_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Gen_Dag_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dag_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Beneficiaries_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Beneficiaries_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Beneficiaries_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Beneficiaries_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index/$1', ['filter' => 'auth']);