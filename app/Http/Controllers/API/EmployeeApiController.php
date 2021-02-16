<?php

namespace App\Http\Controllers\API;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeApiController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Employee::getEmployees();
        if (!$data->isEmpty()) {
            return $this->sendResponse($data);
        }
    }

    public function add(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => ['required','email','unique:employees'],
                'extension' => 'required',
                'jobTitle' => 'required',
                'reportsTo' => 'nullable|exists:App\Models\Employee,employeeNumber',
                'officeCode' => 'required|exists:App\Models\Office,officeCode'
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->messages(), 400);
            } else {
                $emp = Employee::create($request->all());
                return $this->sendResponse($emp, "Se ha guardado el empleado.");
            }
        } catch(\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }

    }

    public function update(Request $request, $id) {
        $data = [];
        $message = "";
        try {
            $employee = Employee::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => [
                    'required','email',
                    Rule::unique('employees')->ignore($employee->employeeNumber, 'employeeNumber'),
                ],
                'extension' => 'required',
                'jobTitle' => 'required',
                'reportsTo' => 'nullable|exists:App\Models\Employee,employeeNumber',
                'officeCode' => 'required|exists:App\Models\Office,officeCode'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->messages(), 400);
            } else {
                $employee->update($request->all());
                return $this->sendResponse($employee, 'Se ha guardado el empleado.');
            }
        } catch (\Exception $e) {
            $message = 'Se ha guardado el empleado.';
            return $this->sendError($message, 500);
        }
    }

    public function delete(Request $request, $id) {
        $message = "";
        $data = [];
        if ($id > 1143) {
            $employee = Employee::findOrFail($id);
        }
        try {
            $message = "El empleado #{$employee->employeeNumber} ({$employee->firstName} {$employee->lastName}) se eliminó correctamente.";
            $employee->delete();
            return $this->sendResponse($data, $message);
        } catch (\Exception $e) {
            $message = 'No se pudo borrar el empleado.';
            return $this->sendError($message, 500);
        }
    }
}
