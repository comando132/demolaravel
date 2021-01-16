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

}
