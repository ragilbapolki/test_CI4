<?php

namespace Config;
use App\Controllers\DashboardController;
use App\Controllers\Administrator\{UserController};
use App\Controllers\Master\{CategoryController, StageController, DivController, PositionController, 
	BranchController, EmployeeController};
use App\Controllers\Transaction\{CarpController, CarpPICController, CarpApprovalController};

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/',[DashboardController::class, 'index']);

// $routes->get('/products-jquery', 'ProductsController::index', ['filter' => 'role:administrator, user']);


$routes->group('/administrator', function($routes){
	$routes->group('setting_user', function($routes){
		$routes->get('/', [UserController::class, 'index']);
		$routes->get('get_data', [UserController::class, 'get_data']);
		$routes->get('get_modal', [UserController::class, 'get_modal']);
		$routes->post('save_data', [UserController::class, 'save_data']);
	});
});

$routes->group('/master', function($routes){
	$routes->group('division', function($routes){
		$routes->get('/', [DivController::class, 'index']);
		$routes->get('get_data', [DivController::class, 'get_data']);
		$routes->get('get_modal', [DivController::class, 'get_modal']);
		$routes->post('save_data', [DivController::class, 'save_data']);
		$routes->post('get_modal_edit', [DivController::class, 'get_modal_edit']);
		$routes->post('update_data', [DivController::class, 'update_data']);
		$routes->post('delete_data', [DivController::class, 'delete_data']);
	});
	$routes->group('position', function($routes){
		$routes->get('/', [PositionController::class, 'index']);
		$routes->get('get_data', [PositionController::class, 'get_data']);
		$routes->get('get_modal', [PositionController::class, 'get_modal']);
		$routes->post('save_data', [PositionController::class, 'save_data']);
		$routes->post('get_modal_edit', [PositionController::class, 'get_modal_edit']);
		$routes->post('update_data', [PositionController::class, 'update_data']);
		$routes->post('delete_data', [PositionController::class, 'delete_data']);
	});
	$routes->group('branch', function($routes){
		$routes->get('/', [BranchController::class, 'index']);
		$routes->get('get_data', [BranchController::class, 'get_data']);
		$routes->get('get_modal', [BranchController::class, 'get_modal']);
		$routes->post('save_data', [BranchController::class, 'save_data']);
		$routes->post('get_modal_edit', [BranchController::class, 'get_modal_edit']);
		$routes->post('update_data', [BranchController::class, 'update_data']);
		$routes->post('delete_data', [BranchController::class, 'delete_data']);
	});
	$routes->group('employee', function($routes){
		$routes->get('/', [EmployeeController::class, 'index']);
		$routes->get('get_data', [EmployeeController::class, 'get_data']);
		$routes->get('get_modal', [EmployeeController::class, 'get_modal']);
		$routes->post('save_data', [EmployeeController::class, 'save_data']);
		$routes->post('get_modal_edit', [EmployeeController::class, 'get_modal_edit']);
		$routes->post('update_data', [EmployeeController::class, 'update_data']);
		$routes->post('delete_data', [EmployeeController::class, 'delete_data']);
	});
	$routes->group('category', function($routes){
		$routes->get('/', [CategoryController::class, 'index']);
		$routes->get('get_data', [CategoryController::class, 'get_data']);
		$routes->get('get_modal', [CategoryController::class, 'get_modal']);
		$routes->post('save_data', [CategoryController::class, 'save_data']);
		$routes->post('get_modal_edit', [CategoryController::class, 'get_modal_edit']);
		$routes->post('update_data', [CategoryController::class, 'update_data']);
		$routes->post('delete_data', [CategoryController::class, 'delete_data']);
	});
	$routes->group('stage', function($routes){
		$routes->get('/', [StageController::class, 'index']);
		$routes->get('get_data', [StageController::class, 'get_data']);
		$routes->get('get_modal', [StageController::class, 'get_modal']);
		$routes->post('save_data', [StageController::class, 'save_data']);
		$routes->post('get_modal_edit', [StageController::class, 'get_modal_edit']);
		$routes->post('update_data', [StageController::class, 'update_data']);
		$routes->post('delete_data', [StageController::class, 'delete_data']);
	});
});

$routes->group('/transaction', function($routes){
	$routes->group('carp', function($routes){
		$routes->get('/', [CarpController::class, 'index']);
		$routes->get('get_data', [CarpController::class, 'get_data']);
		$routes->get('get_modal', [CarpController::class, 'get_modal']);
		$routes->post('save_data', [CarpController::class, 'save_data']);
	});
	$routes->group('carp_pic', function($routes){	
		$routes->get('/', [CarpPICController::class, 'index']);
		$routes->get('get_data', [CarpPICController::class, 'get_data']);
		$routes->post('get_modal_detail', [CarpPICController::class, 'get_modal_detail']);
		$routes->post('update_stage', [CarpPICController::class, 'update_stage']);
		$routes->post('get_progress', [CarpPICController::class, 'get_progress']);
		$routes->post('save_progress', [CarpPICController::class, 'save_progress']);
	});
	$routes->group('carp_approval', function($routes){	
		$routes->get('/', [CarpApprovalController::class, 'index']);
		$routes->get('get_data', [CarpApprovalController::class, 'get_data']);
		$routes->post('get_modal_detail', [CarpApprovalController::class, 'get_modal_detail']);
		$routes->post('save_progress', [CarpApprovalController::class, 'save_progress']);
	});
});

$routes->group('/dashboard', function($routes){
	$routes->get('/',[DashboardController::class, 'index']);
	$routes->get('get_data_chart_bar', [DashboardController::class, 'get_data_chart_bar']);
	$routes->get('get_data_chart_status', [DashboardController::class, 'get_data_chart_status']);
	$routes->get('get_data_dashboard', [DashboardController::class, 'get_data_dashboard']);
	$routes->get('get_modal_info', [DashboardController::class, 'get_modal_info']);
});




/**
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
