<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->showAll(User::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
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

    return $this->showOne($user, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($user)
  {
    $user = User::findOrFail($user);
    return $user;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $user)
  {
    return 'update ' . $user;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($user)
  {
    USer::destroy($user);
  }
}
