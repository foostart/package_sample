<?php namespace Foostart\Sample\Models;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class Sample extends FooModel {

    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs() {

        //table name
        $this->table = 'samples';

        //list of field in table
        $this->fillable = array_merge($this->fillable, [
            'sample_name',
            'sample_email',
            'sample_phone',
            'sample_title',
            'sample_description',

        ]);

        //list of fields for inserting
        $this->fields = array_merge($this->fields, [
            'sample_name' => [
                'name' => 'sample_name',
                'type' => 'Text',
            ],
             'sample_email' => [
                'name' => 'sample_email',
                'type' => 'Text',
            ],
            'sample_phone' => [
                'name' => 'sample_phone',
                'type' => 'Text',
            ],
            'sample_description' => [
                'name' => 'sample_description',
                'type' => 'Text',
            ],
            'sample_title' => [
                'name' => 'sample_title',
                'type' => 'Text',
            ],
        ]);
        
        //check valid fields for inserting
        $this->valid_insert_fields = array_merge($this->valid_insert_fields, [            
            'sample_title',
            'sample_email',
            'sample_phone',
            'sample_name',
            'sample_description',
        ]);

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'sample_id',
            'sample_name',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'status',
        ];

        //primary key
        $this->primaryKey = 'sample_id';

    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of categories
     */
    public function selectItems($params = array()) {

        //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo);

        //select fields
        $elo = $this->createSelect($elo);

        //order filters
        $elo = $this->orderingFilters($params, $elo);

        //paginate items
        $items = $this->paginateItems($params, $elo);

        return $items;
    }

    /**
     * Get a sample by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT sample
     */
    public function selectItem($params = array(), $key = NULL) {


        if (empty($key)) {
            $key = $this->primaryKey;
        }
       //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo, FALSE);

        //select fields
        $elo = $this->createSelect($elo);

        //id
        $elo = $elo->where($this->primaryKey, $params['id']);

        //first item
        $item = $elo->first();

        return $item;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = []){
        return $this;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params = [], $elo, $by_status = TRUE){

        //filter
        if ($this->isValidFilters($params) && (!empty($params)))
        {
            foreach($params as $column => $value)
            {
                if($this->isValidValue($value))
                {
                    switch($column)
                    {
                        case 'sample_name':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.sample_name', '=', $value);
                            }
                            break;
                        case 'sample_title':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.sample_title', '=', $value);
                            }
                            break;
                        case 'sample_phone':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.sample_phone', '=', $value);
                            }
                            break;
                        case 'sample_email':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.sample_email', '=', $value);
                            }
                            break;
                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.'.$this->field_status, '=', $value);
                            }
                            break;
                        
                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.sample_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.sample_description','LIKE', "%{$value}%");
                                });
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } 

        return $elo;
    }

    /**
     * Select list of columns in table
     * @param ELOQUENT OBJECT
     * @return ELOQUENT OBJECT
     */
    public function createSelect($elo) {

        $elo = $elo->select($this->table . '.*',
                            $this->table . '.sample_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params = [], $elo) {
        $items = $elo->paginate($this->perPage);

        return $items;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItem($params = [], $id = NULL) {

        if (empty($id)) {
            $id = $params['id'];
        }

        $item = $this->find($id);

        if (!empty($item)) {
            $dataFields = $this->getDataFields($params, $this->fields);
            
            foreach ($dataFields as $key => $value) {
                $item->$key = $value;
            }

            $item->save();
              //add new attribute
            $item->id = $item->sample_id;


            return $item;
        } else {
            return NULL;
        }
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT sample
     */
    public function insertItem($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);

        $item = self::create($dataFields);

        $key = $this->primaryKey;
        $item->id = $item->$key;

        return $item;
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = [], $delete_type) {

        $item = $this->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    return $item->fdelete($item);
                    break;
                case 'delete-forever':
                    return $item->delete();
                    break;
            }

        }

        return FALSE;
    }


    /**
     * Get list of statuses to push to select
     * @return ARRAY list of statuses
     */
    public function getPluckStatus() {
        $pluck_status = config('package-sample.status.list');
        return $pluck_status;
     }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT sample
     */
    public function insertSample($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);

        $sample = new Sample;
        $sample->fill($params);
        $sample->save();


        // $item = self::create($dataFields);

        // $key = $this->primaryKey;
        // $item->id = $item->$key;

        return $sample;
    }
}