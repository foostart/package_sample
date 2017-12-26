<?php namespace Foostart\Sample\Controllers\Admin;

use Foostart\Category\Library\Controllers\FooController;
use Illuminate\Http\Request;
use URL;
use Route,
    Redirect;
use Foostart\Sample\Models\Sample;
/**
 * Validators
 */
use Foostart\Sample\Validators\SampleValidator;

class SampleAdminController extends FooController {

    public $obj_sample = NULL;

    public function __construct() {

        $this->obj_sample = new Sample(array('per_page' => 10));
        $this->obj_validator = new SampleValidator();

        // set language files
        $this->plang_admin = 'sample-admin';
        $this->plang_front = 'sample-front';

        // package name
        $this->package_name = 'package-sample';

        // root routers
        $this->root_router = 'samples';
    }

    /**
     * With Super admin: show list of context key
     * With another users: show list of samples by context
     * @return view
     * @status publish
     */
    public function index(Request $request) {

        $params = $request->all();

        $items = $this->obj_sample->selectItems($params);

        $this->data_view = array_merge($this->data_view, array(
            'request' => $request,
            'params' => $params,
            'items' => $items,
        ));

        return view($this->package_name.'::admin.sample-items',$this->data_view);

    }

    /**
     * Edit existing sample by id - context
     * Add new sample by context
     * @return screen
     */
    public function edit(Request $request) {

        $params = $request->all();

        $items = $this->obj_sample->selectItems($params);

        $sample = NULL;
        $params['id'] = $request->get('id');

        if (!empty($params['id'])) {
            $sample = $this->obj_sample->selectItem($params);
        }

        $this->data_view = array_merge($this->data_view, array(
            'sample' => $sample,
            'samples' => $items,
            'request' => $request,
        ));
        return view($this->package_name.'::admin.sample-edit', $this->data_view);
    }

    /**
     * Processing data from POST method: add new item, edit existing item
     * @return edit page
     */
    public function post(Request $request) {

        $input = $request->all();

        $id = (int) $request->get('id');
        $sample = NULL;

        $data = array();

        if ($this->obj_validator->validate($input)) {

            //Update existing item
            if (!empty($id) && is_int($id)) {

                $sample = $this->obj_sample->find($id);

                if (!empty($sample)) {

                    $input['id'] = $id;
                    $sample = $this->obj_sample->updateItem($input);

                    //Message
                    return Redirect::route($this->root_router.'.edit', ["id" => $sample->id
                                                                ])
                                    ->withMessage('11');
                }

            //Add new item
            } else {

                $sample = $this->obj_sample->insertItem($input);

                if (!empty($sample)) {

                    //Message
                    return Redirect::route($this->root_router.'.edit', ["id" => $sample->id,
                                                            ])->withMessage('aa');
                }

            }
        } else {

            $errors = $this->obj_validator->getErrors();
            // passing the id incase fails editing an already existing item
            return Redirect::route($this->root_router.'.edit', $id ? ["id" => $id]: [])
                    ->withInput()->withErrors($errors);
        }

        $this->data_view = array_merge($this->data_view, array(
            'sample' => $sample,
            'request' => $request
                ), $data);

        return view($this->package_name.'::admin.sample-edit', $this->data_view);
    }

    /**
     * Delete sample
     * @return type
     */
    public function delete(Request $request) {

        $sample = NULL;
        $params = $request->all();
        $id = $request->get('id');

        if (!empty($id)) {
            $sample = $this->obj_sample->selectItem($params);

            if (!empty($sample)) {
                if ($this->obj_sample->deleteItem($params, $sample)) {
                    return Redirect::route($this->root_router.'.list')->withMessage(trans($this->plang_admin.'.delete-successful'));
                }
            }
        }
        return Redirect::route($this->root_router.'.list')->withMessage(trans($this->plang_admin.'.delete-unsuccessful'));
    }
}