<?php namespace Foostart\Sample\Controllers\User;

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
use Illuminate\Support\Facades\App;

use Foostart\Category\Library\Controllers\FooController;
use Foostart\Sample\Models\Sample;
use Foostart\Sample\Validators\SampleValidator;


class SampleUserController extends FooController {

    public $obj_item = NULL;
    public $obj_category = NULL;

    public function __construct() {

        parent::__construct();
        // models
        $this->obj_item = new Sample();

        // validators
        $this->obj_validator = new SampleValidator();

        // set language files
        $this->plang_admin = 'sample-admin';
        $this->plang_front = 'sample-front';

        // package name
        $this->package_name = 'package-sample';
        $this->package_base_name = 'sample';

        // root routers
        $this->root_router = 'sample';

    }


    /**
     * Processing data from POST method: add new item, edit existing item
     * @return view edit page
     * @date 27/12/2017
     */
    public function post(Request $request) {

        $item = NULL;

        $params = $request->all();

        $is_valid_request = $this->isValidRequest($request);

        if ($is_valid_request && $this->obj_validator->userValidate($params)) {

            $item = $this->obj_item->insertItem($params);

            if (!empty($item)) {

                //message
                return Redirect::route($this->root_router, ["id" => $item->id])
                                ->withMessage(trans($this->plang_admin.'.actions.add-ok'));
            } else {

                //message
                return Redirect::route($this->root_router)
                                ->withMessage(trans($this->plang_admin.'.actions.add-error'));
            }


        } else { // invalid data
            $errors = $this->obj_validator->getErrors();

            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router)
                    ->withInput()->withErrors($errors);
        }
    }

}