<?php

namespace App\Http\Controllers;

use App\Models\UserCategory;
use Illuminate\Http\Request;

class UserCategoryController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->showAll(UserCategory::all());
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
      'categoryName' => 'required|min:3',
      'idPriceList' => 'required',
      'active' => 'required',
    ];

    $this->validate($request, $rules);
    $form = $request->all();
    $userCategory = UserCategory::create($form);

    return $this->showOne($userCategory);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($userCategory)
  {
    return $this->showOne(UserCategory::findOrFail($userCategory));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $userCategory)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($userCategory)
  {
    UserCategory::destroy($userCategory);
  }
}
