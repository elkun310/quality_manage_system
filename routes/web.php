<?php

use App\Document;
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
    $documents = Document::count();
    return view('admin.home', compact('documents'));
})->name(HOME);

/**
 * Admin routes
 */
Route::prefix('document')->namespace('Admin')->group(function () {
   Route::get('', 'DocumentController@index')->name(DOCUMENT_INDEX);
   Route::get('create', 'DocumentController@create')->name(DOCUMENT_CREATE);
   Route::post('store', 'DocumentController@store')->name(DOCUMENT_STORE);
});
