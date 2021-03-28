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

Route::middleware('auth')->group( function(){

    
    Route::get('/view_icons', 'SaleController@view_icons')->name('view_icons');

    Route::post('/sales/salesreport', 'SaleController@sales_report')->name('sale_report_get');
    Route::get('/sales/salesreport/', 'SaleController@sales_report')->name('sale_report');
    
    Route::post('/payment/paymentreport', 'PaymentController@payment_report')->name('payment_report_get');
    Route::get('/payment/paymentreport/', 'PaymentController@payment_report')->name('payments_report');

    Route::post('/sales/session', 'SessionController@session')->name('session_check');
    Route::get('/sales/session', 'SessionController@session')->name('session_check');

    Route::post('/sales/session/new', 'SessionController@create_session')->name('new_session');
    Route::get('/sales/session/new', 'SessionController@create_session')->name('new_session');
   
    
    Route::post('/sales/session/continue', 'SaleController@createSale')->name('continue_session');
    Route::get('/sales/session/continue', 'SaleController@createSale')->name('continue_session');
    
    Route::post('/sales/session/close', 'SessionController@closesession')->name('close_session');
    Route::get('/sales/session/close', 'SessionController@closesession')->name('close_session');

    
    Route::post('/sales/session/destroy', 'SessionController@close_session_destroy')->name('close_session_save');
    Route::get('/sales/session/destroy', 'SessionController@close_session_destroy')->name('close_session_save');

    Route::post('/session/new', 'SessionController@newsession')->name('new_session_create');
    Route::get('/session/index', 'SessionController@index')->name('session_index');
    Route::post('/session/index', 'SessionController@index')->name('session_index');

   
    Route::get('/sales', 'SaleController@index')->name('sales_index');
    Route::post('/sales/delete', 'SaleController@cancelSale')->name('del_sale');
    Route::post('/sessions/show/{session_id}', 'sessionController@showSession')->name('show_sessions');
    Route::get('/sessions/show/{session_id}', 'sessionController@showSession')->name('show_sessions');

    
    Route::get('/companys', 'CompanyController@index')->name('company_index');
    Route::post('/companys/new', 'CompanyController@newCompany')->name('create_company');
    Route::get('/companys/new', 'CompanyController@createCompany')->name('new_company');
    Route::get('/companys/{company_id}', 'CompanyController@show')->name('show_company');
    Route::post('/companys/{company_id}', 'CompanyController@modify')->name('update_company');

    Route::get('/sale_orders/normal/new', 'SaleOrderController@createSaleOrder')->name('sale_order_create');
    Route::post('/sale_orders/normal/new', 'SaleOrderController@newSale')->name('sale_order_create');
    Route::get('/sale_orders/', 'SaleOrderController@index')->name('sale_orders');



    Route::get('/sales/normal/new', 'SaleController@createNormalSale')->name('normal_post');
    Route::post('/sales/normal/new', 'SaleController@createNormalSale')->name('normal_post');
    Route::get('/sales/normal/item_info', 'SaleController@item_info')->name('item_info');
	
	
Route::post('/sales/new_normal', 'SaleController@createNormalSale')->name('create_normal_pos');
Route::get('/sales/new_normal', 'SaleController@createNormalSale')->name('create_normal_pos');    
Route::get('/sales/newClothes', 'SaleController@createSaleClothes')->name('create_sale_clothes');
Route::get('/sales/new_normal_sell', 'SaleController@createNormalSale')->name('create_normal_sale');
Route::post('/sales/new_normal_sell', 'SaleController@newSale')->name('create_normal_sale');


Route::post('/sales/getPackages', 'ItemController@getItemPackages')->name('find_item_packages');

Route::post('/sales/find_pregnancy', 'ItemController@getPregnancy')->name('find_pregnancy');

Route::post('/sales/getInteractions', 'ItemController@getItemInteractions')->name('find_item_interactions');


Route::post('/sales/new', 'SaleController@newSale')->name('new_sale');

Route::post('/sales/create_new', 'SaleController@createSale')->name('create_sale');
Route::get('/sales/create_new', 'SaleController@createSale')->name('create_sale_get');
Route::get('/sales/returned', 'SaleController@returned_items')->name('returned_items');
Route::get('/sales/{sales_id}', 'SaleController@show')->name('show_sale');

Route::get('/sales/new_pos_sell/new_pos', 'SaleController@newPOSSale')->name('create_pos_sale_post');
Route::post('/sales/new_pos_sell/new_pos', 'SaleController@newPOSSaleAn2')->name('create_pos_sale_post');

Route::get('/sales/new_pos_sell/new', 'SaleController@createSale')->name('create_pos_sale');

Route::get('/tests', 'SaleController@tests')->name('tests');
Route::post('/tests', 'SaleController@tests')->name('testss');

Route::get('/update_freq', 'SaleController@update_freq')->name('update_freq');
Route::post('/update_freq', 'SaleController@update_freq')->name('update_freq');

Route::get('/update_dosage', 'SaleController@update_dosage')->name('update_dosage');
Route::post('/update_dosage', 'SaleController@update_dosage')->name('update_dosage');

Route::get('/update_uom', 'SaleController@update_uom')->name('update_uom');
Route::post('/update_uom', 'SaleController@update_uom')->name('update_uom');

    Route::get('/update_duration', 'SaleController@update_duration')->name('update_duration');
    Route::post('/update_duration', 'SaleController@update_duration')->name('update_duration');

    Route::get('/update_uod', 'SaleController@update_uod')->name('update_uod');
    Route::post('/update_uod', 'SaleController@update_uod')->name('update_uod');

    Route::get('/update_route', 'SaleController@update_route')->name('update_route');
    Route::post('/update_route', 'SaleController@update_route')->name('update_route');

    Route::get('/update_qty', 'SaleController@update_qty')->name('update_qty');
    Route::post('/update_qty', 'SaleController@update_qty')->name('update_qty');

    Route::get('/update_package', 'SaleController@update_package')->name('update_package');
    Route::post('/update_package', 'SaleController@update_package')->name('update_package');

    Route::get('/ajaxRequest2', 'SaleController@newSale2A')->name('new_sale_ajaxs');
Route::post('/ajaxRequest2', 'SaleController@newSale2A')->name('new_sale_ajax');
Route::get('/ajaxRequest3', 'SaleController@newSale3')->name('new_sale_ajaxss');
Route::post('/ajaxRequest3', 'SaleController@newSale3')->name('new_sale_ajaxssv');

Route::get('/get_pos_list', 'SaleController@get_pos_list')->name('get_pos_list');



//Route::get('/sales/salesreport', 'CustomerController@sales_report')->name('sale_report');
Route::get('/sales/reporter', 'CustomerController@reporter')->name('reporter');
Route::post('/sales/reporters', 'CustomerController@reporters')->name('reporters');

Route::get('/item/item_report', 'ItemController@item_report')->name('item_report');

Route::post('/add/add_new_customer', 'CustomerController@addCustomerNew')->name('add_new_customer');
Route::get('/add/add_new_customer', 'CustomerController@addCustomerNew')->name('add_new_customer');


    Route::post('/customers/new', 'CustomerController@newCustomer')->name('create_customer');
Route::get('/customers/new', 'CustomerController@createCustomer')->name('new_customer');
Route::get('/customers', 'CustomerController@index')->name('customer_index');
Route::get('/customers/report/', 'CustomerController@reporter')->name('customers_report');
Route::get('/customers/{customer_id}', 'CustomerController@show')->name('show_customer');
Route::post('/customers/del/{customer_id}', 'CustomerController@delete_customer')->name('del_customer');
Route::get('/customers/del/{customer_id}', 'CustomerController@delete_customer')->name('del_customer_get');
Route::post('/customers/{customer_id}', 'CustomerController@modify')->name('update_customer');


//Expenses
Route::post('/expenses/new', 'ExpenseController@newExpense')->name('create_expense');
Route::get('/expenses/new', 'ExpenseController@createExpense')->name('new_expense');
Route::get('/expenses/report/', 'ExpenseController@reporter')->name('expenses_report_get');
Route::post('/expenses/report/', 'ExpenseController@reporter')->name('expenses_report');
Route::post('/expenses/{expense_id}', 'ExpenseController@modify')->name('update_expense');
Route::get('/expenses', 'ExpenseController@index')->name('expense_index');
Route::get('/expenses/{expense_id}', 'ExpenseController@show')->name('show_expense');

    Route::get('/get_interactions', 'SaleController@get_interactions')->name('get_interactions');
    Route::post('/get_interactions', 'SaleController@get_interactions')->name('get_interactions');


// Suppliers
Route::post('/suppliers/sup/{supplier_id}', 'SupplierController@delete_supplier')->name('del_supplier');
Route::get('/suppliers/sup/{supplier_id}', 'SupplierController@delete_supplier')->name('del_supplier_get');
Route::post('/suppliers/new', 'SupplierController@newSupplier')->name('create_supplier');
Route::get('/suppliers/new', 'SupplierController@createSupplier')->name('new_supplier');
Route::post('/suppliers/{supplier_id}', 'SupplierController@modify')->name('update_supplier');
Route::get('/suppliers', 'SupplierController@index')->name('supplier_index');
Route::get('/suppliers/{supplier_id}', 'SupplierController@show')->name('show_supplier');


// Items
Route::post('/items/new', 'ItemController@newItem')->name('create_item');
Route::get('/items/new', 'ItemController@createItem')->name('new_item');
Route::get('/items', 'ItemController@index')->name('item_index');
Route::get('/items/{item_id}', 'ItemController@show')->name('show_item');


Route::get('/items/get_item', 'ItemController@ajax_items')->name('item_ajax');
Route::get('/Items/barcode/{item_id}', 'ItemController@show_barcode_history')->name('inventory_barcode_item');

Route::post('/items/item/{item_id}', 'ItemController@delete_item')->name('del_item');
Route::get('/items/item/{item_id}', 'ItemController@delete_item')->name('del_item_get');



Route::post('/items/items/item_month', 'ItemController@expiration_date_month')->name('month_age');
Route::get('/items/items/item_month', 'ItemController@expiration_date_month')->name('month_age');
Route::post('/items/items/item_three_month', 'ItemController@expiration_date_three')->name('three_age');
Route::get('/items/items/item_three_month', 'ItemController@expiration_date_three')->name('three_age');
Route::post('/items/items/item_six_month', 'ItemController@expiration_date_six')->name('six_age');
Route::get('/items/items/item_six_month', 'ItemController@expiration_date_six')->name('six_age');
Route::post('/items/items/item_year', 'ItemController@expiration_date_year')->name('year_age');
Route::get('/items/items/item_year', 'ItemController@expiration_date_year')->name('year_age');

Route::post('/items/items_expire/item_age', 'ItemController@expiration_date_user')->name('item_ages');
Route::get('/items/items_expire/item_age', 'ItemController@expiration_date_user')->name('item_ages');


Route::get('/items/items/item_threshold', 'ItemController@item_threshold')->name('item_threshold');
Route::post('/items/items/item_threshold', 'ItemController@item_threshold')->name('item_threshold');

Route::post('/items/{item_id}', 'ItemController@modify')->name('update_item');


// Items
Route::post('/itemsCategory/new', 'ItemCategoryController@newItemCategory')->name('create_itemCategory');
Route::get('/itemsCategory/new', 'ItemCategoryController@createItemCategory')->name('new_itemCategory');
Route::post('/itemsCategory/{item_id}', 'ItemCategoryController@modify')->name('update_itemCategory');
Route::get('/itemsCategory', 'ItemCategoryController@index')->name('item_indexCategory');
Route::get('/itemsCategory/{item_id}', 'ItemCategoryController@show')->name('show_itemCategory');

Route::get('sortable-table', 'ItemsController@create')->name('sortable-table');

// Purchase Route

Route::get('/purchase/new', 'PurchaseController@create')->name('add_purchase');
Route::post('/purchase/new', 'PurchaseController@store')->name('new_purchase');
Route::post('/purchases/delete', 'PurchaseController@cancelPurchase')->name('del_purchase');
Route::get('/purchases', 'PurchaseController@index')->name('purchase_index');
Route::get('/get/item/ids', 'PurchaseController@getItemIds');
Route::get('/purchase/report', 'PurchaseController@purchase_report')->name('purchase_report');
Route::post('/purchase/report', 'PurchaseController@purchase_report')->name('purchase_report');
Route::get('/purchase/{purchases_id}', 'PurchaseController@show')->name('show_purchase');


// Inventory Route
Route::get('/inventory/records', 'InventoryController@index')->name('inventory_record');
Route::post('/inventory/records', 'InventoryController@index')->name('inventory_record_report');

Route::get('/inventory/records/{item_id}', 'ItemController@show_item_history')->name('inventory_record_item');

//Route::post('/item/post', 'PurchaseController@test')->name('post_data');


// Accounts
Route::get('/accounts', 'AccountsController@index')->name('accounts_index');
Route::get('/accounts/new', 'AccountsController@createAccount')->name('create_account');
Route::post('/accounts/new', 'AccountsController@newAccount')->name('new_account');
Route::get('/accounts/{account_id}', 'AccountsController@show')->name('show_account');
Route::post('/accounts/{account_id}', 'AccountsController@modify')->name('update_account');


// journals
Route::get('/journals', 'JournalItemController@index')->name('journals_index');
Route::get('/journals/new', 'JournalItemController@createAccount')->name('create_journal');



// journal Items
Route::get('/journalItems', 'JournalItemController@index')->name('journalItems_index');
Route::get('/journalItems/new', 'JournalItemController@createAccount')->name('create_journalItem');



// Payment
Route::post('/paymentspos/new/', 'PaymentController@newPaymentPOS')->name('create_paymentPOS');
Route::get('/paymentspos/new/', 'PaymentController@createPaymentPOS')->name('new_paymentPOS');

Route::post('/paymentsales/new/', 'PaymentController@newPaymentSales')->name('create_paymentSales');
Route::get('/paymentsales/new/', 'PaymentController@createPaymentSales')->name('new_paymentSales');
Route::get('/paymentsales/new_pay', 'PaymentController@createPaymentSales2')->name('new_paymentSales2');
Route::get('/paymentsales', 'PaymentController@index_sales_payment')->name('index_sales_payment');
Route::get('/paymentsales/{payment_id}', 'PaymentController@show')->name('show_payment');

// Receipt
Route::post('/receiptsales/new/', 'ReceiptController@newReceiptSales')->name('create_receiptSales');
Route::get('/receiptsales/new/', 'ReceiptController@createReceiptSales')->name('new_receiptSales');
Route::get('/receiptsales/new_pay', 'ReceiptController@createReceiptSales2')->name('new_receiptSales2');
Route::get('/receiptsales', 'ReceiptController@index_sales_receipt')->name('index_sales_receipt');
Route::get('/receipt/{receipt_id}', 'ReceiptController@show')->name('show_reciept');

Route::post('/receiptsales/receiptreport', 'ReceiptController@receipt_report')->name('receipt_report_get');
Route::get('/receiptsales/receiptreport/', 'ReceiptController@receipt_report')->name('receipt_report');


Route::post('/paymentpurchases/new/{purchases_id}', 'PaymentController@newPaymentPurchases')->name('create_paymentPurchases');
Route::get('/paymentpurchases/new/{purchases_id}', 'PaymentController@createPaymentPurchases')->name('new_paymentPurchases');
Route::get('/paymentpurchases', 'PaymentController@index_purchase_payment')->name('index_purchases_payment');
Route::get('/paymentpurchases/{payment_id}', 'PaymentController@cancelSupplierPurchaces')->name('cancel_payment');
Route::get('/paymentspos/new_', 'PaymentController@new_paymentPurchase2')->name('new_paymentPurchase2');


// Damage Route

Route::post('/damages/new', 'DamageController@newDamage')->name('create_damage');
Route::get('/damages/new', 'DamageController@createDamage')->name('new_damage');
Route::post('/damages/delete', 'DamageController@cancelDamage')->name('del_damage');
Route::post('/damages/{damage_id}', 'DamageController@modify')->name('update_damage');
Route::get('/damages', 'DamageController@index')->name('damage_index');
Route::get('/damages/{damage_id}', 'DamageController@show')->name('show_damage');

Route::post('/damages/damagereport/get_damages', 'DamageController@damages_report')->name('damage_report_get');
Route::get('/damages/damagereport/get_damages', 'DamageController@damages_report')->name('damage_report');

// Adjustment

    Route::get('/adjustments/new2', 'AdjustmentController@createAdjustment2')->name('create_adjustment2');
    Route::post('/adjustments/new2', 'AdjustmentController@newAdjustment2')->name('new_adjustment2');

    Route::post('/adjustments/new', 'AdjustmentController@newAdjustment')->name('create_adjustment');
Route::get('/adjustments/new', 'AdjustmentController@createAdjustment')->name('new_adjustment');
Route::post('/adjustments/{adjustment_id}', 'AdjustmentController@modify')->name('update_adjustment');
Route::get('/adjustments', 'AdjustmentController@index')->name('adjustment_index');
Route::get('/adjustments/{adjustment_id}', 'AdjustmentController@show')->name('show_adjustment');



//Return

Route::post('/returns/new', 'ReturnController@newReturn')->name('create_return');
Route::get('/returns/new', 'ReturnController@createReturn')->name('new_return');
Route::post('/returns/{return_id}', 'ReturnController@modify')->name('update_return');
Route::get('/returns', 'ReturnController@index')->name('return_index');
Route::get('/returns/{return_id}', 'ReturnController@show')->name('show_return');



// Location

Route::post('/locations/new', 'LocationController@newLocation')->name('create_location');
Route::get('/locations/new', 'LocationController@createLocation')->name('new_location');
Route::post('/locations/{location_id}', 'LocationController@modify')->name('update_location');
Route::get('/locations', 'LocationController@index')->name('location_index');
Route::get('/locations/{location_id}', 'LocationController@show')->name('show_location');


// Location

Route::post('/transfers/new', 'TransferController@newTransfer')->name('create_transfer');
Route::get('/transfers/new', 'TransferController@createTransfer')->name('new_transfer');
Route::post('/transfers/delete', 'TransferController@cancelTransfer')->name('del_transfer');
Route::post('/transfers/{transfer_id}', 'TransferController@modify')->name('update_transfer');
//Route::post('/transfers/delete', 'TransferController@cancelTransfer')->name('del_transfer');
Route::get('/transfers', 'TransferController@index')->name('Transfer_index');
Route::get('/transfers/{transfer_id}', 'TransferController@show')->name('show_transfer');

//Route::post('/payments/{payment_id}', 'PaymentController@modify')->name('update_payment');
//Route::get('/payments', 'PaymentController@index')->name('payment_index');
//Route::get('/payments/{payment_id}', 'PaymentController@show')->name('show_payment');

//Profit loss Report


Route::get('/report/profit_loss_report/', 'SaleController@profit_loss')->name('profit_loss_report');
Route::post('/report/profit_loss_report/', 'SaleController@profit_loss')->name('profit_loss_report');


Route::get('/report/midterm/', 'PrintPoints@midterm')->name('print_mid_term');
Route::get('/report/achievement/', 'PrintPoints@achievement')->name('achievement');
Route::get('/report/roaster/', 'PrintPoints@roaster')->name('roaster');

// Suppliers
Route::post('/periods/new', 'PeriodController@newPeriod')->name('create_period');
Route::get('/periods/new', 'PeriodController@createPeriod')->name('new_period');
Route::post('/periods/{period_id}', 'PeriodController@modify')->name('update_period');
Route::get('/periods', 'PeriodController@index')->name('period_index');
Route::get('/periods/{period_id}', 'PeriodController@show')->name('show_period');


Route::get('/test_report', 'HomeController@index')->name('index_report_test');
Route::post('/test_report', 'HomeController@index')->name('index_report_test_2');


Route::get ( '/index_data', 'TestAjax@readItems' );
Route::post ( '/addItem', 'TestAjax@addItem' );

Route::get('ajaxRequest', 'HomeController@ajaxRequest');
Route::post('ajaxRequest', 'HomeController@ajaxRequestPost');


// Barcode
Route::get('/barcods/{item_id}', 'test1@index')->name('barcode_print');
Route::get('/barcods_variant/{item_id}', 'test1@index')->name('barcode_print_variant');

//Route::get('/barcods_variant/{item_id}', 'test1@index_variant')->name('barcode_print_variant');


    Route::post('/customerAddVital', 'CustomerController@add_vital_sign')->name('add_new_vital_sign');
    Route::get('/customerAddVital', 'CustomerController@add_vital_sign')->name('add_new_vital_signs');



    Route::post('/customerEditDiagnosis', 'CustomerController@edit_diagnosis')->name('edit_diagnosis');
    Route::get('/customerEditDiagnosis', 'CustomerController@edit_diagnosis')->name('edit_diagnosis');


    Route::post('/customerAddPrescription', 'CustomerController@add_perscription')->name('add_perscription');
    Route::get('/customerAddPrescription', 'CustomerController@add_perscription')->name('add_perscriptions');

    Route::post('/add_soap', 'CustomerController@add_soap')->name('add_soap');
    Route::get('/add_soap', 'CustomerController@add_soap')->name('add_soaps');

    Route::post('/customerAddAppointment', 'CustomerController@add_appointment')->name('add_appointment');
    Route::get('/customerAddAppointment', 'CustomerController@add_appointment')->name('add_appointments');

    Route::post('/customerAddDrugAllergy', 'CustomerController@add_new_drug_allergy')->name('add_new_drug_allergy');
    Route::get('/customerAddDrugAllergy', 'CustomerController@add_new_drug_allergy')->name('add_new_drug_allergys');


    Route::post('/customer/AddDrugHistory', 'CustomerController@add_new_drug_history')->name('add_new_drug_history');
    Route::get('/customer/AddDrugHistory', 'CustomerController@add_new_drug_history')->name('add_new_drug_historys');


    Route::post('/customer/DeleteVital', 'CustomerController@delete_vital')->name('delete_vital_sign');
    Route::get('/customer/DeleteVital', 'CustomerController@delete_vital')->name('delete_vital_signs');


    Route::post('/customer/DeleteAllergy', 'CustomerController@delete_allergy_sign')->name('delete_allergy_sign');
    Route::get('/customer/DeleteAllergy', 'CustomerController@delete_allergy_sign')->name('delete_allergy_signs');

    Route::post('/customer/DeletePerscription', 'CustomerController@delete_perscription')->name('delete_perscription');
    Route::get('/customer/DeletePerscription', 'CustomerController@delete_perscription')->name('delete_perscriptions');

    Route::post('/customer/delete_soap', 'CustomerController@delete_soap')->name('delete_soap');
    Route::get('/customer/delete_soap', 'CustomerController@delete_soap')->name('delete_soaps');


    Route::post('/customer/DeleteAppointment', 'CustomerController@delete_appointment')->name('delete_appointment');
    Route::get('/customer/DeleteAppointment', 'CustomerController@delete_appointment')->name('delete_appointments');

    Route::post('/customer/DeleteDiagnosis', 'CustomerController@delete_diagnosis')->name('delete_diagnosis');
    Route::get('/customer/DeleteDiagnosis', 'CustomerController@delete_diagnosis')->name('delete_diagnosiss');

    Route::post('/customer/DeleteDrugHistory', 'CustomerController@delete_drug_history')->name('delete_drug_history');
    Route::get('/customer/DeleteDrugHistory', 'CustomerController@delete_drug_history')->name('delete_drug_historys');

    Route::get('/customers/customerreport/{customer_id}', 'CustomerController@customer_history')->name('show_customer_history');

    Route::get('/regular_customers', 'CustomerController@index_regular')->name('regular_customer_index');

    Route::get('/test/createReceipt', 'SaleController@createReceipt')->name('create_receipt_test');



    Route::post('/customerEditVital', 'CustomerController@edit_vital_sign')->name('edit_vital_sign');
    Route::get('/customerEditVital', 'CustomerController@edit_vital_sign')->name('edit_vital_signs');

    Route::post('/customerDiagnosis', 'CustomerController@add_diagnosis')->name('add_new_diagnosis');
    Route::get('/customerDiagnosis', 'CustomerController@add_diagnosis')->name('add_new_diagnosiss');

    Route::post('/delete_drug_varitys', 'ItemController@delete_drug_varity')->name('delete_drug_varitys');
    Route::get('/delete_drug_varity', 'ItemController@delete_drug_varity')->name('delete_drug_varity');


    Route::get('/default_varity', 'ItemController@default_varity')->name('default_varity');
    Route::post('/default_varitys', 'ItemController@default_varity')->name('default_varitys');


    Route::get('/get_drug_varity_default', 'ItemController@get_drug_varity_default')->name('get_drug_varity_default');
    Route::post('/get_drug_varity_defaults', 'ItemController@get_drug_varity_default')->name('get_drug_varity_defaults');

    Route::post('/ajax_request_packages', 'AdjustmentController@getItemPackages')->name('find_adjustment_packages');
    Route::get('/ajax_request_packages', 'AdjustmentController@getItemPackages')->name('find_adjustment_packages');


    Route::post('/ajax_damage_packages', 'DamageController@getItemPackages')->name('find_damage_packages');
    Route::get('/ajax_damage_packages', 'DamageController@getItemPackages')->name('find_damage_packages');

    Route::get('/add_sales_item', 'SaleController@newSaleItemAdd')->name('new_sale_item_add');
Route::post('/add_sales_item', 'SaleController@newSaleItemAdd')->name('new_sale_item_add');


    Route::get('/get_qr', 'TestsController@get_qr')->name('get_qr');

    Route::get('/generate_qr', 'ItemController@generate_qr')->name('generate_qr');

    Route::any('/tables', function () {
    return view('templates/tables');
    });

    Route::any('/datatables', function () {
        return view('templates/datatables');
    });


});

Auth::routes(["verify"=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/vo_test', 'TestController@index')->name('vo_test');

Route::get('/customers_app', 'CustomerController@index')->name('customer_index_app');


Route::get('/sales/new_pos_sell/qr_sell', 'SaleController@newSale2Q')->name('pos_qr');
Route::post('/sales/new_pos_sell/qr_sell', 'SaleController@newSale2Q')->name('pos_qr');

Route::get('/get_all_sales_items', 'SaleController@get_all_sales_items')->name('get_all_sales_items');
Route::post('/get_all_sales_items', 'SaleController@get_all_sales_items')->name('get_all_sales_items');

Route::get('/get_all_sales_items_browser', 'SaleController@get_all_sales_items_browser')->name('get_all_sales_items_browser');
Route::post('/get_all_sales_items_browser', 'SaleController@get_all_sales_items_browser')->name('get_all_sales_items_browser');


Route::get('/qr_sell2', 'SaleController@newSale2Q')->name('qr_sell2');

Route::get('/sales/new_pos_sell/qr_sell_delete', 'SaleController@newSale2Q')->name('pos_qr');

Route::get('/sales/new_pos_sell/bro_sell_delete', 'SaleController@delete_transaction')->name('delete_transaction_bro');
Route::post('/sales/new_pos_sell/bro_sell_delete', 'SaleController@delete_transaction')->name('delete_transaction_bro');


// Get the list of items from DB
// Show them in z list



