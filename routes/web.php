<?php

use App\Http\Livewire\Auth\ConfirmResetPassword;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Calender;
use App\Http\Livewire\CustomerPayment;
use App\Http\Livewire\Customers;
use App\Http\Livewire\CustomerSort;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Dragula;
use App\Http\Livewire\Event;
use App\Http\Livewire\ExpenseCategories;
use App\Http\Livewire\Expenses as LivewireExpenses;
use App\Http\Livewire\NewKanban;
use App\Http\Livewire\OrderAddComponent;
use App\Http\Livewire\OrderAddonsComponent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\OrderPreviewComponent;
use App\Http\Livewire\OrderStatusScreenComponent;
use App\Http\Livewire\Payments;
use App\Http\Livewire\PostComponent;
use App\Http\Livewire\PrintReport;
use App\Http\Livewire\PrintReport\OrderInvoice;
use App\Http\Livewire\PrintReport\PrintExpenses;
use App\Http\Livewire\PrintReport\PrintOrders;
use App\Http\Livewire\PrintReport\PrintPurchases;
use App\Http\Livewire\PrintReport\PrintSales;
use App\Http\Livewire\PrintReport\PrintStocks;
use App\Http\Livewire\PrintReport\PrintTax;
use App\Http\Livewire\RazorpayGateway;
use App\Http\Livewire\ReportCard;
use App\Http\Livewire\Reports\Daily;
use App\Http\Livewire\Reports\Expenses;
use App\Http\Livewire\Reports\Orders;
use App\Http\Livewire\Reports\Purchase;
use App\Http\Livewire\Reports\Sales;
use App\Http\Livewire\Reports\Stock;
use App\Http\Livewire\Reports\Tax;
use App\Http\Livewire\Select2;
use App\Http\Livewire\ServiceAddComponent;
use App\Http\Livewire\ServiceComponent;
use App\Http\Livewire\ServiceEditComponent;
use App\Http\Livewire\ServiceTypeComponent;
use App\Http\Livewire\Tools\MasterSettings;
use App\Http\Livewire\UserStatusScreen;
use App\Http\Livewire\WarehouseProducts;
use App\Http\Livewire\WarehousePurchase;
use App\Http\Livewire\WarehousePurchaseAdd;
use App\Http\Livewire\WarehousePurchaseEdit;
use App\Http\Livewire\WarehousePurchasePreview;
use App\Http\Livewire\WarehouseStock;
use App\Http\Livewire\WarehouseStockAdd;
use App\Http\Livewire\WarehouseStockEdit;
use App\Http\Livewire\WarehouseStockPreview;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/',[Login::class,'__invoke'])->middleware('guest')->name('login');
// Route::get('forgot',[ForgotPassword::class,'__invoke']);
// Route::get('/reset-password/{token}',[ConfirmResetPassword::class,'__invoke']);

Route::group(['middleware'=>['user_auth']], function()
{
    // Route::get('/dashboard',[Dashboard::class,'__invoke']);
    Route::prefix('customer')->group(function(){
        Route::get('/',[Customers::class,'__invoke']);
        Route::post('/add',[Customers::class,'save']);
    });

    Route::get('/report-card',[ReportCard::class,'__invoke']);
    Route::get('/print-report/{date1}/{date2}',[PrintReport::class,'__invoke']);
    Route::get('/logout',[Dashboard::class,'logout']);

    // Route::get('/expensecategory',[ExpenseCategories::class,'__invoke']);
    // Route::get('/expense',[LivewireExpenses::class,'__invoke']);

    // Route::prefix('report')->group(function(){
    //     Route::get('/expense',[Expenses::class,'__invoke']);
    //     Route::get('/daily',[Daily::class,'__invoke']);
    //     Route::get('/order',[Orders::class,'__invoke']);
    //     Route::get('/purchase',[Purchase::class,'__invoke']);
    //     Route::get('/sales',[Sales::class,'__invoke']);
    //     Route::get('/stock',[Stock::class,'__invoke']);
    //     Route::get('/tax',[Tax::class,'__invoke']);
    // });

    // Route::prefix('print')->group(function(){
    //     Route::get('/expense/{date1}/{date2}',[PrintExpenses::class,'__invoke']);
    //     Route::get('/orders/{date1}/{date2}/{status}',[PrintOrders::class,'__invoke']);
    //     Route::get('/purchase/{date1}/{date2}',[PrintPurchases::class,'__invoke']);
    //     Route::get('/sales/{date1}/{date2}',[PrintSales::class,'__invoke']);
    //     Route::get('/stocks',[PrintStocks::class,'__invoke']);
    //     Route::get('/tax/{date1}/{date2}/{filter}',[PrintTax::class,'__invoke']);
    //     Route::get('/order/invoice/{id}',[OrderInvoice::class,'__invoke']);
    // });

    // Route::prefix('tool')->group(function(){
    //     Route::get('/master',[MasterSettings::class,'__invoke']);
    // });

    // Route::prefix('service')->group(function(){
    //     Route::get('/',[ServiceComponent::class,'__invoke']);
    //     Route::get('/add',[ServiceAddComponent::class,'__invoke']);
    //     Route::get('/edit/{id}',[ServiceEditComponent::class,'__invoke']);
    //     Route::get('/type',[ServiceTypeComponent::class,'__invoke']);
    //     Route::get('/addon',[OrderAddonsComponent::class,'__invoke']);
    // });
    // Route::prefix('order')->group(function(){
    //     Route::get('/',[OrderComponent::class,'__invoke']);
    //     Route::get('/add',[OrderAddComponent::class,'__invoke']);
    //     Route::get('/preview/{id}',[OrderPreviewComponent::class,'__invoke']);
    // });
    // Route::get('status-screen',[OrderStatusScreenComponent::class,'__invoke']);

    // Route::prefix('payments')->group(function(){
    //     Route::get('/',[Payments::class,'__invoke']);
    //     Route::get('add/{id}',[CustomerPayment::class, '__invoke']);
    // });

    // Route::prefix('warehouse')->group(function(){
    //     Route::get('/stock',[WarehouseStock::class,'__invoke']);
    //     Route::get('/stock/add',[WarehouseStockAdd::class,'__invoke']);
    //     Route::get('/stock/preview/{id}',[WarehouseStockPreview::class,'__invoke']);
    //     Route::get('/stock/edit/{id}',[WarehouseStockEdit::class,'__invoke']);
    //     Route::get('/product',[WarehouseProducts::class,'__invoke']);
    //     Route::get('/purchase',[WarehousePurchase::class,'__invoke']);
    //     Route::get('/purchase/add',[WarehousePurchaseAdd::class,'__invoke']);
    //     Route::get('/purchase/edit/{id}',[WarehousePurchaseEdit::class,'__invoke']);
    //     Route::get('/purchase/preview/{id}',[WarehousePurchasePreview::class,'__invoke']);
    // });
    

});

// Route::get('/switchcase',[App\Http\Livewire\Switchcase::class,'__invoke']);
// Route::get('/summernote',[App\Http\Livewire\Summernote::class,'__invoke']);
// Route::get('/fileupload',[App\Http\Livewire\FileUploadComponent::class,'__invoke']);
// Route::get('/test',[App\Http\Livewire\Excercise::class,'__invoke']);
// Route::get('/slug',[PostComponent::class,'__invoke']);
// Route::get('/new-kanban',[NewKanban::class,'__invoke']);
// Route::get('/calender',[Event::class,'__invoke']);

// Route::get('/zoom-image',function(){
//     return view('/zoom-on-hover');
// });

// Route::get('/kanban',function(){
//     return view('/new-kanban');
// });

// Route::get('/user-status-screen',[UserStatusScreen::class,'__invoke']);
// Route::get('/sort-customer',[CustomerSort::class,'__invoke']);
// Route::get('/dragula',[Dragula::class,'__invoke']);
// Route::get('/select2', Select2::class);