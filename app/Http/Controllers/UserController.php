<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
  // SECTION Normal methods

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
    return $this->successResponse('El usuario ha sido destruido', 200);
  }

  // !SECTION End User logged methods




  // SECTION Admin methods

  /**
   * ANCHOR Show all users
   * Display a Users collection.
   *
   * @return \App\Traits\ApiResponser
   */
  public function showAllUsers()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(User::all());
    }
  }

  /**
   * ANCHOR Show specific user
   * Display the logged user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function showUserByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      $user = User::findOrFail($id);
      return $this->showOne($user);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Create and store new user
   * Admin can create and store a new user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponser
   */
  public function storeUserByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
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
   * ANCHOR Update specific user model
   * Admin can update the user getted by args
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string $id
   * @return \App\Traits\ApiResponser
   */
  public function updateUserByAdmin(Request $request, $id)
  {
    if (Gate::allows('isAdmin')) {
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
   * ANCHOR Delete specific user model
   * Soft delete of the logged user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function deleteUserByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      User::destroy($id);
      return $this->successResponse('El usuario ' . $id . ' ha sido destruido', 201);
    }
  }

  // !SECTION End Admin methods
}
