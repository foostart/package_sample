<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('sample', [
    'as' => 'sample',
    'uses' => 'Foostart\Sample\Controllers\Front\SampleFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        /**
         * list
         */
        Route::get('admin/sample', [
            'as' => 'admin_sample',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/sample/edit', [
            'as' => 'admin_sample.edit',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/sample/edit', [
            'as' => 'admin_sample.post',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/sample/delete', [
            'as' => 'admin_sample.delete',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@delete'
        ]);
    });
});
