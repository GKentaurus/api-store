<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
  public function login(Request $request)
  {
    $data = $request->only('email', 'password');

    if (Auth::attempt($data)) {
      // $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
      $token = Auth::user()->createToken('accessToken')->accessToken;
      // return response()->json(['token' => $token], 200);
      return $this->successResponse($token, 200);
    } else {
      return $this->errorResponse('Acceso no autorizado', 401);
    }
  }

  public function register(Request $request)
  {
    $rules = [
      'firstName' => 'required|min:3|max:100',
      'lastName' => 'required|min:3|max:100',
      'documentType' => 'required|numeric',
      'documentNumber' => 'required|numeric',
      'email' => 'required|email',
      'sendEmails' => 'required',
      'password' => 'required',
      'mobileNumber' => 'required|numeric|digits_between:6,15',
      'category' => 'required|numeric|min:1'
    ];
    $this->validate($request, $rules);

    $form = $request->all();
    $form['password'] = bcrypt($request->password);

    $serie = [71, 67, 59, 53, 47, 43, 41, 37, 29, 23, 19, 17, 13, 7, 3, 0];
    $document = $request['documentNumber'];
    $serie = array_reverse($serie);
    $document = array_reverse(str_split($document));
    $sum = 0;

    for ($i = 1; $i <= count($document); $i++) {
      $sum = $sum + ($serie[$i] * $document[$i - 1]);
    }

    $decimal = ($sum % 11);
    $form['verificationDigit'] = $decimal > 1 ? 11 - $decimal : $decimal;

    $user = User::create($form);

    $token = $user->createToken('API-store')->accessToken;

    return $this->successResponse($token, 200);
  }
}
