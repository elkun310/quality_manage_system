<?php

use App\Document;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Document as DocumentResource;
use App\Http\Resources\Documents as DocumentCollection;

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

Route::get('/test', function () {
//    dd(Document::first());
//    return new DocumentResource(Document::first());
//    return new DocumentCollection(Document::all());
//    return DocumentResource::collection(Document::all()->keyBy->id);
    return DocumentResource::collection(Document::all()->keyBy->id);
});

Route::get('user/{id}', function($id) {
    return "User page a";
})->where("id", "[0-9]+");

Route::get('user/{id}', function($id){
    if (!is_integer($id)) {
        return "user id 23123123123";
    }
    return "user page b";  
})->where("id", "[a-zA-Z]+");

// Route::get('user', function(){
//   return "Default User";  
// });

/**
 * Admin routes
 */
Route::prefix('document')->namespace('Admin')->group(function () {
    Route::get('', 'DocumentController@index')->name(DOCUMENT_INDEX);
    Route::get('create', 'DocumentController@create')->name(DOCUMENT_CREATE);
    Route::get('change-publish/{id}', 'DocumentController@changePublish')->name(DOCUMENT_CHANGE_PUBLISH);
    Route::post('complete/{id}', 'DocumentController@complete')->name(DOCUMENT_COMPLETE);
    Route::get('export-pdf/{id}', 'DocumentController@exportPdf')->name(DOCUMENT_EXPORT_PDF);
    Route::get('{id}', 'DocumentController@show')->name(DOCUMENT_SHOW);
    Route::post('store', 'DocumentController@store')->name(DOCUMENT_STORE);
    Route::get('edit/{id}', 'DocumentController@edit')->name(DOCUMENT_EDIT);
    Route::post('update/{id}', 'DocumentController@update')->name(DOCUMENT_UPDATE);
    Route::delete('{id}', 'DocumentController@destroy')->name(DOCUMENT_DELETE);
});
Route::prefix('transfer')->namespace('Admin')->group(function() {
    Route::get('', 'TransferFileController@index')->name(TRANSFER_FILE);
    Route::get('generate', 'TransferFileController@generateFile')->name(GENERATE_FILE);

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
