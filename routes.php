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

    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Sample\Controllers\Admin',
        ], function () {

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
            'uses' => 'SampleAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/samples/edit', [
            'as' => 'samples.edit',
            'uses' => 'SampleAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/samples/edit', [
            'as' => 'samples.post',
            'uses' => 'SampleAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/samples/delete', [
            'as' => 'samples.delete',
            'uses' => 'SampleAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/samples/trash', [
            'as' => 'samples.trash',
            'uses' => 'SampleAdminController@trash'
        ]);

    });
});
