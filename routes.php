<?php

use Illuminate\Session\TokenMismatchException;

/**
 * USER
 */
Route::group(['middleware' => ['web', ], 'namespace' => 'Foostart\Sample\Controllers\User', ], function () {
    /**
    * list
    */
   Route::post('sample', [
       'as' => 'usersample.post',
       'uses' => 'SampleUserController@post'
   ]);
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {
    /**
     * sample
    */
    Route::get('samples/sample', [
        'as' => 'samples.sample',
        'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@sample'
    ]);
    Route::post('samples/sample', [
        'as' => 'samples.sample',
        'uses' => 'Foostart\Sample\Controllers\Admin\SampleAdminController@addSample'
    ]);




    Route::group(['middleware' => ['admin_logged', 'can_see', 'in_context'],
                  'namespace' => 'Foostart\Sample\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage sample
          |-----------------------------------------------------------------------
          | 1. List of sample
          | 2. Edit sample
          | 3. Delete sample
          | 4. Add new sample
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/samples', [
            'as' => 'samples',
            'uses' => 'SampleAdminController@index'
        ]);
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
         * copy
         */
        Route::get('admin/samples/copy', [
            'as' => 'samples.copy',
            'uses' => 'SampleAdminController@copy'
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

        /**
         * configs
        */
        Route::get('admin/samples/config', [
            'as' => 'samples.config',
            'uses' => 'SampleAdminController@config'
        ]);

        Route::post('admin/samples/config', [
            'as' => 'samples.config',
            'uses' => 'SampleAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/samples/lang', [
            'as' => 'samples.lang',
            'uses' => 'SampleAdminController@lang'
        ]);

        Route::post('admin/samples/lang', [
            'as' => 'samples.lang',
            'uses' => 'SampleAdminController@lang'
        ]);

        /**
         * search
        */
        Route::get('admin/samples/search', [
                'as' => 'samples.search',
                'uses' => 'SampleAdminController@search'
        ]);



    });
});
