<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $code = $e->errorInfo[1];
        // if ($code == 1062) {
        //
        // }
        return $this->errorResponse($e->errorInfo[2], 500);
      });
    }
  }

  public function convertValidationExceptionToResponse(ValidationException $e, $request)
  {
    $errors = $e->validator->errors()->getMessages();

    return $this->errorResponse($errors, 422);
  }
}
