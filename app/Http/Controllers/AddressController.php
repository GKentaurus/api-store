<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AddressController extends ApiController
{
  // SECTION Normal methods

  /**
   * ANCHOR Show company addresses
   *
   * @return \App\Traits\ApiResponser
   */
  public function showAllCompaniesAddresses($idCompany)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $idCompany)
      ->first()
      ->addresses;
    return $this->showAll($address);
  }

  /**
   * ANCHOR show the specific address of a company
   *
   * @param  int  $id
   * @return \App\Traits\ApiResponser
   */
  public function showCompanyAddress($idCompany, $idAddress)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $idCompany)
      ->first()
      ->addresses()
      ->where('id', $idAddress)
      ->first();

    if (gettype($address) == "NULL") {
      return $this->errorResponse('La dirección requerida no esta asociada a este usuario y compañia o no se encuentra', 403);
    } else {
      return $this->showOne($address);
    }
  }

  /**
   * ANCHOR Create and store a new address of a company
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponser
   */
  public function storeCompanyAddress(Request $request, $idCompany)
  {
    $rules = [
      'addressName' => 'required|min:3',
      'addressLine1' => 'required|min:7',
      'city' => 'required',
      'state' => 'required',
      'country' => 'required',
    ];

    $this->validate($request, $rules);

    $form = $request->only([
      'addressName',
      'addressLine1',
      'addressLine2',
      'city' => 'required',
      'state' => 'required',
      'country' => 'required',
    ]);
    $form['idCompany'] = $idCompany;
    $address = Address::create($form);

    return $this->showOne($address);
  }

  /**
   * ANCHOR Update a specific address of a company
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \App\Traits\ApiResponser
   */
  public function updateCompanyAddress(Request $request, $idCompany, $idAddress)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $idCompany)
      ->first()
      ->addresses()
      ->where('id', $idAddress)
      ->first();

    $address->fill($request->only([
      'addressName',
      'addressLine1',
      'addressLine2',
      'city',
      'state',
      'country'
    ]));

    $address->save();
    return $this->showOne($address);
  }

  /**
   * ANCHOR Delete the specific address of a company
   *
   * @param  int  $id
   * @return \App\Traits\ApiResponser
   */
  public function destroy($idCompany, $idAddress)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $idCompany)
      ->first()
      ->addresses()
      ->where('id', $idAddress)
      ->first();

    $deleted = Address::destroy($address->id);
    return $this->successResponse('La dirección ha sido eliminada.', 200);
  }

  // !SECTION End Normal methods

  // SECTION Admin methods

  /**
   * ANCHOR Show all addresses
   *
   * @return \App\Traits\ApiResponser
   */
  public function showAllAddresses()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(Address::all());
    }
  }

  /**
   * ANCHOR Show a specific address
   *
   * @param string $id
   * @return \App\Traits\ApiResponser
   */
  public function showAddressByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(Address::findOrFail($id));
    }
  }

  /**
   * ANCHOR Store and create a new address
   *
   * @param \Illuminate\Http\Client\Request $request
   * @return \App\Traits\ApiResponser
   */
  public function storeAddressByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'idCompany' => 'required',
        'addressName' => 'required|min:3',
        'addressLine1' => 'required|min:7',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
      ];

      $this->validate($request, $rules);

      $form = $request->only([
        'idCompany',
        'addressName',
        'addressLine1',
        'addressLine2',
        'city',
        'state',
        'country'
      ]);

      $address = Address::create($form);
      return $this->showOne($address);
    }
  }

  /**
   * ANCHOR Update a specific address
   *
   * @param string $id
   * @param \Illuminate\Http\Client\Request $request
   * @return \App\Traits\ApiResponser
   */
  public function updateAddressByAdmin(Request $request, $id)
  {
    if (Gate::allows('isAdmin')) {
      $address = Address::findOrFail($id);

      $address->fill($request->only([
        'addressName',
        'addressLine1',
        'addressLine2',
        'city',
        'state',
        'country'
      ]));
      return $this->showOne($address);
    }
  }

  /**
   * ANCHOR Destroy a specific address
   *
   * @param string $id
   * @return \App\Traits\ApiResponser
   */
  public function destroyAddressByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      $delete = Address::destroy($id);
      return $this->successResponse('La dirección ' . $id . ' ha sido eliminada.', 200);
    }
  }

  // !SECTION End Admin methods
}
