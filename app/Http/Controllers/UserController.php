<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
  // SECTION User logged methods"

  /**
   * ANCHOR Show All Users model
   * Display a Users collection.
   *
   * @return \Illuminate\Http\Response
   */
  public function showAllUsers()
  {
    return $this->showAll(User::all());
  }

  /**
   * ANCHOR Show current user model
   * Display the logged user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function showCurrentUser()
  {
    $user = User::findOrFail(auth('api')->user()->id);
    return $this->showOne($user);
  }

  /**
   * ANCHOR Update current user model
   * Update the logged user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponser
   */
  public function updateCurrentUser(Request $request)
  {
    $user = User::findOrFail(auth('api')->user()->id);

    $user->fill($request->only([
      'firstName',
      'lastName',
      'mobileNumber',
      'age',
      'email',
      'sendEmails',
      'password',
    ]));

    if (!empty($request->password)) {
      $user->password = bcrypt($request->password);
      $user->save();
      $token = $user->createToken('API-store')->accessToken;
      return $this->successResponse($token, 201);
    } else {
      $user->save();
      return $this->showOne($user);
    }
  }

  /**
   * ANCHOR Delete current user model
   * Soft delete of the logged user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function deleteCurrentUser()
  {
    $user = User::destroy(auth('api')->user()->id);
    return $this->messageResponse('El usuario ha sido destruido');
  }

  // !SECTION End User logged methods




  // SECTION User methods by Admin

  /**
   * ANCHOR User created and stored by Admin
   * Admin can create and store a new user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponser
   */
  public function storeUserByAdmin(Request $request)
  {
    if (Gate::allows('adminPermission')) {
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

      $form = $request->only([
        'firstName',
        'lastName',
        'mobileNumber',
        'age',
        'email',
        'sendEmails',
        'password',
        'termsAndConditions'
      ]);
      $form['password'] = bcrypt($request->password);
      $user = User::create($form);

      return $this->showOne($user, 201);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Update current user model by Admin
   * Admin can update the user getted by args
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string $id
   * @return \App\Traits\ApiResponser
   */
  public function updateUserByAdmin(Request $request, $id)
  {
    if (Gate::allows('adminPermission')) {
      $user = User::findOrFail($id);

      $user->fill($request->only([
        'firstName',
        'lastName',
        'mobileNumber',
        'age',
        'email',
        'sendEmails',
        'password',
      ]));

      if (!empty($request->password)) {
        $user->password = bcrypt($request->password);
        $user->save();
        $token = $user->createToken('API-store')->accessToken;
        return $this->successResponse($token, 201);
      } else {
        $user->save();
        return $this->showOne($user);
      }
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Delete current user model
   * Soft delete of the logged user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function deleteUserByAdmin($id)
  {
    User::destroy($id);
    return $this->successResponse('El usuario ' . $id . ' ha sido destruido', 201);
  }

  // !SECTION End Admin methods
}
