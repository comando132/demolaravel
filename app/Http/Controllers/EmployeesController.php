<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Office;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller {

    /**
     *
     */
    public function index() {
        $employees = [];
        $employees = Employee::getEmployees();
        return view('employees.index', compact('employees'));
    }

    public function add(Request $request, $id = null) {
        $employee = new Employee();
        if (!empty($id)) {
            // buscar al employee
            $employee = Employee::getEmployee($id);
        }
        if($request->isMethod('post')) {
            // validaciones
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => [
                    'required','email',
                    Rule::unique('employees')->ignore($employee->employeeNumber, 'employeeNumber'),
                ],
                'extension' => 'required',
                'jobTitle' => 'required',
                'reportsTo' => 'nullable|numeric',
                'officeCode' => 'required'
            ]);
            // se llena el modelo de empleado
            $employee->fill($request->all());
            // se guarda
            if ($employee->save()) {
                return Redirect::to('employees')->with('success', 'Se ha guardado el empleado.');
            } else {
                Session::flash('error', 'No se pudo guardar el empleado, intetalo nuevamente.');
            }
        }

        $countries = Office::getCountryOffices();
        $offices = Office::getOffices();
        $chiefs = Employee::getChiefs();
        return view('employees.add', compact('employee', 'countries', 'offices', 'chiefs', 'id'));
    }

    public function getOffices(Request $request) {
        $ciudad = $request->get('city');
        $oficinas = [];
        $offices = Office::getOffices(['country' => $ciudad]);

        if (!empty($offices)) {
            foreach($offices as $office) {
                $oficinas[$office->officeCode] = "{$office->country} - {$office->city}";
            }
        }
        return response()->json($oficinas);
    }

    public function delete(Request $request, $id) {
        if ($id > 1143) {
            $employee = Employee::findOrFail($id);
        }
        $type = 'success';
        $msg = "";
        try {
            $msg = "El empleado {$employee->firstName} {$employee->lastName} (#{$employee->employeeNumber}) se borro correctamente";
            if (!$employee->delete()) {
                $type = "failure";
                $msg = "No se pudo borrar el empleado {$employee->firstName} {$employee->lastName}";
            }
        } catch (\Exception $e) {
            $type = 'failure';
            $msg = 'No se pudo borrar el empleado';
        } finally {
            return Redirect::to('employees')->with($type, $msg);
        }

    }

}
