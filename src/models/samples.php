<?php

namespace Foostart\Sample\Models;

use Illuminate\Database\Eloquent\Model;

class Samples extends Model {

    protected $table = 'samples';
    public $timestamps = false;
    protected $fillable = [
        'sample_name'
    ];
    protected $primaryKey = 'sample_id';

    public function get_samples($params = array()) {
        $sample = self::paginate(10);
        return $sample;
    }



    /**
     *
     * @param type $input
     * @param type $sample_id
     * @return type
     */
    public function update_sample($input, $sample_id = NULL) {

        if (empty($sample_id)) {
            $sample_id = $input['sample_id'];
        }

        $sample = self::find($sample_id);

        if (!empty($sample)) {

            $sample->sample_name = $input['sample_name'];

            $sample->save();

            return $sample;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_sample($input) {

        $sample = self::create([
                    'sample_name' => $input['sample_name'],
        ]);
        return $sample;
    }
}
