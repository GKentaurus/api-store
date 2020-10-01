<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
  use ApiResponser;
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array
   */
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {
    if (config('app.debug')) {

      $this->renderable(function (QueryException $e, $request) {
        return $this->errorResponse($e->errorInfo[2], 500);
      });
      $this->renderable(function (ModelNotFoundException $e) {
        $model = strtolower(class_basename($e->getModel()));
        return $this->errorResponse('No query result for ' . $model . 'model', 404);
      });
      $this->renderable(function (AuthenticationException $e) {
        return $this->errorResponse($e, 000);
      });
      $this->renderable(function (AuthorizationException $e) {
        return $this->errorResponse($e, 000);
      });
      $this->renderable(function (MethodNotAllowedHttpException $e) {
        return $this->errorResponse($e, 000);
      });
      $this->renderable(function (AuthenticationException $e) {
        return $this->errorResponse($e, 000);
      });
      $this->renderable(function (HttpException $e) {
        return $this->errorResponse($e->getMessage(), $e->getStatusCode());
      });
    }
  }

  public function convertValidationExceptionToResponse(ValidationException $e, $request)
  {
    $errors = $e->validator->errors()->getMessages();

    return $this->errorResponse($errors, 422);
  }
}
