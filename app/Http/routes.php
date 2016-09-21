<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/template', function () {
    return view('template');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    Route::get('/search', 'RequestController@search');
    Route::get('/find', 'RequestController@find');
    Route::get('/request/create', 'RequestController@create');
    Route::get('/request/{id}', ['as' => 'showRequest', 'uses' => 'RequestController@show']);
    Route::get('/request/{id}/offer', ['as' => 'createOffer', 'uses' => 'OfferController@create']);
    Route::get('/request/{rid}/offer/select/{cid}', ['as' => 'selectRequest', 'uses' => 'RequestController@select']);
   // Route::get('/request/{id}/xml', 'RequestController@xml');
    Route::get('/offer', 'OfferController@index');

    Route::post('/request', 'RequestController@store');
    Route::post('/request/{id}/offer', ['as' => 'storeOffer', 'uses' => 'OfferController@store']);

});

