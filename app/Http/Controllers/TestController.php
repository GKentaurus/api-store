<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends ApiController
{
  public function logged()
  {
    $idUser = auth('api')->user()->id;
    return $idUser;
  }

  public function unlogged()
  {
    return 'Access allowed out of middleware!';
  }
}
