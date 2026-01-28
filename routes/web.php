<?php
use App\Livewire\VentaForm;
use Illuminate\Support\Facades\Route;
use App\Livewire\ClienteGestion;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
// Usa la dirección completa con la barra invertida "\" al principio
Route::get('/venta', \App\Livewire\VentaForm::class)->middleware('auth');
Route::get('/clientes', \App\Livewire\ClientesList::class)->name('clientes');
Route::get('/gestion/{saleId}', \App\Livewire\ClienteGestion::class)->name('clientes.gestion');