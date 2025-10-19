<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Inicio
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-js', [AuthController::class, 'loginJs'])->name('login.js');

// Usuario (vista con el CRUD de productos/categorías)
Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario');

// Categorías (mini-CRUD)
Route::post('/usuario/categorias', [UsuarioController::class, 'storeCategoria'])
    ->name('usuario.categorias.store');

Route::delete('/usuario/categorias/{categoria}', [UsuarioController::class, 'destroyCategoria'])
    ->name('usuario.categorias.destroy');

// Productos (CRUD)
Route::post('/usuario/productos', [UsuarioController::class, 'storeProducto'])
    ->name('usuario.productos.store');

Route::put('/usuario/productos/{producto}', [UsuarioController::class, 'updateProducto'])
    ->name('usuario.productos.update');

Route::delete('/usuario/productos/{producto}', [UsuarioController::class, 'destroyProducto'])
    ->name('usuario.productos.destroy');
