<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Home route
Route::get('/', 'HomeController@index');

// Authentication
Auth::routes();

// Profile home
Route::get('/home', 'HomeController@index')->name('home');

// Language setter
Route::post('languages/set', 'LanguagesController@set')->name('languages.set');

// reports
Route::group([
    'prefix' => 'reports',
], function () {

    Route::get('/assets', 'ReportsController@assets')
        ->name('reports.report.assets');

    Route::get('/top_customers', 'ReportsController@topCustomers')
        ->name('reports.report.top_customers');

    Route::get('/vehicle_usage', 'ReportsController@vehicleUsage')
        ->name('reports.report.vehicle_usage');
    Route::post('/vehicle_usage', 'ReportsController@showVehicleUsage')
        ->name('reports.report.show_vehicle_usage');

    Route::get('/maintenance', 'ReportsController@maintenance')
        ->name('reports.report.maintenance');
    Route::post('/maintenance', 'ReportsController@showMaintenance')
        ->name('reports.report.show_maintenance');

    Route::get('/revenue_and_exprenses', 'ReportsController@revenueAndExprenses')
        ->name('reports.report.revenue_and_exprenses');
    Route::post('/revenue_and_exprenses', 'ReportsController@showRevenueAndExprenses')
        ->name('reports.report.show_revenue_and_exprenses');

    Route::get('/cash_flow', 'ReportsController@cashFlow')
        ->name('reports.report.cash_flow');
    Route::post('/cash_flow', 'ReportsController@showCashFlow')
        ->name('reports.report.show_cash_flow');

    Route::get('/profit_loss_by_vehicle', 'ReportsController@profitLossByVehicle')
        ->name('reports.report.profit_loss_by_vehicle');
    Route::post('/profit_loss_by_vehicle', 'ReportsController@showProfitLossByVehicle')
        ->name('reports.report.show_profit_loss_by_vehicle');

    Route::get('/cost_analysis', 'ReportsController@costAnalysis')
        ->name('reports.report.cost_analysis');
    Route::post('/cost_analysis', 'ReportsController@showCostAnalysis')
        ->name('reports.report.show_cost_analysis');

});

// asset categories
Route::group([
    'prefix' => 'asset_categories',
], function () {
    Route::get('/', 'AssetCategoriesController@index')
        ->name('asset_categories.asset_category.index');
    Route::get('/create', 'AssetCategoriesController@create')
        ->name('asset_categories.asset_category.create');
    Route::get('/show/{assetCategory}', 'AssetCategoriesController@show')
        ->name('asset_categories.asset_category.show')
        ->where('id', '[0-9]+');
    Route::get('/{assetCategory}/edit', 'AssetCategoriesController@edit')
        ->name('asset_categories.asset_category.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'AssetCategoriesController@store')
        ->name('asset_categories.asset_category.store');
    Route::put('asset_category/{assetCategory}', 'AssetCategoriesController@update')
        ->name('asset_categories.asset_category.update')
        ->where('id', '[0-9]+');
    Route::delete('/asset_category/{assetCategory}', 'AssetCategoriesController@destroy')
        ->name('asset_categories.asset_category.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'brands',
], function () {
    Route::get('/', 'BrandsController@index')
        ->name('brands.brand.index');
    Route::get('/create', 'BrandsController@create')
        ->name('brands.brand.create');
    Route::get('/show/{brand}', 'BrandsController@show')
        ->name('brands.brand.show')
        ->where('id', '[0-9]+');
    Route::get('/{brand}/edit', 'BrandsController@edit')
        ->name('brands.brand.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'BrandsController@store')
        ->name('brands.brand.store');
    Route::put('brand/{brand}', 'BrandsController@update')
        ->name('brands.brand.update')
        ->where('id', '[0-9]+');
    Route::delete('/brand/{brand}', 'BrandsController@destroy')
        ->name('brands.brand.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'checks',
], function () {
    Route::get('/', 'ChecksController@index')
        ->name('checks.check.index');
    Route::get('/create', 'ChecksController@create')
        ->name('checks.check.create');
    Route::get('/show/{check}', 'ChecksController@show')
        ->name('checks.check.show')
        ->where('id', '[0-9]+');
    Route::get('/{check}/edit', 'ChecksController@edit')
        ->name('checks.check.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'ChecksController@store')
        ->name('checks.check.store');
    Route::put('check/{check}', 'ChecksController@update')
        ->name('checks.check.update')
        ->where('id', '[0-9]+');
    Route::delete('/check/{check}', 'ChecksController@destroy')
        ->name('checks.check.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'credit_payments',
], function () {

    Route::post('/', 'CreditPaymentsController@store')
        ->name('credit_payments.credit_payment.store');
    Route::patch('credit_payment/{creditPayment}', 'CreditPaymentsController@update')
        ->name('credit_payments.credit_payment.update')
        ->where('id', '[0-9]+');
    Route::delete('/credit_payment/{creditPayment}', 'CreditPaymentsController@destroy')
        ->name('credit_payments.credit_payment.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'credits',
], function () {
    Route::get('/', 'CreditsController@index')
        ->name('credits.credit.index');
    Route::get('/create', 'CreditsController@create')
        ->name('credits.credit.create');
    Route::get('/show/{credit}', 'CreditsController@show')
        ->name('credits.credit.show')
        ->where('id', '[0-9]+');
    Route::get('/{credit}/edit', 'CreditsController@edit')
        ->name('credits.credit.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'CreditsController@store')
        ->name('credits.credit.store');
    Route::put('credit/{credit}', 'CreditsController@update')
        ->name('credits.credit.update')
        ->where('id', '[0-9]+');
    Route::delete('/credit/{credit}', 'CreditsController@destroy')
        ->name('credits.credit.destroy')
        ->where('id', '[0-9]+');
    Route::get('/search/{term?}', 'CreditsController@index')
        ->name('credits.credit.search');
});

Route::group([
    'prefix' => 'customers',
], function () {

    Route::get('/', 'CustomersController@index')
        ->name('customers.customer.index');

    Route::get('/search/{term?}', 'CustomersController@index')
        ->name('customers.customer.search');

    Route::get('/create', 'CustomersController@create')
        ->name('customers.customer.create');

    Route::get('/show/{customer}', 'CustomersController@show')
        ->name('customers.customer.show')
        ->where('id', '[0-9]+');

    Route::get('/{customer}/edit', 'CustomersController@edit')
        ->name('customers.customer.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'CustomersController@store')
        ->name('customers.customer.store');

    Route::put('customer/{customer}', 'CustomersController@update')
        ->name('customers.customer.update')
        ->where('id', '[0-9]+');

    Route::delete('/customer/{customer}', 'CustomersController@destroy')
        ->name('customers.customer.destroy')
        ->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'expense_categories',
], function () {

    Route::get('/', 'ExpenseCategoriesController@index')
        ->name('expense_categories.expense_category.index');

    Route::get('/create', 'ExpenseCategoriesController@create')
        ->name('expense_categories.expense_category.create');

    Route::get('/show/{expenseCategory}', 'ExpenseCategoriesController@show')
        ->name('expense_categories.expense_category.show')
        ->where('id', '[0-9]+');

    Route::get('/{expenseCategory}/edit', 'ExpenseCategoriesController@edit')
        ->name('expense_categories.expense_category.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'ExpenseCategoriesController@store')
        ->name('expense_categories.expense_category.store');

    Route::put('expense_category/{expenseCategory}', 'ExpenseCategoriesController@update')
        ->name('expense_categories.expense_category.update')
        ->where('id', '[0-9]+');

    Route::delete('/expense_category/{expenseCategory}', 'ExpenseCategoriesController@destroy')
        ->name('expense_categories.expense_category.destroy')
        ->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'expenses',
], function () {

    Route::get('/', 'ExpensesController@index')
        ->name('expenses.expense.index');

    Route::get('/create', 'ExpensesController@create')
        ->name('expenses.expense.create');

    Route::get('/show/{expense}', 'ExpensesController@show')
        ->name('expenses.expense.show')
        ->where('id', '[0-9]+');

    Route::get('/{expense}/edit', 'ExpensesController@edit')
        ->name('expenses.expense.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'ExpensesController@store')
        ->name('expenses.expense.store');

    Route::put('expense/{expense}', 'ExpensesController@update')
        ->name('expenses.expense.update')
        ->where('id', '[0-9]+');

    Route::delete('/expense/{expense}', 'ExpensesController@destroy')
        ->name('expenses.expense.destroy')
        ->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'maintenance_categories',
], function () {

    Route::get('/', 'MaintenanceCategoriesController@index')
        ->name('maintenance_categories.maintenance_category.index');

    Route::get('/create', 'MaintenanceCategoriesController@create')
        ->name('maintenance_categories.maintenance_category.create');

    Route::get('/show/{maintenanceCategory}', 'MaintenanceCategoriesController@show')
        ->name('maintenance_categories.maintenance_category.show')
        ->where('id', '[0-9]+');

    Route::get('/{maintenanceCategory}/edit', 'MaintenanceCategoriesController@edit')
        ->name('maintenance_categories.maintenance_category.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'MaintenanceCategoriesController@store')
        ->name('maintenance_categories.maintenance_category.store');

    Route::put('maintenance_category/{maintenanceCategory}', 'MaintenanceCategoriesController@update')
        ->name('maintenance_categories.maintenance_category.update')
        ->where('id', '[0-9]+');

    Route::delete('/maintenance_category/{maintenanceCategory}', 'MaintenanceCategoriesController@destroy')
        ->name('maintenance_categories.maintenance_category.destroy')
        ->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'maintenance_records',
], function () {

    Route::get('/', 'MaintenanceRecordsController@index')
        ->name('maintenance_records.maintenance_record.index');

    Route::get('/create', 'MaintenanceRecordsController@create')
        ->name('maintenance_records.maintenance_record.create');

    Route::get('/show/{maintenanceRecord}', 'MaintenanceRecordsController@show')
        ->name('maintenance_records.maintenance_record.show')
        ->where('id', '[0-9]+');

    Route::get('/{maintenanceRecord}/edit', 'MaintenanceRecordsController@edit')
        ->name('maintenance_records.maintenance_record.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'MaintenanceRecordsController@store')
        ->name('maintenance_records.maintenance_record.store');

    Route::put('maintenance_record/{maintenanceRecord}', 'MaintenanceRecordsController@update')
        ->name('maintenance_records.maintenance_record.update')
        ->where('id', '[0-9]+');

    Route::delete('/maintenance_record/{maintenanceRecord}', 'MaintenanceRecordsController@destroy')
        ->name('maintenance_records.maintenance_record.destroy')
        ->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'payable_checks',
], function () {

    Route::get('/', 'PayableChecksController@index')
        ->name('payable_checks.payable_check.index');

    Route::get('/create', 'PayableChecksController@create')
        ->name('payable_checks.payable_check.create');

    Route::get('/show/{payableCheck}', 'PayableChecksController@show')
        ->name('payable_checks.payable_check.show')
        ->where('id', '[0-9]+');

    Route::get('/{payableCheck}/edit', 'PayableChecksController@edit')
        ->name('payable_checks.payable_check.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'PayableChecksController@store')
        ->name('payable_checks.payable_check.store');

    Route::put('payable_check/{payableCheck}', 'PayableChecksController@update')
        ->name('payable_checks.payable_check.update')
        ->where('id', '[0-9]+');

    Route::delete('/payable_check/{payableCheck}', 'PayableChecksController@destroy')
        ->name('payable_checks.payable_check.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'reservations',
], function () {

    Route::get('/', 'ReservationsController@index')
        ->name('reservations.reservation.index');

    Route::get('/create', 'ReservationsController@create')
        ->name('reservations.reservation.create');

    Route::get('/show/{reservation}', 'ReservationsController@show')
        ->name('reservations.reservation.show')
        ->where('id', '[0-9]+');

    Route::get('/{reservation}/edit', 'ReservationsController@edit')
        ->name('reservations.reservation.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'ReservationsController@store')
        ->name('reservations.reservation.store');

    Route::put('reservation/{reservation}', 'ReservationsController@update')
        ->name('reservations.reservation.update')
        ->where('id', '[0-9]+');

    Route::delete('/reservation/{reservation}', 'ReservationsController@destroy')
        ->name('reservations.reservation.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'reservation_pickups',
], function () {
    Route::get('/', 'ReservationPickupsController@index')
        ->name('reservation_pickups.reservation_pickup.index');
    Route::get('/pickup/{id}', 'ReservationPickupsController@pickup')
        ->name('reservation_pickups.reservation_pickup.pickup')
        ->where('id', '[0-9]+');
    Route::post('/process/{id}', 'ReservationPickupsController@process')
        ->name('reservation_pickups.reservation_pickup.process');

    Route::get('/processed/{id}', 'ReservationPickupsController@processed')
        ->name('reservation_pickups.reservation_pickup.processed')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'reservation_dropoffs',
], function () {
    Route::get('/', 'ReservationDropoffsController@index')
        ->name('reservation_dropoffs.reservation_dropoff.index');
    Route::get('/dropoff/{id}', 'ReservationDropoffsController@dropoff')
        ->name('reservation_dropoffs.reservation_dropoff.dropoff')
        ->where('id', '[0-9]+');
    Route::post('/process/{id}', 'ReservationDropoffsController@process')
        ->name('reservation_dropoffs.reservation_dropoff.process')
        ->where('id', '[0-9]+');

    Route::get('/processed/{id}', 'ReservationDropoffsController@processed')
        ->name('reservation_dropoffs.reservation_dropoff.processed')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'vehicles',
], function () {
    Route::get('/', 'VehiclesController@index')
        ->name('vehicles.vehicle.index');
    Route::get('/create', 'VehiclesController@create')
        ->name('vehicles.vehicle.create');
    Route::get('/show/{vehicle}', 'VehiclesController@show')
        ->name('vehicles.vehicle.show')
        ->where('id', '[0-9]+');
    Route::get('/{vehicle}/edit', 'VehiclesController@edit')
        ->name('vehicles.vehicle.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'VehiclesController@store')
        ->name('vehicles.vehicle.store');
    Route::put('vehicle/{vehicle}', 'VehiclesController@update')
        ->name('vehicles.vehicle.update')
        ->where('id', '[0-9]+');
    Route::delete('/vehicle/{vehicle}', 'VehiclesController@destroy')
        ->name('vehicles.vehicle.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'assets',
], function () {
    Route::get('/', 'AssetsController@index')
        ->name('assets.asset.index');
    Route::get('/create', 'AssetsController@create')
        ->name('assets.asset.create');
    Route::get('/show/{asset}', 'AssetsController@show')
        ->name('assets.asset.show')
        ->where('id', '[0-9]+');
    Route::get('/{asset}/edit', 'AssetsController@edit')
        ->name('assets.asset.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'AssetsController@store')
        ->name('assets.asset.store');
    Route::put('asset/{asset}', 'AssetsController@update')
        ->name('assets.asset.update')
        ->where('id', '[0-9]+');
    Route::delete('/asset/{asset}', 'AssetsController@destroy')
        ->name('assets.asset.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'vehicle_sizes',
], function () {

    Route::get('/', 'VehicleSizesController@index')
        ->name('vehicle_sizes.vehicle_size.index');
    Route::get('/create', 'VehicleSizesController@create')
        ->name('vehicle_sizes.vehicle_size.create');
    Route::get('/show/{vehicleSize}', 'VehicleSizesController@show')
        ->name('vehicle_sizes.vehicle_size.show')
        ->where('id', '[0-9]+');
    Route::get('/{vehicleSize}/edit', 'VehicleSizesController@edit')
        ->name('vehicle_sizes.vehicle_size.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'VehicleSizesController@store')
        ->name('vehicle_sizes.vehicle_size.store');
    Route::put('vehicle_size/{vehicleSize}', 'VehicleSizesController@update')
        ->name('vehicle_sizes.vehicle_size.update')
        ->where('id', '[0-9]+');
    Route::delete('/vehicle_size/{vehicleSize}', 'VehicleSizesController@destroy')
        ->name('vehicle_sizes.vehicle_size.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'tests',
], function () {
    Route::get('/', 'TestsController@index')
        ->name('tests.test.index');
    Route::get('/create', 'TestsController@create')
        ->name('tests.test.create');
    Route::get('/show/{test}', 'TestsController@show')
        ->name('tests.test.show')
        ->where('id', '[0-9]+');
    Route::get('/{test}/edit', 'TestsController@edit')
        ->name('tests.test.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'TestsController@store')
        ->name('tests.test.store');
    Route::put('test/{test}', 'TestsController@update')
        ->name('tests.test.update')
        ->where('id', '[0-9]+');
    Route::delete('/test/{test}', 'TestsController@destroy')
        ->name('tests.test.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'texts',
], function () {
    Route::get('/', 'TextsController@index')
        ->name('texts.text.index');
    Route::get('/create', 'TextsController@create')
        ->name('texts.text.create');
    Route::get('/show/{text}', 'TextsController@show')
        ->name('texts.text.show')
        ->where('id', '[0-9]+');
    Route::get('/{text}/edit', 'TextsController@edit')
        ->name('texts.text.edit')
        ->where('id', '[0-9]+');
    Route::post('/', 'TextsController@store')
        ->name('texts.text.store');
    Route::put('text/{text}', 'TextsController@update')
        ->name('texts.text.update')
        ->where('id', '[0-9]+');
    Route::delete('/text/{text}', 'TextsController@destroy')
        ->name('texts.text.destroy')
        ->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'drivers',
], function () {
    Route::get('/', 'DriversController@index')
        ->name('drivers.driver.index');
    Route::get('/create', 'DriversController@create')
        ->name('drivers.driver.create');
    Route::get('/show/{driver}', 'DriversController@show')
        ->name('drivers.driver.show')->where('id', '[0-9]+');
    Route::get('/{driver}/edit', 'DriversController@edit')
        ->name('drivers.driver.edit')->where('id', '[0-9]+');
    Route::post('/', 'DriversController@store')
        ->name('drivers.driver.store');
    Route::put('driver/{driver}', 'DriversController@update')
        ->name('drivers.driver.update')->where('id', '[0-9]+');
    Route::delete('/driver/{driver}', 'DriversController@destroy')
        ->name('drivers.driver.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'reservation_to_credits',
], function () {
    Route::get('/', 'ReservationToCreditsController@index')
        ->name('reservation_to_credits.reservation_to_credit.index');
    Route::get('/create', 'ReservationToCreditsController@create')
        ->name('reservation_to_credits.reservation_to_credit.create');
    Route::get('/show/{reservationToCredit}', 'ReservationToCreditsController@show')
        ->name('reservation_to_credits.reservation_to_credit.show')->where('id', '[0-9]+');
    Route::get('/{reservationToCredit}/edit', 'ReservationToCreditsController@edit')
        ->name('reservation_to_credits.reservation_to_credit.edit')->where('id', '[0-9]+');
    Route::post('/', 'ReservationToCreditsController@store')
        ->name('reservation_to_credits.reservation_to_credit.store');
    Route::put('reservation_to_credit/{reservationToCredit}', 'ReservationToCreditsController@update')
        ->name('reservation_to_credits.reservation_to_credit.update')->where('id', '[0-9]+');
    Route::delete('/reservation_to_credit/{reservationToCredit}', 'ReservationToCreditsController@destroy')
        ->name('reservation_to_credits.reservation_to_credit.destroy')->where('id', '[0-9]+');
});
