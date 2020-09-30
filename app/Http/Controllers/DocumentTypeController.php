<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Gate;

class DocumentTypeController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function showAllDocumentTypesByAdmin()
  {
    if (Gate::allows(('isAdmin'))) {
      return $this->showAll(DocumentType::all());
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $document_type_id
   * @return \Illuminate\Http\Response
   */
  public function showDocumentTypeByAdmin($document_type_id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(DocumentType::findOrFail($document_type_id));
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function storeDocumentTypeByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'abbreviation' => 'required|min:3|max:100',
        'description' => 'min:3|max:100',
      ];
      $this->validate($request, $rules);
      $form = $request->all();
      $user = DocumentType::firstOrCreate($form);

      return $this->showOne($user, 201);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $document_type_id
   * @return \Illuminate\Http\Response
   */
  public function updateDocumentTypeByAdmin(Request $request, $document_type_id)
  {
    if (Gate::allows('isAdmin')) {
      $documentType = DocumentType::findOrFail($document_type_id);
      $documentType->fill($request->only([
        'abbreviation',
        'description',
      ]));
      $documentType->save();
      return $this->showOne($documentType);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $document_type_id
   * @return \Illuminate\Http\Response
   */
  public function destroyDocumentTypeByAdmin($document_type_id)
  {
    if (Gate::allows('isAdmin')) {
      DocumentType::destroy($document_type_id);
    } else {
      return $this->errorResponse('No tiene permisos para ejecutar esta tarea', 403);
    }
  }
}
