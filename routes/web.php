<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\CarController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' =>[ 'auth:sanctum']],  function ()  {
    Route::get('/', function () {
        return redirect()->route('analyses.index');
    });
    Route::post('/trash', function () {
        return view('welcome');
    })->name('store.trash');
    Route::get('/map', function () {
        return view('dashboard.mapView');
    })->name('goma.map');


    Route::get('/vehicules', function () {
        return view('dashboard.vehicules');
    });
    Route::get('/agents', function () {
        return view('dashboard.agents');
    });
    Route::get('/settings', [ActivityController::class, 'settings'])->name('settings');
    Route::get('/oauth', [LogController::class, 'oauth']);
    Route::get('/accessdenied/{id}', [LogController::class, 'accessdenied']);
    Route::get('/access/{id}', [LogController::class, 'access']);
    Route::get('/activity', function () {
        return view('compte.activity');
    });
    // Route::get('/logs', function () {

    // });
    Route::get('/unauthorization', [LogController::class, 'unauthorization']);


    Route::get('/roles', function () {
        return view('users.roles');
    });
    Route::get('/role', function () {
        return view('users.role');
    });

    Route::get('/permissions', function () {
        return view('users.permissions');
    });
    Route::resources([
        'activity' => ActivityController::class,
        'analyses' => AnalyseController::class,
        'connection' => ConnectionController::class,
        'logs' => LogController::class,
        'notification' => NotificationController::class,
        'cars' => CarController::class,
        'user' => UserController::class,
        'search' => SelectController ::class,
        'documents' => DocumentController ::class,
    ], ['except' => ['update']]);
    Route::get('/customers', [UserController::class, 'customers']);
    Route::get('users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('cars/{id}', [CarController::class, 'update'])->name('car.update');
    Route::get('card/{id}', [CarController::class, 'preview'])->name('cars.preview');
    Route::get('/pdf', [CarController::class, 'generatePdf']);
    Route::get('/previewData/{id}', [CarController::class, 'previewData']);
    Route::post('document/{id}', [DocumentController::class, 'update'])->name('doc.update');
    Route::get('cars/delete/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('document/delete/{id}', [DocumentController::class, 'destroy'])->name('docs.destroy');
    Route::get('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/user/{id}', [UserController::class, 'update']);
     // select controller
     Route::get('/search/{search}/{id}', [SelectController::class, 'search'])->name('search');
     Route::get('/selectMarque', [SelectController::class, 'marque']);
     Route::get('/selectModel', [SelectController::class, 'model']);
     Route::get('/selectCarburateur', [SelectController::class, 'carburateur']);
     Route::get('/home', [AnalyseController::class, 'index'])->name('home');
    // Route::put('/users/{user}', 'UsersController@update');
});

Auth::routes();
Route::get('/token', function(){
    return csrf_token();
});
// Route::post('cars', [CarController::class, 'store'])->name('cars');

