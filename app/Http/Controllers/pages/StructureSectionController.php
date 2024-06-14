<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Section;
use Illuminate\Http\Request;

class StructureSectionController extends Controller {
  public function sections() {
    return view('content.pages.structure.section.list');
  }

  public function sectionCreate() {
    $data['orgs'] = Organization::all();

    return view('content.pages.structure.section.create', $data);
  }

  public function sectionCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'organization', 'responsible', 'situation']);

    $section = new Section();

    $section->code = $data['code'];
    $section->name = $data['name'];
    $section->organization_id = $data['organization'];
    $section->responsible = $data['responsible'];
    $section->situation = $data['situation'];
    $section->save();

    return redirect()->route('structure-sections');
  }
  public function sectionUpdate(int $id) {
    $data['orgs'] = Organization::all();
    $data['section'] = Section::find($id);

    return view('content.pages.structure.section.update', $data);
  }

  public function sectionUpdateAction(int $id, Request $request) {
    $update = $request->only(['code', 'name', 'organization', 'responsible', 'situation']);

    $sectionUpdate = Section::find($id);

    $sectionUpdate->code = $update['code'];
    $sectionUpdate->name = $update['name'];
    $sectionUpdate->organization_id = $update['organization'];
    $sectionUpdate->responsible = $update['responsible'];
    $sectionUpdate->situation = $update['situation'];
    $sectionUpdate->save();

    return redirect()->route('structure-sections');
  }

  public function sectionDelete(int $id) {
    Section::where('id', $id)->delete();

    return redirect()->route('structure-sections');
  }
}
