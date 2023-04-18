<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayingPlanning\LayingPlanningsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\FabricConssController;
use App\Http\Controllers\FabricTypesController;
use App\Http\Controllers\FabricUsagesController;
use App\Http\Controllers\GlsController;
use App\Http\Controllers\CuttingOrdersController;
use App\Http\Controllers\CuttingTicketsController;
use App\Http\Controllers\StylesController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RemarksController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('home', App\Http\Controllers\HomeController::class);

    Route::get('profile', [UsersController::class,'profile'])->name('profile.index');
    Route::post('profile/change_password', [UsersController::class,'profile_change_password'])->name('profile.change-password');
});

// ## Route for Datatable
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user-data', [UsersController::class, 'dataUser']);
    Route::get('/buyer-data', [BuyerController::class, 'dataBuyer']);
    Route::get('/size-data', [SizesController::class, 'dataSize']);
    Route::get('/color-data', [ColorsController::class, 'dataColor']);
    Route::get('/fabric-cons-data', [FabricConssController::class, 'dataFabricCons']);
    Route::get('/fabric-type-data', [FabricTypesController::class, 'dataFabricType']);
    Route::get('/fabric-usage-data', [FabricUsagesController::class, 'dataFabricUsage']);
    Route::get('/remark-data', [RemarksController::class, 'dataRemark']);
    Route::get('/gl-data', [GlsController::class, 'dataGl']);
    Route::get('/style-data', [StylesController::class, 'dataStyle']);
    Route::get('/laying-planning-data', [LayingPlanningsController::class, 'dataLayingPlanning']);
    Route::get('/cutting-order-data', [CuttingOrdersController::class, 'dataCuttingOrder']);
    Route::get('/cutting-ticket-data', [CuttingTicketsController::class, 'dataCuttingTicket']);
    Route::get('/get-color-list', [ColorsController::class, 'get_color_list']);
});

Route::get('/layingReport/{serial_number}', [LayingPlanningsController::class, 'layingReport'])->name('layingReport');

// ## Route for Master Data (Admin)
Route::group(['middleware' => ['auth','can:admin-only']], function () {
    Route::resource('user-management', UsersController::class);
    Route::resource('buyer', BuyerController::class);
    Route::resource('size', SizesController::class);
    Route::resource('color', ColorsController::class);
    Route::resource('remark', RemarksController::class);
    
    Route::put('user-management/reset/{id}', [UsersController::class,'reset'])->name('user-management.reset');
});

// ## Route for Master Data (Cutting Department)
Route::group(['middleware' => ['auth','can:clerk-cutting']], function () {
    Route::resource('gl', GlsController::class);
    Route::resource('style', StylesController::class);

    Route::resource('fabric-cons', FabricConssController::class);
    Route::resource('fabric-type', FabricTypesController::class);
    Route::resource('fabric-usage', FabricUsagesController::class);
});

Route::group(['middleware' => ['auth','can:clerk']], function () {
    Route::resource('laying-planning',LayingPlanningsController::class);
    Route::get('/laying-planning-create', [LayingPlanningsController::class, 'layingCreate']);
    Route::get('/laying-planning-qrcode/{id}', [LayingPlanningsController::class, 'layingQrcode']);
    
    Route::controller(LayingPlanningsController::class)
    ->prefix('laying-planning-detail')->name('laying-planning.')->group(function(){
        route::post('/create', 'detail_create')->name('detail-create');
        route::put('/{id}', 'detail_update')->name('detail-update');
        route::delete('/{id}', 'detail_delete')->name('detail-delete');
        route::get('/{id}/edit', 'detail_edit')->name('detail-edit');
    });

    Route::resource('cutting-order', CuttingOrdersController::class);
    Route::get('cutting-order-create/{id}', [CuttingOrdersController::class,'createNota'])->name('cutting-order.createNota');
    Route::get('cutting-order-print/{id}', [CuttingOrdersController::class,'print_pdf'])->name('cutting-order.print');
    Route::get('cutting-order-detail/{id}', [CuttingOrdersController::class,'cutting_order_detail'])->name('cutting-order.detail');

    Route::resource('cutting-ticket', CuttingTicketsController::class);
    Route::prefix('cutting-ticket')->name('cutting-ticket.')->group(function(){
        Route::post('/generate', [CuttingTicketsController::class, 'generate_ticket'])->name('generate');
        Route::get('/print/{id}', [CuttingTicketsController::class, 'print_ticket'])->name('print');
    });
});

// ## Route for Fetch Select2 Form
Route::middleware(['auth','can:clerk'])->prefix('fetch')->name('fetch.')->group(function(){
    Route::get('/',[FetchController::class, 'index'])->name('index');
    Route::get('buyer', [FetchController::class, 'buyer'])->name('buyer');
    Route::get('style', [FetchController::class, 'style'])->name('style');
    Route::get('color', [FetchController::class, 'color'])->name('color');
    Route::get('fabric-type', [FetchController::class, 'fabric_type'])->name('fabric-type');
    
    Route::get('get-cutting-order/{id}', [CuttingTicketsController::class, 'get_cutting_order'])->name('cutting-order');
});