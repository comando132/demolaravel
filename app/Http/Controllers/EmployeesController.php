<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller {

    /**
     *
     */
    public function index() {
        $employees = [];
        $employees = Employee::getEmployees();
        return view('employees.index', compact('employees'));
    }
}
