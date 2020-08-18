<?php

use Illuminate\Support\Facades\Route;

/**
 * Rotas de Vendas
 */
Route::get('/sale/create', 'SaleController@create')->name('sale.create');


/**
 * Rotas de Produtos
 */
Route::get('/product/create', 'ProductController@create')->name('product.create');
Route::resource('/product', 'ProductController')->except('index', 'create', 'show');


/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/sales', function () {
    return view('crud_sales');
});
