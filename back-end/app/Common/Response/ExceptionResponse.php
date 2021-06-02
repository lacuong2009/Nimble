<?php

namespace App\Common\Response;

use Illuminate\Http\Response;

/**
 * Class ExceptionResponse
 * @package App\Exceptions\Response
 */
class ExceptionResponse extends Response
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * ExceptionResponse constructor.
     * @param \Exception $exception
     * @param int        $status
     * @param array      $payload
     */
    public function __construct(\Exception $exception, $status = 500, $payload = [])
    {
        $this->statusCode = $status;
        $content          = $this->prepareException($exception, $payload);

        parent::__construct($content, $status);
    }

    /**
     * @param \Exception $exception
     * @return array
     */
    protected function prepareException(\Exception $exception, $payload = [])
    {
        $statusCode = $this->getStatusCode();

        if (! $message = $exception->getMessage()) {
            $message = sprintf('%d %s', $statusCode, Response::$statusTexts[$statusCode]);
        }

        $replacements = [
            'success' => false,
            'message' => $message,
            'code' => $statusCode,
        ];

        if ($code = $exception->getCode()) {
            $replacements['errorCode'] = $code;
        }

        if ($payload) {
            $replacements['payload'] = $payload;
        }

        if (config()->get('api.debug')) {
            $replacements['Debug'] = [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'previous' => $exception->getPrevious(),
                'class' => get_class($exception),
                'trace' => explode("\n", $exception->getTraceAsString()),
            ];
        }

        return $replacements;
    }
}
