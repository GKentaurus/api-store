<?php

namespace App\Http\Controllers;

use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserCategoryController extends ApiController
{
  // SECTION Admin methods
  /**
   * ANCHOR Show all user categories
   *
   * @return \Illuminate\Http\Response
   */
  public function showAllUserCategoriesByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(UserCategory::all());
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Show a specific user category
   *
   * @param  int  $user_category_id
   * @return \Illuminate\Http\Response
   */
  public function showUserCategoryByAdmin($user_category_id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(UserCategory::findOrFail($user_category_id));
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Create and store a new user category
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function storeUserCategoryByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'name' => 'required|min:3',
        'price_list_id' => 'required',
        'active' => 'required',
      ];

      $this->validate($request, $rules);
      $form = $request->all();
      $userCategory = UserCategory::create($form);

      return $this->showOne($userCategory);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Update a specific user category
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $user_category_id
   * @return \Illuminate\Http\Response
   */
  public function updateUserCategoryByAdmin(Request $request, $user_category_id)
  {
    if (Gate::allows('isAdmin')) {
      $userCategory = UserCategory::findOrFail($user_category_id);

      $userCategory->fill($request->only([
        'name',
        'price_list_id',
        'active',
      ]));

      $userCategory->save();
      return $this->showOne($userCategory);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * ANCHOR Delete a specific user category
   *
   * @param  int  $user_category_id
   * @return \Illuminate\Http\Response
   */
  public function destroyUserCategoryByAdmin($user_category_id)
  {
    if (Gate::allows('isAdmin')) {
      UserCategory::destroy($user_category_id);
      return $this->successResponse('La categoria ' . $user_category_id . ' ha sido eliminada.', 200);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }
  // !SECTION End Admin methods
}
