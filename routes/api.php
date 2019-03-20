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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Login


Route::post('create-lead', 'API\ApiGeneralController@createLead')->middleware('auth:api');
Route::post('create-activity', 'API\ApiGeneralController@createActivity')->middleware('auth:api');
Route::get('get-profile', 'API\ApiGeneralController@getProfile')->middleware('auth:api');
Route::get('leads', 'API\ApiGeneralController@indexLead')->middleware('auth:api');
Route::get('customers', 'API\ApiGeneralController@indexCustomer')->middleware('auth:api');
Route::get('opportunities', 'API\ApiGeneralController@indexOpportunity')->middleware('auth:api');
Route::get('get-leads', 'API\ApiGeneralController@getLeads');
Route::get('get-customers', 'API\ApiGeneralController@getCustomer');
Route::get('get-prospects', 'API\ApiGeneralController@getProspects');
Route::get('get-opportunities', 'API\ApiGeneralController@getOpportunities');
Route::get('activities', 'API\ApiGeneralController@indexActivity')->middleware('auth:api');
Route::get('prospects', 'API\ApiGeneralController@indexProspect')->middleware('auth:api');
Route::get('get-target', 'API\ApiGeneralController@getTarget')->middleware('auth:api');
Route::get('companies', 'API\CompanyController@index');

//firebase
Route::get('firebase_token/{firebase_token}', 'API\ApiGeneralController@setFirebaseToken')->middleware('auth:api');

Route::get('get-target','API\ApiGeneralController@getTarget')->middleware('auth:api');
Route::get('companies', 'API\CompanyController@index');
