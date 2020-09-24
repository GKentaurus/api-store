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
