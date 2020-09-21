<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UsuarioController extends ApiController
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return 'create';
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
      'pNombre' => 'required|min:3|max:100',
      'sNombre' => 'min:3|max:100',
      'pApelido' => 'required|min:3|max:100',
      'sApelido' => 'min:3|max:100',
      'tipoDoc' => 'required|numeric',
      'numDoc' => 'required|numeric',
      'email' => 'required|email',
      'contrasena' => 'required',
      'telefPpal' => 'required|numeric|digits_between:1111111,9999999999999',
      'categoria' => 'required|numeric|min:1'
    ];
    $this->validate($request, $rules);

    $form = $request->all();

    $form['contrasena'] = bcrypt($request->contrasena);

    $serie = [71, 67, 59, 53, 47, 43, 41, 37, 29, 23, 19, 17, 13, 7, 3, 0];
    $documento = $request['numDoc'];

    $serie = array_reverse($serie);
    $documento = array_reverse(str_split($documento));

    $sum = 0;

    for ($i = 1; $i <= count($documento); $i++) {
      $sum = $sum + ($serie[$i] * $documento[$i - 1]);
    }

    $decimal = ($sum % 11);

    $form['digVerif'] = $decimal > 1 ? 11 - $decimal : $decimal;

    $user = User::create($form);

    return $this->showOne($user, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = User::findOrFail($id);
    return $user;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return 'edit ' . $id;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    return 'update ' . $id;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    return 'destroy ' . $id;
  }
}
