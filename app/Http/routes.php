<?php

use Illuminate\Http\Request;
use App\Models\Dvd;

Route::get('/', 'WelcomeController@index');


// DVD Pages with Eloquent
Route::get('/dvds/create', 'DvdEloquentController@create');
Route::post('/dvds/createNew', 'DvdEloquentController@createNew');
Route::get('/genres/{genre_name}/dvds', 'DvdEloquentController@genres');

// DVD Search Page
Route::get('/dvds/search', 'DvdEloquentController@search');
Route::get('/dvds', 'DvdController@results');

// DVD Review Page
Route::get('/dvds/{id}', 'DvdController@review');
Route::post('/dvds/store', 'DvdController@storeDvd');

?>