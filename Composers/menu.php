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
|   $plang_admin = 'contact-admin'
|   $plang_front = 'contact-front'
*/
View::composer([
                'package-contact::admin.contact-edit',
                'package-contact::admin.contact-form',
                'package-contact::admin.contact-items',
                'package-contact::admin.contact-item',
                'package-contact::admin.contact-search',
                'package-contact::admin.contact-config',
                'package-contact::admin.contact-lang',
    ], function ($view) {

        //Order by params
        $params = Request::all();

        /**
         * $plang-admin
         * $plang-front
         */
        $plang_admin = 'contact-admin';
        $plang_front = 'contact-front';


        $fooCategory = new FooCategory();
        $key = $fooCategory->getContextKeyByRef('admin/contacts');
        /**
         * $sidebar_items
         */
        $sidebar_items = [
            trans('contact-admin.sidebar.add') => [
                'url' => URL::route('contacts.edit', []),
                'icon' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
            ],
            trans('contact-admin.sidebar.list') => [
                "url" => URL::route('contacts.list', []),
                'icon' => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
            ],
            trans('contact-admin.sidebar.category') => [
                'url'  => URL::route('categories.list',['_key='.$key]),
                'icon' => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
            ],
            trans('contact-admin.sidebar.config') => [
                "url" => URL::route('contacts.config', []),
                'icon' => '<i class="fa fa-braille" aria-hidden="true"></i>'
            ],
            trans('contact-admin.sidebar.lang') => [
                "url" => URL::route('contacts.lang', []),
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
            'contact_title' => trans($plang_admin.'.fields.title'),
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
