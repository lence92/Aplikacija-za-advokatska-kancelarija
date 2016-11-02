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

Route::get('/', function (){
    return redirect('/home/'.date('Y-m-d'));
});

Route::auth();

Route::get('/home/{date?}', 'HomeController@index');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/addUser', 'AdminController@add_user');
    Route::post('/createUser', 'AdminController@create_user');

    Route::get('/editPassword', 'HomeController@editPassword');
    Route::post('/setPassword', 'HomeController@setPassword');

    Route::get('/allemployee', 'AdminController@allEmployee');
    Route::get('/editEmployee/{id}', 'AdminController@editEmployee');
    Route::post('/setEmployee/{id}', 'AdminController@setEmployee');
    Route::get('/deleteEmployee/{id}', 'AdminController@deleteEmployee');

    Route::get('/addCase', 'PartnerController@addCase');
    Route::post('/storeCase', 'PartnerController@storeCase');

    Route::get('/getCases', 'PartnerController@get_cases');
    Route::post('/getCase', 'PartnerController@one_case');
    Route::post('/selectLawyer', 'PartnerController@select_lawyer');
    Route::get('/predmet/{id}', 'PartnerController@show_case');

    Route::post('/uploadFile', 'PartnerController@upload_file');
    Route::get('/izbrisi_dokument/{id}', 'PartnerController@delete_document');

    Route::get('/moiDok', 'HomeController@siteMoiDokumenti');
    Route::get('/dodadiDokument', 'HomeController@dodadi_dokument');
    Route::post('/zacuvajDokument', 'HomeController@zacuvajDokument');

    Route::get('/editPredmet/{id}', 'PartnerController@edit_case');
    Route::post('/updateCase/{id}', 'PartnerController@update_case');
    Route::get('/deletePredmet/{id}', 'PartnerController@delete_case');

    Route::get('/addTask', 'HomeController@add_task');
    Route::post('/storeTask', 'HomeController@store_task');
    Route::get('/shtikliraj/{id}', 'HomeController@shtikliraj');
    Route::get('/deleteShtiklirno/{id}', 'HomeController@delete_shtiklirno');

    Route::get('/profile/{id}', 'HomeController@profile');
    Route::get('/editProfile', 'HomeController@editProfile');
    Route::post('/setProfile', 'HomeController@storeProfile');

    Route::get('/hearings', 'AdminController@hearings');
    Route::post('/saveHearing', 'AdminController@saveHearing');
    Route::get('/deleteHearing/{id}', 'AdminController@deleteHearing');

    Route::post('/search', 'HomeController@search');
});

Route::get('/proba', 'AdminController@proba');



