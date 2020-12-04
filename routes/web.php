<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\WorkController;
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
Route::get('/asd', function () {
    
    //$informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".\Request::ip());
    $informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=200.127.250.104");
    $dataSolicitud = json_decode($informacionSolicitud);

    return var_dump($dataSolicitud);
});

Route::view('/', 'intro.index')->name('home');

Route::get('/Categoria/{categoria}', [ProblemController::class, 'showCategoria'])->name('Categoria.show');
Route::post('/Contact/senMsg', [ProblemController::class, 'sendMessage'])->name('Problem.sendMessage');
Route::get('/Tecnico/{user}', [UserController::class, 'index'])->name('Tecnico.show');
Route::get('/Works/Pendientes', [WorkController::class, 'index'])->name('Work.index');
Route::get('/Work/show-work/{work}', [WorkController::class, 'showWork'])->name('Work.show');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');

    Route::get('/User', [UserController::class, 'index'])->name('User.index');
    Route::post('/User/edit-data/{user}', [UserController::class, 'editUserData'])->name('User.editUserData');
    Route::get('/User/postulacionTecnico/{user}/{categoria}', [UserController::class, 'postulacionTecnico'])->name('User.postulacionTecnico');


    /****ADMIN */
    Route::middleware('admin')->group(function () {
        Route::get('/Admin', [AdminController::class, 'index'])->name('Admin.index');
        Route::post('/Admin/createCategoria', [AdminController::class, 'createCategoria'])->name('Admin.createCategoria');
        Route::get('/Admin/deleteCategoria/{categoria}', [AdminController::class, 'deleteCategoria'])->name('Admin.deleteCategoria');
        Route::get('/Admin/editApproved/{tecno}/{approved}', [AdminController::class, 'editApproved'])->name('Admin.editApproved');

        
    });

    /****TECNICO */
    Route::middleware('tecnico')->group(function () {
        
        Route::post('/Work/show-work/{work}', [WorkController::class, 'postulate'])->name('Work.postulate');
    });
});
