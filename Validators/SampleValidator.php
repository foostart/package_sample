<?php namespace Foostart\Sample\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Sample\Models\Sample;

use Illuminate\Support\MessageBag as MessageBag;

class SampleValidator extends AbstractValidator
{

    protected static $rules = array(
        'sample_name' => ["required"],
    );

    protected static $messages = [];

    protected $obj_sample;

    public function __construct()
    {
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'required' => trans('sample-admin.required'),
            ];
        });
        $this->obj_sample = new Sample();
    }

    public function validate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors?$this->errors:new MessageBag();

        $flag = $this->isValidName($input)?$flag:FALSE;
        $flag = $this->isValidParent($input)?$flag:FALSE;

        return $flag;
    }


    /**
     * Validation inputed sample name
     * @param type $input
     * @return boolean
     */
    public function isValidName($input) {

        $flag = TRUE;

        $min_lenght = config('package-sample.name_min_length');
        $max_lenght = config('package-sample.name_max_length');
        $sample_name = @$input['sample_name'];

        if ((strlen($sample_name) < $min_lenght)  || ((strlen($sample_name) > $max_lenght))) {
            $this->errors->add('sample_name', trans('sample-admin.required_length', ['minlength' => $min_lenght, 'maxlength' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }


}