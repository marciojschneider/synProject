<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Field;
use App\Models\Locality;
use Illuminate\Http\Request;

class FieldController extends Controller {
  public function fields() {
    return view('content.pages.structure.field.list');
  }

  public function fieldCreate() {
    $user = auth()->user();
    $data['farms'] = Farm::where('client_id', $user->in_client)->get();
    $data['localities'] = Locality::where('client_id', $user->in_client)->get();

    return view('content.pages.structure.field.create', $data);
  }

  public function fieldCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'farm', 'locality', 'total_area', 'productive_area', 'property_registration', 'local_group', 'situation']);

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatTotal = implode('', explode('.', $data['total_area']));

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatProductive = implode('', explode('.', $data['productive_area']));

    $field = new Field();
    $field->code = mb_strtoupper($data['code'], 'UTF-8');
    $field->name = mb_strtoupper($data['name'], 'UTF-8');
    $field->farm_id = $data['farm'];
    $field->total_area = number_format(floatval(implode('.', explode(',', $formatTotal))), 2, '.', '');
    $field->productive_area = number_format(floatval(implode('.', explode(',', $formatProductive))), 2, '.', '');
    $field->property_registration = mb_strtoupper($data['property_registration'], 'UTF-8');
    $field->local_group = mb_strtoupper($data['local_group'], 'UTF-8');
    $field->locality_id = $data['locality'];
    $field->situation = $data['situation'];
    $field->creation_user = $user->id;
    $field->client_id = $user->in_client;
    $field->save();

    return redirect()->route('structure-fields');
  }

  public function fieldUpdate(int $id) {
    $user = auth()->user();
    $data['farms'] = Farm::where('client_id', $user->in_client)->get();
    $data['localities'] = Locality::where('client_id', $user->in_client)->get();

    $data['field'] = Field::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['field']) {
      return redirect()->route('structure-fields');
    }

    return view('content.pages.structure.field.update', $data);
  }
  public function fieldUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'farm', 'locality', 'total_area', 'productive_area', 'property_registration', 'local_group', 'situation']);

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatTotal = implode('', explode('.', $update['total_area']));

    // TODO: Verificar necessidade de melhorar lógica, apenas aplicação provisória.
    $formatProductive = implode('', explode('.', $update['productive_area']));

    $fieldUpdate = Field::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$fieldUpdate) {
      return redirect()->route('structure-fields');
    }

    $fieldUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $fieldUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
    $fieldUpdate->farm_id = $update['farm'];
    $fieldUpdate->total_area = number_format(floatval(implode('.', explode(',', $formatTotal))), 2, '.', '');
    $fieldUpdate->productive_area = number_format(floatval(implode('.', explode(',', $formatProductive))), 2, '.', '');
    $fieldUpdate->property_registration = mb_strtoupper($update['property_registration'], 'UTF-8');
    $fieldUpdate->local_group = mb_strtoupper($update['local_group'], 'UTF-8');
    $fieldUpdate->locality_id = $update['locality'];
    $fieldUpdate->situation = $update['situation'];
    $fieldUpdate->save();

    return redirect()->route('structure-fields');
  }

  public function fieldDelete(int $id) {
    $user = auth()->user();
    Field::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-fields');
  }
}
