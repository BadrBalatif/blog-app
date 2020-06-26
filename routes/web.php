<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

/**Route::get('/', function () {
    return view('welcome');
});  */



//example routes
/**Route::get('/test/{id?}', function(){
    return 'Badr';
})->name('test');
*/

//Namespace with Controller
/*
Route::group(['namespace' => 'Admin'], function(){

    route::get('second0', 'SecondController@showString0')->middleware('auth');
    route::get('second1', 'SecondController@showString1');
    route::get('second2', 'SecondController@showString2');
    route::get('second3', 'SecondController@showString3');

});

Route::get('login', function(){
    return 'must be login to access';
})->name('login');
*/

// resources
//Route::resource('news','NewsController');

// View
/**Route::get('index', 'Front\userController@getIndex');

Route::group(['namespace' => 'Front'], function(){
    
    Route::get('landing','userController@getLandingPage');
});  */

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function(){
   return view('welcome');
});  

Route::get('/redirect/{service}','SocialController@redirect');

Route::get('/callback/{service}','SocialController@callback');

// fillable & hidden
Route::get('fillable','CrudController@getOffers');

//best practice to insert data to DB


   // Route::get('store','CrudController@store');
Route::group(['prefix' =>LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], 
  function (){
     Route::group(['prefix' => 'offers'],
       function () {
          Route::get('create','CrudController@create');
          Route::post('store','CrudController@store')->name('offers.store');

          Route::get('edit/{offer_id}','CrudController@editOffer');
          Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
          Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offers.delete');
          Route::get('all','CrudController@getAllOffers')->name('offers.all');

      });
     Route::get('youtube','CrudController@getVideo');
});



