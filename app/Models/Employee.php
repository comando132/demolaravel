<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    protected $table = 'employees';
    protected $primaryKey  = 'employeeNumber';
    protected $fillable = [
        'lastName',
        'firstName',
        'extension',
        'email',
        'officeCode',
        'reportsTo',
        'jobTitle'
    ];
    public $incrementing = false;
    public $timestamps = false;

    public function office() {
        return $this->belongsTo(Office::class, 'officeCode');
    }

    public function chief() {
        return $this->belongsTo(Employee::class, 'reportsTo', $this->primaryKey);
    }


    static function getEmployees($filters=[]) {
        $data = Employee::select('*');
        if (isset($filters['firstName'])) {
            $data->where('firstName', 'like', "%{$filters['firstName']}%");
        }
        if (isset($filters['lastName'])) {
            $data->where('lastName', 'like', "%{$filters['lastName']}%");
        }
        if (isset($filters['email'])) {
            $data->where('email', 'like', "%{$filters['lastName']}%");
        }
        return  $data->get();
    }

    static function getEmployee($id) {
        $data = Employee::select('*');
        $data->where('employeeNumber', $id);
        return $data->first();
    }

    static function getChiefs() {
        return Employee::select('employeeNumber', 'firstName', 'lastName', 'jobTitle')->where('employeeNumber', '<=', '1143')->get();
    }




}
