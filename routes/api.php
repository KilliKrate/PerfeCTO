<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// List companies
Route::get('companies', 'CompaniesController@index');

// List single company
Route::get('company/{id}', 'CompaniesController@show');

// Create new company
Route::post('company', 'CompaniesController@store');

// Update company
Route::put('company', 'CompaniesController@store');

// Delete company
Route::delete('company/{id}', 'CompaniesController@destroy');
