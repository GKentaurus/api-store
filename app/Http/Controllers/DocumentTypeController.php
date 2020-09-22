<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\DocumentType;

class DocumentTypeController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->showAll(DocumentType::all());
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
      'abbreviation' => 'required|min:3|max:100',
      'documentDescription' => 'min:3|max:100',
    ];
    $this->validate($request, $rules);
    $form = $request->all();
    $user = DocumentType::firstOrCreate($form);

    return $this->showOne($user, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($documentType)
  {
    return $this->showOne(DocumentType::findOrFail($documentType));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $documentType)
  {
    return 'update ' . $documentType;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($documentType)
  {
    DocumentType::destroy($documentType);
  }
}
