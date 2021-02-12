<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model {
    protected $table = 'offices';
    protected $primaryKey  = 'officeCode';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function employees() {
        return $this->hasMany(Employee::class, $this->primaryKey);
    }

    static function getCountryOffices() {
        return Office::select('country')->distinct()->orderBy('country')->get();
    }

    static function getOffices($conditions = []) {
        $data = Office::select('officeCode', 'country', 'city')->orderBy('country')->orderBy('city');
        if (!empty($conditions)) {
            foreach ($conditions as $cond => $val) {
                $data->where($cond, $val);
            }
        }
        return $data->get();
    }

}
