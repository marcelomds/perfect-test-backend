<?php

use Illuminate\Support\Facades\Route;

/**
 * Tela de Dashboard
 */
Route::get('/', 'DashboardController@index')->name('dashboard');

/**
 * Rotas de Produtos
 */
Route::get('/product/create', 'ProductController@create')->name('product.create');
Route::resource('/product', 'ProductController')->except('index', 'create', 'show');

/**
 * Rotas de Vendas
 */
Route::get('/sale/create', 'SaleController@create')->name('sales.create');
Route::resource('sales', 'SaleController')->except('create', 'show');
