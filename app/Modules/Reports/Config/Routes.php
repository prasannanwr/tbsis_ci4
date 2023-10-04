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

	$routes->get('UC_Composition_FYWise', 'Reports::UC_Composition_FYWise', ['filter' => 'auth']);
	$routes->get('UC_Composition_FYWise/(:any)', 'Reports::UC_Composition_FYWise/$1', ['filter' => 'auth']);

	$routes->get('UC_Composition_DateWise', 'Reports::UC_Composition_DateWise', ['filter' => 'auth']);
	$routes->get('UC_Composition_DateWise/(:any)', 'Reports::UC_Composition_DateWise/$1', ['filter' => 'auth']);

	$routes->get('UC_Proportion_Representation_FYWise', 'Reports::UC_Proportion_Representation_FYWise', ['filter' => 'auth']);
	$routes->get('UC_Proportion_Representation_FYWise/(:any)', 'Reports::UC_Proportion_Representation_FYWise/$1', ['filter' => 'auth']);	

	$routes->get('UC_Proportion_Representation_DateWise', 'Reports::UC_Proportion_Representation_DateWise', ['filter' => 'auth']);
	$routes->get('UC_Proportion_Representation_DateWise/(:any)', 'Reports::UC_Proportion_Representation_DateWise/$1', ['filter' => 'auth']);	
	
	$routes->get('UC_Executive_Position_FYWise', 'Reports::UC_Executive_Position_FYWise', ['filter' => 'auth']);
	$routes->get('UC_Executive_Position_FYWise/(:any)', 'Reports::UC_Executive_Position_FYWise/$1', ['filter' => 'auth']);

	$routes->get('UC_Executive_Position_DateWise', 'Reports::UC_Executive_Position_DateWise', ['filter' => 'auth']);
	$routes->get('UC_Executive_Position_DateWise/(:any)', 'Reports::UC_Executive_Position_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Employment_Generation_DateWise', 'Reports::Employment_Generation_DateWise', ['filter' => 'auth']);
	$routes->get('Employment_Generation_DateWise/(:any)', 'Reports::Employment_Generation_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Employment_Generation_FYWise', 'Reports::Employment_Generation_FYWise', ['filter' => 'auth']);
	$routes->get('Employment_Generation_FYWise/(:any)', 'Reports::Employment_Generation_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Employment_Generation_DateWise', 'Reports::Employment_Generation_DateWise', ['filter' => 'auth']);
	$routes->get('Employment_Generation_DateWise/(:any)', 'Reports::Employment_Generation_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Employment_Generation_FYWise', 'Reports::Employment_Generation_FYWise', ['filter' => 'auth']);
	$routes->get('Employment_Generation_FYWise/(:any)', 'Reports::Employment_Generation_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Public_Audit_DateWise', 'Reports::Public_Audit_DateWise', ['filter' => 'auth']);
	$routes->get('Public_Audit_DateWise/(:any)', 'Reports::Public_Audit_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Public_Audit_FYWise', 'Reports::Public_Audit_FYWise', ['filter' => 'auth']);
	$routes->get('Public_Audit_FYWise/(:any)', 'Reports::Public_Audit_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Public_Audit_DateWise', 'Reports::Public_Audit_DateWise', ['filter' => 'auth']);
	$routes->get('Public_Audit_DateWise/(:any)', 'Reports::Public_Audit_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Public_Audit_FYWise', 'Reports::Public_Audit_FYWise', ['filter' => 'auth']);
	$routes->get('Public_Audit_FYWise/(:any)', 'Reports::Public_Audit_FYWise/$1', ['filter' => 'auth']);

	$routes->get('Unacceptable_Social_UnderConstruction', 'Reports::Unacceptable_Social_UnderConstruction', ['filter' => 'auth']);

	$routes->get('Access_Utility_Completed_FYWise', 'Reports::Access_Utility_Completed_FYWise', ['filter' => 'auth']);
	$routes->get('Access_Utility_Completed_FYWise/(:any)', 'Reports::Access_Utility_Completed_FYWise/$1', ['filter' => 'auth']);
	$routes->get('Access_Utility_Completed_DateWise', 'Reports::Access_Utility_Completed_DateWise', ['filter' => 'auth']);
	$routes->get('Access_Utility_Completed_DateWise/(:any)', 'Reports::Access_Utility_Completed_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Unacceptable_Technical_UnderConstruction', 'Reports::Unacceptable_Technical_UnderConstruction', ['filter' => 'auth']);
	$routes->get('Unacceptable_Technical_UnderConstruction/(:any)', 'Reports::Unacceptable_Technical_UnderConstruction/$1', ['filter' => 'auth']);

	$routes->get('Unacceptable_Technical_Completed_DateWise', 'Reports::Unacceptable_Technical_Completed_DateWise', ['filter' => 'auth']);
	$routes->get('Unacceptable_Technical_Completed_DateWise/(:any)', 'Reports::Unacceptable_Technical_Completed_DateWise/$1', ['filter' => 'auth']);

	$routes->get('Unacceptable_Technical_Completed_FYWise', 'Reports::Unacceptable_Technical_Completed_FYWise', ['filter' => 'auth']);
	$routes->get('Unacceptable_Technical_Completed_FYWise/(:any)', 'Reports::Unacceptable_Technical_Completed_FYWise/$1', ['filter' => 'auth']);
	
	
});

$routes->post('reports/Gen_Dag_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dag_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Gen_Dag_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Gen_Dag_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Gen_Dag_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Gen_Dag_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Beneficiaries_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Beneficiaries_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Beneficiaries_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Beneficiaries_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Composition_FYWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Composition_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Composition_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Composition_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Composition_FYWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Composition_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Composition_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Composition_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Composition_DateWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Composition_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Composition_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Composition_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Composition_DateWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Composition_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Composition_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Composition_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Proportion_Representation_FYWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Proportion_Representation_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Proportion_Representation_DateWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Proportion_Representation_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Proportion_Representation_DateWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Proportion_Representation_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Executive_Position_FYWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Executive_Position_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Executive_Position_FYWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Executive_Position_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Executive_Position_DateWise_report', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Executive_Position_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Executive_Position_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Employment_Generation_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Employment_Generation_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Employment_Generation_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Employment_Generation_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Employment_Generation_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Employment_Generation_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Employment_Generation_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Employment_Generation_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Employment_Generation_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Public_Audit_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Public_Audit_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Public_Audit_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Public_Audit_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Public_Audit_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Public_Audit_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Public_Audit_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Public_Audit_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/UC_Proportion_Representation_FYWise_report/', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/UC_Proportion_Representation_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Beneficiaries_FYWise_report/', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Beneficiaries_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Beneficiaries_DateWise_report/', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Beneficiaries_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Beneficiaries_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Access_Utility_Completed_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Access_Utility_Completed_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Access_Utility_Completed_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Access_Utility_Completed_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Access_Utility_Completed_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Access_Utility_Completed_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Access_Utility_Completed_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Access_Utility_Completed_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Access_Utility_Completed_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Gen_Dag_FYWise_report/', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Gen_Dag_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Gen_Dag_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/UC_Proportion_Representation_FYWise_report/', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/UC_Proportion_Representation_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\UC_Proportion_Representation_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Unacceptable_Technical_Completed_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_FYWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Unacceptable_Technical_Completed_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Unacceptable_Technical_Completed_FYWise_report', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_FYWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Unacceptable_Technical_Completed_FYWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_FYWise_report::index/$1', ['filter' => 'auth']);

$routes->get('reports/Unacceptable_Technical_Completed_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_DateWise_report::index', ['filter' => 'auth']);
$routes->get('reports/Unacceptable_Technical_Completed_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_DateWise_report::index/$1', ['filter' => 'auth']);

$routes->post('reports/Unacceptable_Technical_Completed_DateWise_report', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_DateWise_report::index', ['filter' => 'auth']);
$routes->post('reports/Unacceptable_Technical_Completed_DateWise_report/(:any)', '\App\Modules\Reports\Controllers\Inc\Unacceptable_Technical_Completed_DateWise_report::index/$1', ['filter' => 'auth']);