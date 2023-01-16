<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EntrenoController;
use App\Http\Controllers\ClaseController;
use App\Http\Livewire\ChatComponent;
use App\Http\Livewire\Clases\IndexClases;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
    return view('landing');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Grupo de rutas del rol admin.
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        ], function() {

        // Usuarios
        Route::get('/usuarios', Usuarios::class)
            ->name('usuarios');

        // Roles
        Route::get('/roles', Roles::class)
            ->name('roles');

        // Calendario
        Route::get('/calendario', [CalendarController::class, 'index'])
            ->name('calendario');
        Route::get('/crearclase', [CalendarController::class, 'crearclase'])
            ->name('crearclase');

        // Obtención de eventos para el calendario
        Route::get('/admincalget', [CalendarController::class, 'getclase'])
        ->name('getclase');
    });

    Route::group([
        'middleware' => ['role:admin'],
    ], function() {
        // Entrenos
        Route::resource('/entrenos', EntrenoController::class);
        Route::get('/clases/{clase}/addEntreno', [ClaseController::class, 'addEntreno'])
            ->name('clases.addentreno');
        Route::post('/clases/{clase}/addEntreno', [ClaseController::class, 'addEntrenoUpdate'])
            ->name('clases.addentreno.update');
        Route::post('/clases/{clase}/deleteEntreno', [ClaseController::class, 'deleteEntrenoUpdate'])
            ->name('clases.deleteentreno.update');
    });

    // Facturación
    Route::get('/billing', [BillingController::class, 'index'])
        ->name('billing.index');

    // Descargar facturas Stripe
    Route::get('/user/invoice/{invoice}', function (Request $request, $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId);
    });

    // Reserva de clases
    Route::get('/clases', IndexClases::class)
        ->middleware('fullbox')
        ->name('clases.index');

    // Chat
    Route::get('/chat', ChatComponent::class)
        ->name('chat.index');
});
