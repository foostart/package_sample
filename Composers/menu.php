<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use Foostart\Category\Helpers\FooCategory;
use Foostart\Category\Helpers\SortTable;
/*
|-----------------------------------------------------------------------
| GLOBAL VARIABLES
|-----------------------------------------------------------------------
|   $sidebar_items
|   $sorting
|   $order_by
|   $plang_admin = 'sample-admin'
|   $plang_front = 'sample-front'
*/
View::composer([
                'package-sample::admin.sample-edit',
                'package-sample::admin.sample-form',
                'package-sample::admin.sample-items',
                'package-sample::admin.sample-item',
                'package-sample::admin.sample-search',
                'package-sample::admin.sample-config',
                'package-sample::admin.sample-lang',
    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'sample-admin';
        $plang_front = 'sample-front';


        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/samples');
        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('sample-admin.sidebar.add') => [
                'url' => URL::route('samples.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('sample-admin.sidebar.list') => [
                "url" => URL::route('samples.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('sample-admin.sidebar.category') => [
                'url'  => URL::route('categories.list',['_key='.$key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('sample-admin.sidebar.config') => [
                "url" => URL::route('samples.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('sample-admin.sidebar.lang') => [
                "url" => URL::route('samples.lang', []),
                'icon' => '<i class="fa fa-language" aria-hidden="true"></i>'
            ],
        ];

        /**
         * $sorting
         * $order_by
         */
        /**
         * $sorting
         * $order_by
         */
        $orders = [
            '' => trans($plang_admin.'.form.no-selected'),
            'id' => trans($plang_admin.'.fields.id'),
            'sample_title' => trans($plang_admin.'.fields.title'),
            'updated_at' => trans($plang_admin.'.fields.updated_at'),
            'status' => trans($plang_admin.'.fields.status'),
        ];
        $sortTable = new SortTable();
        $sortTable->setOrders($orders);
        $sorting = $sortTable->linkOrders();

        //Order by
        $order_by = [
            'asc' => trans('category-admin.order.by-asc'),
            'desc' => trans('category-admin.order.by-des'),
        ];

        // assign to view
        $view->with('sidebar_items', $sidebar_items );
        $view->with('order_by', $order_by);
        $view->with('sorting', $sorting);
        $view->with('plang_admin', $plang_admin);
        $view->with('plang_front', $plang_front);
});
