<?php

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

Route::get('/',function(){
    return redirect()->route('cliente.index');
});

Auth::routes();

Route::prefix('/cliente')->group(function () {
    Route::get('', 'ClienteController@index')->name('cliente.index');
    Route::post('', 'ClienteController@store')->name('cliente.store');
    Route::get('/{edit}', 'ClienteController@edit')->name('cliente.edit');
    Route::put('{id}', 'ClienteController@update')->name('cliente.update');
    Route::delete('', 'ClienteController@delete')->name('cliente.delete');
});
