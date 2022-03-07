<?php

use App\Document;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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
    Route::get('change-publish/{id}', 'DocumentController@changePublish')->name(DOCUMENT_CHANGE_PUBLISH);
    Route::get('export-pdf/{id}', 'DocumentController@exportPdf')->name(DOCUMENT_EXPORT_PDF);
    Route::get('{id}', 'DocumentController@show')->name(DOCUMENT_SHOW);
    Route::post('store', 'DocumentController@store')->name(DOCUMENT_STORE);
    Route::get('edit/{id}', 'DocumentController@edit')->name(DOCUMENT_EDIT);
    Route::post('update/{id}', 'DocumentController@update')->name(DOCUMENT_UPDATE);
    Route::delete('{id}', 'DocumentController@destroy')->name(DOCUMENT_DELETE);
});

/**
 * Learn Laravel Routes
 */
//Route::prefix('learn')->namespace('Learn')->group(function() {
//    Route::get('user/{id}', 'UserController@index');
//    Route::get('foo', 'ShowProfileController');
//
//    Route::get('photos/popular', function(){
//        echo 'popular';
//    });
//    //name route
//    Route::resource('photos', 'PhotoController')->names([
//        'create' => 'photos.build',
//        'update' => 'photos.upgrade',
//    ]);
//
//    //change parameter name
////    Route::resource('photos', 'PhotoController')->parameters([
////        'photos' => 'admin_photo'
////    ]);
//    //route api except create/edit
////    Route::apiResource('photos', 'PhotoController');
//});
