<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser {

  public function successResponse($data, $code = Response::HTTP_OK){

    $system = 'user';
    return response()->json(['data' => $data, 'database' => $system], $code);

  }
  public function successResponseAdmin($data, $code = Response::HTTP_OK){

    $system = 'user';
    return response()->json(['Admin' => $data, 'database' => $system], $code);

  }

  public function errorResponse($message, $code)
  {

    $system = 'user';
    return response()->json(['error' => $message, 'database' => $system, 'code' => $code], $code);
    
  }
}

