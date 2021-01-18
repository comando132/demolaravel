<?php

namespace App\Http\Controllers\API;
use App\Models\Employee;
use Illuminate\Http\Request;

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
}