<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyController extends ApiController
{
  // SECTION Normal methods


  /**
   * ANCHOR Show user companies
   * Display a companies collection from the current user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function showUserCompanies()
  {
    $companies = User::find(auth('api')->user()->id)->companies;
    return $this->showAll($companies);
  }

  /**
   * ANCHOR Show a specific user company
   * Display a companies collection from the current user.
   *
   * @param  string  $id
   * @return \App\Traits\ApiResponser
   */
  public function showUserCompany($id)
  {
    $company = User::find(auth('api')->user()->id)->companies()->where('id', $id)->first();

    if (gettype($company) == "NULL") {
      return $this->errorResponse('La compañía requerida no esta asociada a este usuario o no se encuentra', 403);
    } else {
      return $this->showOne($company);
    }
  }

  /**
   * ANCHOR Store a company to the specific user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponser
   */
  public function storeUserCompany(Request $request)
  {
    $idUser = auth('api')->user()->id;

    $rules = [
      'companyName' => 'required',
      'documentType' => 'required',
      'documentNumber' => 'required',
      'billingEmail' => 'required',
    ];

    $this->validate($request, $rules);

    $form = $request->only(
      'companyName',
      'documentType',
      'documentNumber',
      'billingEmail',
    );

    $form['idUser'] = $idUser;
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

    $company = Company::create($form);

    return $this->showOne($company);
  }

  /**
   * ANCHOR Update current company
   * Update the logged user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $id
   * @return \App\Traits\ApiResponser
   */
  public function updateUserCompany(Request $request, $id)
  {
    $company = User::find(auth('api')->user()->id)->companies()->where('id', $id)->first();

    $company->fill($request->only([
      'companyName',
      'documentType',
      'documentNumber',
      'billingEmail',
    ]));

    $company->save();
    return $this->showOne($company);
  }

  /**
   * ANCHOR Destry current company
   * Update the logged user.
   *
   * @param  string  $id
   * @return \App\Traits\ApiResponser
   */
  public function destroyUserCompany($id)
  {
    $company = User::find(auth('api')->user()->id)->companies()->where('id', $id)->first();
    $deleted = Company::destroy($company->id);
    return $this->successResponse('La compañia ' . $id . ' ha sido eliminada.', 200);
  }

  // !SECTION End Admin methods

  // SECTION Admin methods

  /**
   * ANCHOR Show all companies
   * Display a companies collection from the current user.
   *
   * @return \App\Traits\ApiResponser
   */
  public function showAllCompanies()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(Company::all());
    }
  }

  /**
   * ANCHOR Show a specific company
   * Display a companies collection from the current user.
   *
   * @param string $id
   * @return \App\Traits\ApiResponser
   */
  public function showCompanyByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(Company::findOrFail($id));
    }
  }

  /**
   * ANCHOR Store a new company
   * Display a companies collection from the current user.
   *
   * @param string $id
   * @return \App\Traits\ApiResponser
   */
  public function storeCompanyByAdmin(Request $request, $id)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'user_id' => 'required',
        'companyName' => 'required',
        'documentType' => 'required',
        'documentNumber' => 'required',
        'billingEmail' => 'required',
      ];

      $this->validate($request, $rules);

      $form = $request->only(
        'user_id',
        'companyName',
        'documentType',
        'documentNumber',
        'billingEmail',
      );
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

      $company = Company::create($form);

      return $this->showOne($company);
    }
  }

  /**
   * ANCHOR Update current company
   * Update the logged user.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $id
   * @return \App\Traits\ApiResponser
   */
  public function updateCompanyByAdmin(Request $request, $id)
  {
    $company = Company::findOrFail($id);

    $company->fill($request->only([
      'companyName',
      'documentType',
      'documentNumber',
      'billingEmail',
    ]));

    $company->save();
    return $this->showOne($company);
  }

  /**
   * ANCHOR Destry current company
   * Update the logged user.
   *
   * @param  string  $id
   * @return \App\Traits\ApiResponser
   */
  public function destroyCompanyByAdmin($id)
  {
    $deleted = Company::destroy($id);
    return $this->successResponse('La compañia ' . $id . ' ha sido eliminada.', 200);
  }

  // !SECTION End Admin methods
}
