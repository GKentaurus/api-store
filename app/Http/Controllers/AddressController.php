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
   * @param  int $company_id
   * @return \App\Traits\ApiResponser
   */
  public function showAllCompanyAddresses($company_id)
  {
    $addresses = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $company_id)
      ->first()
      ->addresses;
    return $this->showAll($addresses);
  }

  /**
   * ANCHOR show the specific address of a company
   *
   * @param  int  $company_id
   * @param  int  $address_id
   * @return \App\Traits\ApiResponser
   */
  public function showCompanyAddress($company_id, $address_id)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $company_id)
      ->first()
      ->addresses()
      ->where('id', $address_id)
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
   * @param  int  $company_id
   * @return \App\Traits\ApiResponser
   */
  public function storeCompanyAddress(Request $request, $company_id)
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
      'city',
      'state',
      'country',
    ]);
    $form['company_id'] = $company_id;
    $address = Address::create($form);

    return $this->showOne($address);
  }

  /**
   * ANCHOR Update a specific address of a company
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $company_id
   * @param  int  $address_id
   * @return \App\Traits\ApiResponser
   */
  public function updateCompanyAddress(Request $request, $company_id, $address_id)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $company_id)
      ->first()
      ->addresses()
      ->where('id', $address_id)
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
   * @param  int  $company_id
   * @param  int  $address_id
   * @return \App\Traits\ApiResponser
   */
  public function destroyCompanyAddress($company_id, $address_id)
  {
    $address = User::find(auth('api')->user()->id)
      ->companies()
      ->where('id', $company_id)
      ->first()
      ->addresses()
      ->where('id', $address_id)
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
  public function showAllAddressesByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(Address::all());
    }
  }

  /**
   * ANCHOR Show a specific address
   *
   * @param  int  $address_id
   * @return \App\Traits\ApiResponser
   */
  public function showAddressByAdmin($address_id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(Address::findOrFail($address_id));
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
        'company_id' => 'required',
        'addressName' => 'required|min:3',
        'addressLine1' => 'required|min:7',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
      ];

      $this->validate($request, $rules);

      $form = $request->only([
        'company_id',
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
   * @param int $address_id
   * @param \Illuminate\Http\Client\Request $request
   * @return \App\Traits\ApiResponser
   */
  public function updateAddressByAdmin(Request $request, $address_id)
  {
    if (Gate::allows('isAdmin')) {
      $address = Address::findOrFail($address_id);

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
   * @param int $address_id
   * @return \App\Traits\ApiResponser
   */
  public function destroyAddressByAdmin($address_id)
  {
    if (Gate::allows('isAdmin')) {
      $delete = Address::destroy($address_id);
      return $this->successResponse('La dirección ' . $address_id . ' ha sido eliminada.', 200);
    }
  }

  // !SECTION End Admin methods
}
