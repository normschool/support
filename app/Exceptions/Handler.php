<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Validation\ValidationException;
use Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $code = $exception->getCode();
        $message = $exception->getMessage();
        if ($code < 100 || $code >= 600) {
            $code = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        if ($exception instanceof AuthenticationException || $exception instanceof UnauthorizedHttpException) {
            $code = \Illuminate\Http\Response::HTTP_UNAUTHORIZED;
        }

        if ($exception instanceof ModelNotFoundException) {
            $message = $exception->getMessage();
            $code = \Illuminate\Http\Response::HTTP_NOT_FOUND;

            if (preg_match('@\\\\(\w+)\]@', $message, $matches)) {
                $model = $matches[1];
                $model = preg_replace('/Table/i', '', $model);
                $message = "{$model} not found.";
            }
        }

        if ($exception instanceof ValidationException) {
            $validator = $exception->validator;
            $message = $validator->errors()->first();
            $code = \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        if ($exception instanceof PostTooLargeException) {
            $code = \Illuminate\Http\Response::HTTP_REQUEST_ENTITY_TOO_LARGE;
            $message = 'File too large';
        }

        if ($request->expectsJson() or $request->isXmlHttpRequest()) {
            return Response::json([
                'success' => false,
                'message' => $message,
            ], $code);
        }

        return parent::render($request, $exception);
    }
}
