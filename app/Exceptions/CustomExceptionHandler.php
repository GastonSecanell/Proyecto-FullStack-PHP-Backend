<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['success' => false, 'message' => 'Recurso no encontrado.'], 404);
        } elseif ($exception instanceof AuthorizationException) {
            return response()->json(['success' => false, 'message' => 'No tienes permisos para realizar esta acción.'], 403);
        } elseif ($exception instanceof ValidationException) {
            return response()->json(['success' => false, 'message' => $exception->validator->errors()->first()], 422);
        } elseif ($exception instanceof AuthenticationException) {
            return response()->json(['success' => false, 'message' => 'No autenticado.'], 401);
        } elseif ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            return response()->json(['success' => false, 'message' => Response::$statusTexts[$statusCode]], $statusCode);
        } else {
            return parent::render($request, $exception);
        }
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['success' => false, 'message' => 'No autenticado.'], 401);
    }
}
