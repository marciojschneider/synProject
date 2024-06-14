<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Field;
use App\Models\Locality;
use Illuminate\Http\Request;

class StructureFieldController extends Controller {
  public function fields() {
    return view('content.pages.structure.field.list');
  }

  public function fieldCreate() {
    $data['farms'] = Farm::all();
    $data['localities'] = Locality::all();

    return view('content.pages.structure.field.create', $data);
  }

  public function fieldCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'farm', 'locality', 'total_area', 'productive_area', 'property_registration', 'local_group', 'situation']);

    // TODO: Melhorar lógica, apenas aplicação provisória.
    $formatTotal = implode('', explode('.', $data['total_area']));

    // TODO: Melhorar lógica, apenas aplicação provisória.
    $formatProductive = implode('', explode('.', $data['productive_area']));

    $field = new Field();

    $field->code = $data['code'];
    $field->name = $data['name'];
    $field->farm_id = $data['farm'];
    $field->total_area = number_format(floatval(implode('.', explode(',', $formatTotal))), 2, '.', '');
    $field->productive_area = number_format(floatval(implode('.', explode(',', $formatProductive))), 2, '.', '');
    $field->property_registration = $data['property_registration'];
    $field->local_group = $data['local_group'];
    $field->locality_id = $data['locality'];
    $field->situation = $data['situation'];

    $field->save();

    return redirect()->route('structure-fields');
  }

  public function fieldUpdate(int $id) {
    $data['farms'] = Farm::all();
    $data['localities'] = Locality::all();

    $data['field'] = Field::find($id);

    return view('content.pages.structure.field.update', $data);
  }
  public function fieldUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'farm', 'locality', 'total_area', 'productive_area', 'property_registration', 'local_group', 'situation']);

    // TODO: Melhorar lógica, apenas aplicação provisória.
    $formatTotal = implode('', explode('.', $update['total_area']));

    // TODO: Melhorar lógica, apenas aplicação provisória.
    $formatProductive = implode('', explode('.', $update['productive_area']));

    $fieldUpdate = Field::find($id);

    $fieldUpdate->code = $update['code'];
    $fieldUpdate->name = $update['name'];
    $fieldUpdate->farm_id = $update['farm'];
    $fieldUpdate->total_area = number_format(floatval(implode('.', explode(',', $formatTotal))), 2, '.', '');
    $fieldUpdate->productive_area = number_format(floatval(implode('.', explode(',', $formatProductive))), 2, '.', '');
    $fieldUpdate->property_registration = $update['property_registration'];
    $fieldUpdate->local_group = $update['local_group'];
    $fieldUpdate->locality_id = $update['locality'];
    $fieldUpdate->situation = $update['situation'];

    $fieldUpdate->save();

    return redirect()->route('structure-fields');
  }

  public function fieldDelete(int $id) {
    Field::where('id', $id)->delete();

    return redirect()->route('structure-fields');
  }
}
