<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'AdminAuthController@register');
Route::post('/login', 'AdminAuthController@login');
Route::post('/logout', 'AdminAuthController@logout');



Route::post('/ngo/register', 'NgoAuthController@register');
Route::post('/ngo/login', 'NgoAuthController@login');
Route::post('/ngo/logout', 'NgoAuthController@logout');

Route::post('/business/register', 'BusinessAuthController@register');
Route::post('/business/login', 'BusinessAuthController@login');
Route::post('/business/logout', 'BusinessAuthController@logout');


Route::get('/admin','AdminsController@index');
Route::post('/admin','AdminsController@store');
Route::get('/admin/{id}','AdminsController@details');
Route::put('/admin/{id}','AdminsController@update');
Route::delete('/admin/{id}','AdminsController@destroy');

Route::get('/business','BusinessController@index');
Route::post('/business','BusinessController@store');
Route::get('/business/{id}','BusinessController@details');
Route::put('/business/{id}','BusinessController@update');
Route::delete('/business/{id}','BusinessController@destroy');

Route::get('/ngo','NgosController@index');
Route::post('/ngo','NgosController@store');
Route::get('/ngo/{id}','NgosController@details');
Route::put('/ngo/{id}','NgosController@update');
Route::delete('/ngo/{id}','NgosController@destroy');



Route::get('/food','FoodController@index');
Route::post('/food','FoodController@store');
Route::get('/food/{id}','FoodController@details');
Route::put('/food/{id}','FoodController@update');
Route::delete('/food/{id}','FoodController@destroy');




Route::get('/clothe','ClothesController@index');
Route::post('/clothe','ClothesController@store');
Route::get('/clothe/{id}','ClothesController@details');
Route::put('/clothe/{id}','ClothesController@update');
Route::delete('/clothe/{id}','ClothesController@destroy');


Route::get('/appliance','AppliancesController@index');
Route::post('/appliance','AppliancesController@store');
Route::get('/appliance/{id}','AppliancesController@details');
Route::put('/appliance/{id}','AppliancesController@update');
Route::delete('/appliance/{id}','AppliancesController@destroy');


Route::get('/testimonial','TestimonialsController@index');
Route::post('/testimonial','TestimonialsController@store');
Route::get('/testimonial/{id}','TestimonialsController@details');
Route::put('/testimonial/{id}','TestimonialsController@update');
Route::delete('/testimonial/{id}','TestimonialsController@destroy');



Route::group(['prefix' => 'business', 'middleware' => ['assign.guard:businesses','jwt.auth']],function ()
{
    Route::get('/business','BusinessController@index');
    // Route::put('update/{id}','BusinessController@update');

});
