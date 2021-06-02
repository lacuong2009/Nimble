<?php

namespace App\Common\Response;

use Illuminate\Http\Response;


/**
 * Class ApiResponse
 * @package App\Common\Response
 */
class ApiResponse extends Response
{
    /**
     * ApiResponse constructor.
     * @param $content
     * @param int $status
     * @param array $headers
     */
    public function __construct($content, $status = 200, $headers = [])
    {
        $response = $this->buildResponse($content, $status);

        parent::__construct($response, $status, $headers);
    }

    /**
     * @param $data
     * @param $status
     * @return array
     */
    protected function buildResponse($data, $status)
    {
        $response             = new \App\Common\Response\ResponseModel();
        $response->data       = $data;
        $response->code       = $status;
        $response->success    = $status < 400;

        return (array)$response;
    }
}
