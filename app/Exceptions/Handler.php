<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    OAuthServerException::class
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
   * @param $request
   * @param $e
   * @return JsonResponse|\Illuminate\Http\Response|Response
   * @throws Throwable
   */
  public function render($request, $e)
  {
    if ($e instanceof ThrottleRequestsException) {
      return response()->json(['message' => 'please slow down and wait 1 minute'], 425);
    }

    if ($this->isHttpException($e)) {
      $code = $e->getStatusCode();
      switch ($code) {
        case 400 :
          return response()->view("error.400");
        case 401 :
          return response()->view("error.401");
        case 403 :
          return response()->view("error.403");
        case 404 :
          return response()->view("error.404");
        case 410 :
          return response()->view("error.410");
        case 500 :
          return response()->view("error.500");
        case 502 :
          return response()->view("error.502");
        case 503 :
          return response()->view("error.503");
        default :
          return response()->view("error.504");
      }
    }

    return parent::render($request, $e);
  }
}
