<?php namespace Foostart\Sample\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Sample\Models\Sample;

use Illuminate\Support\MessageBag as MessageBag;

class SampleValidator extends FooValidator
{

    protected $obj_sample;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'sample_name' => ["required"],
            'sample_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_sample = new Sample();

        // language
        $this->lang_front = 'sample-front';
        $this->lang_admin = 'sample-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'sample_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'sample_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
                ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'name' => [
                'key' => 'sample_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['sample_name']['min'],
                'max' => $_ln['sample_name']['max'],
            ],
            'description' => [
                'key' => 'sample_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['sample_description']['min'],
                'max' => $_ln['sample_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['sample_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['sample_description'], $params['description']) ? $flag : FALSE;
        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-sample');
        return $configs;
    }

        /**
     *
     * @param ARRAY $input
     * @return BOOLEAN
     */
    public function userValidate($input) {
        //set rules
        self::$rules = [
            'sample_name' => ["required"],
            'sample_email' => ["required", "email"],
            'sample_title' => ["required"],
            'sample_message' => ["required"],
        ];

        //validate
        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        return $flag;
    }

}