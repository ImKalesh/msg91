<?php

Route::group(['namespace' => 'Abackdev\User\app\Http\Controllers'],function(){
    
    Route::get('user','UserController@index');
    Route::get('sup',function(){
        return 'im second';
    });

});