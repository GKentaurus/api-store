<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->showAll(Company::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = [
      'idUser' => 'required',
      'companyName' => 'required',
      'documentType' => 'required',
      'documentNumber' => 'required',
      'billingEmail' => 'required',
    ];

    $this->validate($request, $rules);

    $form = $request->only(
      'idUser',
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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return $this->showOne(Company::findOrFail($id));
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
  public function destroy($id)
  {
    Company::destroy($id);
  }
}
