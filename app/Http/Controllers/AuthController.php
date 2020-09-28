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
      'mobileNumber' => 'required|numeric|digits_between:6,15',
      'age' => 'required|numeric|min:18',
      'email' => 'required|email',
      'sendEmails' => 'required',
      'password' => 'required',
      'termsAndConditions' => 'required|numeric'
    ];
    $this->validate($request, $rules);

    $form = $request->only(
      'firstName',
      'lastName',
      'mobileNumber',
      'age',
      'email',
      'sendEmails',
      'password',
      'termsAndConditions'
    );
    $form['password'] = bcrypt($request->password);
    $form['category'] = 1;
    $user = User::create($form);

    $token = $user->createToken('API-store')->accessToken;

    return $this->successResponse($token, 201);
  }
}
