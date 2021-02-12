<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Office;
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

    function add(Request $request) {
        $id = $request->get('id');
        $employee = new Employee();
        $countries = Office::getCountryOffices();
        $offices = Office::getOffices();
        $chiefs = Employee::getChiefs();

        if ($request->isMethod('get')) {
            if (!empty($id)) {
                // buscar al employee
                $employee = Employee::getEmployee($id);
            }
        }
        return view('employees.add', compact('employee', 'countries', 'offices', 'chiefs'));
    }

}
