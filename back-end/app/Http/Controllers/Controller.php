<?php

namespace App\Http\Controllers;

use App\Common\Response\ApiResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param null $binding
     * @return ApiResponse
     */
    public function response($data = array(), $status = 0, $headers = [], $binding = null)
    {
        $statusCode = !empty($status) ? $status : $this->setStatusCode();
        $response = new ApiResponse($data, $statusCode, $headers);

        return $response;
    }

    /**
     * @return int
     */
    protected function setStatusCode()
    {
        $statusCode = 0;
        $request = app('request');

        switch ($request->method()) {
            case Request::METHOD_POST:
                $statusCode = 201;
                break;
            case Request::METHOD_GET:
            case Request::METHOD_PUT:
            case Request::METHOD_DELETE:
            case Request::METHOD_HEAD:
                $statusCode = 200;
                break;
        }

        return $statusCode;
    }
}
