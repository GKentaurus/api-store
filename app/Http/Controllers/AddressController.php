<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($user)
  {
    return $this->showAll(Address::all()->where('idUser', $user));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $user)
  {
    $rules = [
      'addressName' => 'required|min:3',
      'addressLine1' => 'required|min:7',
      'city' => 'required',
      'state' => 'required',
      'country' => 'required',
    ];

    $this->validate($request, $rules);
    $form = $request->all();
    $form['idUser'] = $user;
    $address = Address::create($form);

    return $this->showOne($address);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($user, $address)
  {
    if (Address::findOrFail($address)->idUser == $user) {
      return $this->showOne(Address::findOrFail($address));
    } else {
      return $this->errorResponse('La dirección requerida no corresponde al usuario indicado', 401);
    }
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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($address, $user)
  {
    if (Address::findOrFail($address)->idUser == $user) {
      Address::destroy($address);
    } else {
      return $this->errorResponse('La dirección requerida no corresponde al usuario indicado', 401);
    }
  }
}
