<?php

namespace App\Exceptions;

use App\Common\Response\ExceptionResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * @param Throwable $exception
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return ExceptionResponse
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException) {
            return new ExceptionResponse($exception, 401);
        }

        if ($exception instanceof NotFoundException) {
            return new ExceptionResponse($exception, 404);
        }

        if ($exception instanceof ValidationException) {
            return new ExceptionResponse($exception, 422);
        }

        if ($exception instanceof ClientException) {
            return new ExceptionResponse($exception, 422);
        }

        if ($exception instanceof \Exception) {
            return new ExceptionResponse($exception, 500);
        }
    }
}
