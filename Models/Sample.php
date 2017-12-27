<?php namespace Foostart\Sample\Models;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class Sample extends FooModel {

    //table name
    protected $table = 'samples';

    //update record
    public $timestamps = TRUE;

    //list of field in table
    protected $fillable = [
        'sample_name',
        'category_id'
    ];

    //list of field in form
    protected $fields = [
        'sample_name' => 'category_name',
        'category_id' => 'category_id',
    ];


    protected $valid_ordering_fields = ['sample_id', 'sample_name', 'updated_at'];

    //Check filter name is valid
    protected $valid_fields_filter = ['sample_id', 'sample_name', 'updated_at'];
    //primary key
    protected $primaryKey = 'sample_id';

    //the number of items on page
    protected $perPage = 10;

    //is building category tree
    protected $isTree = TRUE;


    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);

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
        $item = $this->where($this->table.".$key", $params['id'])
                     ->first();
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
    protected function searchFilters(array $params = [], $elo){

        if($this->isValidFilters($params))
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
                                $this->isTree = FALSE;
                            }
                            break;
                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.sample_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.sample_description','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.sample_overview','LIKE', "%{$value}%");
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

        $elo = $elo->select(
               $this->table . '.*'
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

        $sample = $this->selectItem($params);

        if (!empty($sample)) {


            $sample->sample_name = $params['sample_name'];

            $sample->save();

            return $sample;
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

        $sample = self::create([
                    'sample_name' => $params['sample_name'],
        ]);
        return $sample;
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = []) {
        $sample = $this->selectItem($input);
        if ($sample) {
            return $sample->delete();
        }
        return FALSE;
    }

}