<?php

namespace Config;
use App\Controllers\DashboardController;
use App\Controllers\Master\{ProductsController, CategoryProductsController, UnitController, 
	SupplierController, CustomerController, StoreController};
use App\Controllers\Transaction\{PriceProductsController, StockProductsController, OrderController};

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
$routes->group('/master', function($routes){
	$routes->group('category_products', function($routes){
		$routes->get('/', [CategoryProductsController::class, 'index']);
		$routes->get('get_data', [CategoryProductsController::class, 'get_data']);
		$routes->get('get_modal', [CategoryProductsController::class, 'get_modal']);
		$routes->post('save_data', [CategoryProductsController::class, 'save_data']);
		$routes->post('get_modal_edit', [CategoryProductsController::class, 'get_modal_edit']);
		$routes->post('update_data', [CategoryProductsController::class, 'update_data']);
		$routes->post('delete_data', [CategoryProductsController::class, 'delete_data']);
	});
	$routes->group('unit', function($routes){
		$routes->get('/', [UnitController::class, 'index']);
		$routes->get('get_data', [UnitController::class, 'get_data']);
		$routes->get('get_modal', [UnitController::class, 'get_modal']);
		$routes->post('save_data', [UnitController::class, 'save_data']);
		$routes->post('get_modal_edit', [UnitController::class, 'get_modal_edit']);
		$routes->post('update_data', [UnitController::class, 'update_data']);
		$routes->post('delete_data', [UnitController::class, 'delete_data']);
	});
	$routes->group('products', function($routes){
		$routes->get('/', [ProductsController::class, 'index']);
		$routes->get('get_data', [ProductsController::class, 'get_data']);
		$routes->get('get_modal', [ProductsController::class, 'get_modal']);
		$routes->post('save_data', [ProductsController::class, 'save_data']);
		$routes->post('get_modal_edit', [ProductsController::class, 'get_modal_edit']);
		$routes->post('update_data', [ProductsController::class, 'update_data']);
		$routes->post('delete_data', [ProductsController::class, 'delete_data']);
		$routes->post('get_modal_detail', [ProductsController::class, 'get_modal_detail']);
		$routes->get('get_first_data', [ProductsController::class, 'get_first_data']);
	});
	$routes->group('supplier', function($routes){
		$routes->get('/', [SupplierController::class, 'index']);
		$routes->get('get_data', [SupplierController::class, 'get_data']);
		$routes->get('get_modal', [SupplierController::class, 'get_modal']);
		$routes->post('save_data', [SupplierController::class, 'save_data']);
		$routes->post('get_modal_edit', [SupplierController::class, 'get_modal_edit']);
		$routes->post('update_data', [SupplierController::class, 'update_data']);
		$routes->post('delete_data', [SupplierController::class, 'delete_data']);
	});
	$routes->group('customer', function($routes){
		$routes->get('/', [CustomerController::class, 'index']);
		$routes->get('get_data', [CustomerController::class, 'get_data']);
		$routes->get('get_modal', [CustomerController::class, 'get_modal']);
		$routes->post('save_data', [CustomerController::class, 'save_data']);
		$routes->post('get_modal_edit', [CustomerController::class, 'get_modal_edit']);
		$routes->post('update_data', [CustomerController::class, 'update_data']);
		$routes->post('delete_data', [CustomerController::class, 'delete_data']);
	});
	$routes->group('store', function($routes){
		$routes->get('/', [StoreController::class, 'index']);
		$routes->get('get_data', [StoreController::class, 'get_data']);
		$routes->get('get_modal', [StoreController::class, 'get_modal']);
		$routes->post('save_data', [StoreController::class, 'save_data']);
		$routes->post('get_modal_edit', [StoreController::class, 'get_modal_edit']);
		$routes->post('update_data', [StoreController::class, 'update_data']);
		$routes->post('delete_data', [StoreController::class, 'delete_data']);
	});
});

$routes->group('/transaction', function($routes){
	$routes->group('price_products', function($routes){
		$routes->get('/', [PriceProductsController::class, 'index']);
		$routes->get('get_data', [PriceProductsController::class, 'get_data']);
		$routes->get('get_modal', [PriceProductsController::class, 'get_modal']);
		$routes->post('save_data', [PriceProductsController::class, 'save_data']);
	});
	$routes->group('stock', function($routes){	
		$routes->get('/', [StockProductsController::class, 'index']);
		$routes->get('get_data', [StockProductsController::class, 'get_data']);
		$routes->get('get_modal', [StockProductsController::class, 'get_modal']);
		$routes->post('save_data', [StockProductsController::class, 'save_data']);
	});
	$routes->group('order', function($routes){	
		$routes->get('/', [OrderController::class, 'index']);
		$routes->get('get_modal', [OrderController::class, 'get_modal']);
		$routes->get('get_modal_pay', [OrderController::class, 'get_modal_pay']);
		$routes->post('save_data', [OrderController::class, 'save_data']);
	});
});

$routes->group('/report', function($routes){
	$routes->get('index_print_pdf', [OrderController::class, 'index_print_pdf']);
	$routes->get('get_data', [OrderController::class, 'get_data']);
	$routes->get('export-pdf', [OrderController::class, 'export_pdf']);
	$routes->post('get_modal_detail', [OrderController::class, 'get_modal_detail']);
	$routes->get('print_invoice', [OrderController::class, 'export_pdf']);
});

$routes->group('/dashboard', function($routes){
	$routes->get('/',[DashboardController::class, 'index']);
	$routes->get('get_data_chart_sales', [DashboardController::class, 'get_data_chart_sales']);
	$routes->get('get_data_chart_category', [DashboardController::class, 'get_data_chart_category']);
	$routes->get('get_data_dashboard', [DashboardController::class, 'get_data_dashboard']);
	$routes->get('get_modal_info', [DashboardController::class, 'get_modal_info']);
	$routes->get('get_modal_info_stock', [DashboardController::class, 'get_modal_info_stock']);
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
