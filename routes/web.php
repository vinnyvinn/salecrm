<?php

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

use App\Firebase\FirebaseHelper;
use App\User;

Route::get('/', function () {
    return redirect('dashboard');
});
Route::get('/test', function () {
    $test = new \App\Mail\EmailOnActionComplete('Test','Trial message from me','Geek manu');
    \Mail::to('geek@mail.com')->send($test);
    return response("mail");

});

Route::get('home', function () {
    return redirect('/');
});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('home');

    Route::get('leads', 'LeadController@index')->name('leads.index');
    Route::get('leads/create', 'LeadController@create')->name('leads.create');
    Route::post('leads/store', 'LeadController@store')->name('leads.store');
    Route::get('leads/edit/{lead}', 'LeadController@edit')->name('leads.edit');
    Route::post('leads/update/{lead}', 'LeadController@update')->name('leads.update');
    Route::post('leads/delete/{lead}', 'LeadController@destroy')->name('leads.delete');
    Route::get('leads/view/{lead}', 'LeadController@show')->name('leads.view');
    Route::get('leads/reviews/create/{lead_id}', 'ReviewController@create')->name('reviews.create');
    Route::post('leads/reviews/store', 'ReviewController@store')->name('reviews.store');

    Route::get('opportunities', 'OpportunityController@index')->name('opportunities.index');
    Route::get('opportunities/{opportunity}', 'OpportunityController@show')->name('opportunities.show');
//    Route::get('opportunities', 'OpportunityController@index');

    Route::get('prospects', 'ProspectController@index')->name('prospects.index');
    Route::get('prospects/create/{lead}', 'ProspectController@create')->name('prospects.create');
    Route::post('prospects/store/{lead}', 'ProspectController@store')->name('prospects.store');
    Route::get('prospects/show/{prospect}', 'ProspectController@show')->name('prospects.show');
    Route::get('prospects/edit/{prospect}', 'ProspectController@edit')->name('prospects.edit');
    Route::post('prospects/update/{prospect}', 'ProspectController@update')->name('prospects.update');
    Route::post('prospects/completed/{activity}', 'ProspectController@toggleCompletion')->name('prospects.activities.completed');
    Route::post('prospects/cancelled/{activity}', 'ProspectController@toggleCancellation')->name('prospects.activities.cancelled');
    Route::post('prospects/status/update/{prospect}', 'ProspectController@updateStatus')->name('prospects.status.update');
    Route::post('prospects/opportunity/create/{prospect}', 'ProspectController@createOpportunity');
    Route::post('opportunity/status/set/{opportunity}', 'OpportunityController@setStatus');

    Route::get('prospects/activities/create/{prospect}', 'ProspectController@createActivity')->name('prospects.activities.add');
    Route::post('prospects/activities/store/{prospect}', 'ProspectController@storeActivity')->name('prospects.activities.store');
    Route::get('prospects/activities/calendar/{prospect}', 'ProspectController@getCalendar')->name('prospects.activities.calendar');
    Route::get('prospects/activities/events', 'ProspectController@getEvents');

    Route::get('customer', 'CustomerController@index')->name('customer.index');
    Route::get('customer/create/{prospect}', 'CustomerController@create')->name('customer.create');
    Route::post('customer/store/{prospect}', 'CustomerController@store')->name('customer.store');
    Route::put('customer/update/{customer}', 'CustomerController@update')->name('customer.update');
    Route::get('customer/edit/{customer}', 'CustomerController@edit')->name('customer.edit');
    Route::get('customer/show/{customer}', 'CustomerController@show')->name('customer.show');
    Route::post('customers/companies/add/{customer}', 'CustomerController@addToCompany');
    Route::post('customers/opportunity/create/{customer}', 'CustomerController@createOpportunity');

    Route::get('customers/activities/create/{customer}', 'CustomerController@createActivity')->name('customers.activities.add');
    Route::post('customer/activities/store/{customer}', 'CustomerController@storeActivity')->name('customers.activities.store');
    Route::get('customer/activities/calendar/{customer}', 'CustomerController@showCalendar')->name('customers.activities.calendar');
    Route::post('customers/activities/cancel/{activity}')->name('customers.activities.cancelled');
    Route::post('customers/activities/completed/{activity}')->name('customers.activities.completed');
    Route::get('customers/activities/event', 'CustomerController@getEvents');
    // Route::get('customer/edit/{customer}', 'CustomerController@show')->name('customer.edit');
    // Route::get('customer/show/{customer}', 'CustomerController@show')->name('customers.activities.completed');    
    // Route::get('customer/show/{customer}', 'CustomerController@show')->name('customers.activities.add');    
    // Route::get('/', 'CustomerController@create')->name('customers.activities.cancelled');
    // Route::get('/', 'CustomerController@create')->name('customers.status.update');
    // Route:get('customer/')->name('customer.')

    Route::get('companies', 'CompanyController@index')->name('companies.index');
    Route::get('companies/select/{lead}', 'CompanyController@select')->name('companies.select');
    Route::get('companies/create', 'CompanyController@create')->name('companies.create');
    Route::post('companies/store', 'CompanyController@store')->name('companies.store');
    Route::get('companies/{company}', 'CompanyController@show')->name('companies.show');
    Route::get('companies/{company}/edit', 'CompanyController@edit')->name('companies.edit');
    Route::put('companies/{company}/update', 'CompanyController@update')->name('companies.update');

    Route::get('leads/reviews/create/{lead_id}', 'ReviewController@create')->name('reviews.create');
    Route::get('leads/reviews/edit/{review}', 'ReviewController@edit')->name('reviews.edit');
    Route::post('leads/reviews/store', 'ReviewController@store')->name('reviews.store');
    Route::put('leads/reviews/update/{review}', 'ReviewController@update')->name('reviews.update');

//    Question
    Route::resource('qualification-questions', 'LeadQuizController');
    Route::get('lead/{lead_id}/questionnaire', 'LeadQuizController@leadQuestionnaire');
    Route::post('store-lead/{lead_id}/questionnaire', 'LeadQuizController@storeQuestionnaire');
    Route::post('prospects/companies/add/{prospect}', 'ProspectController@addToCompany');

//    Team
    Route::resource('activity', 'ActivityController');
    Route::resource('team', 'TeamController');

    Route::get('target', 'TeamController@indexTarget');
    Route::get('target/{user_id}', 'TeamController@getTeamTarget');
    Route::get('create-target', 'TeamController@createTarget');
    Route::post('target/store', 'TeamController@storeTarget');

    //contact person
    Route::resource('contact-person','ContactPersonController');
});

Route::get('/firebase/{id}', function ($id) {
    $firebase = (new User)->firebaseID($id);
    $title = config('messages.push_lead_title');
    $message = config('messages.push_lead_body');
    $description = "Name:Manu El Geek, \n Phone:0722000000";
    $send = FirebaseHelper::sendFirebasePaymentNotification($title,$message,$firebase,$description);
    if ($send){
        return 'Sent';
    }
});