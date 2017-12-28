<?php namespace Foostart\Sample\Controllers\Admin;

/*
|-----------------------------------------------------------------------
| SampleAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @website: http://foostart.com
| @date: 28/12/2017
|
*/


use Illuminate\Http\Request;
use URL, Route, Redirect;

use Foostart\Category\Library\Controllers\FooController;
use Foostart\Sample\Models\Sample;
use Foostart\Category\Models\Category;
use Foostart\Sample\Validators\SampleValidator;


class SampleAdminController extends FooController {

    public $obj_item = NULL;
    public $obj_category = NULL;

    public function __construct() {

        // models
        $this->obj_item = new Sample(array('per_page' => 10));
        $this->obj_category = new Category();

        // validators
        $this->obj_validator = new SampleValidator();

        // set language files
        $this->plang_admin = 'sample-admin';
        $this->plang_front = 'sample-front';

        // package name
        $this->package_name = 'package-sample';
        $this->package_base_name = 'sample';

        // root routers
        $this->root_router = 'samples';

        // page views
        $this->page_views = [
            'admin' => [
                'items' => $this->package_name.'::admin.'.$this->package_base_name.'-items',
                'edit'  => $this->package_name.'::admin.'.$this->package_base_name.'-edit',
            ]
        ];
    }

    /**
     * Show list of items
     * @return view list of items
     * @date 27/12/2017
     */
    public function index(Request $request) {

        $params = $request->all();

        $items = $this->obj_item->selectItems($params);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'items' => $items,
            'request' => $request,
            'params' => $params,
        ));

        return view($this->page_views['admin']['items'], $this->data_view);
    }

    /**
     * Edit existing item by {id} parameters OR
     * Add new item
     * @return view edit page
     * @date 26/12/2017
     */
    public function edit(Request $request) {

        $params = $request->all();

        $item = NULL;
        $params['id'] = $request->get('id', NULL);

        if (!empty($params['id'])) {
            $item = $this->obj_item->selectItem($params);
        }

        $categories = $this->obj_category->pluckSelect($params);

        // display view
        $this->data_view = array_merge($this->data_view, array(
            'item' => $item,
            'categories' => $categories,
            'request' => $request,
        ));
        return view($this->page_views['admin']['edit'], $this->data_view);
    }

    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function post(Request $request) {

        $item = NULL;

        $params = $request->all();

        $id = (int) $request->get('id');

        if ($this->obj_validator->validate($params)) {// valid data

            // update existing item
            if (!empty($id)) {

                $item = $this->obj_item->find($id);

                if (!empty($item)) {

                    $params['id'] = $id;
                    $item = $this->obj_item->updateItem($params);

                    // message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.edit.ok'));
                } else {

                    // message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.edit.error'));
                }

            // add new item
            } else {

                $item = $this->obj_item->insertItem($params);

                if (!empty($item)) {

                    //message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.add.ok'));
                } else {

                    //message
                    return Redirect::route($this->root_router.'.edit', ["id" => $item->id])
                                    ->withMessage(trans($this->plang_admin.'.add.error'));
                }

            }

        } else { // invalid data

            $errors = $this->obj_validator->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.edit', $id ? ["id" => $id]: [])
                    ->withInput()->withErrors($errors);
        }
    }

    /**
     * Delete existing item
     * @return view list of items
     * @date 27/12/2017
     */
    public function delete(Request $request) {

        $item = NULL;

        $params = $request->all();

        $id = (int)$request->get('id');

        if (!empty($id)) {

            $item = $this->obj_item->selectItem($params);

            if (!empty($item)) {

                if ($this->obj_item->deleteItem($params, $item)) {

                    return Redirect::route($this->root_router.'.list')
                            ->withMessage(trans($this->plang_admin.'.delete.ok'));
                }
            }
        }

        return Redirect::route($this->root_router.'.list')->withMessage(trans($this->plang_admin.'.delete.error'));
    }
}