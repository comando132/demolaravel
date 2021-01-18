<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller {
    protected $response = [
        'status' => false,
        'data' => [],
        'message' => null
    ];

    protected function sendResponse($data, $message = null) {
        $this->response['status'] = true;
        $this->response['data'] = $data;
        $this->response['message'] = $message;
        return response()->json($this->response, 200);
        exit;
    }

    protected function sendError($message, $code = 404) {
        $this->response['status'] = false;
        $this->response['message'] = $message;
        return response()->json($this->response, $code);
        exit;
    }
}
