<?php

use Illuminate\Support\Facades\Route;




Route::get('/admin', function () {
    return 'hi admin';
});


route::namespace('Front')->group(function(){

       route::get('users', 'userController@showAdminName');
});

