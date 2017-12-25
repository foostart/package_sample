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

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context']], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage sample
          |-----------------------------------------------------------------------
          | 1. List of samples
          | 2. Edit sample
          | 3. Delete sample
          | 4. Add new sample
          |
        */

        /**
         * list
         */
        Route::get('admin/samples/list', [
            'as' => 'samples.list',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/samples/edit', [
            'as' => 'samples.edit',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/samples/edit', [
            'as' => 'samples.post',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/samples/delete', [
            'as' => 'samples.delete',
            'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@delete'
        ]);

    });
});
