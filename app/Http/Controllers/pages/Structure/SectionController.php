<?php

namespace App\Http\Controllers\pages\Structure;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller {
  public function sections() {
    return view('content.pages.structure.section.list');
  }

  public function sectionCreate() {
    $user = auth()->user();
    $data['orgs'] = Organization::where('client_id', $user->in_client)->where('situation', 1)->get();

    return view('content.pages.structure.section.create', $data);
  }

  public function sectionCreateAction(Request $request) {
    $data = $request->only(['code', 'name', 'organization', 'responsible', 'situation']);

    $section = new Section();
    $section->code = strtoupper($data['code']);
    $section->name = strtoupper($data['name']);
    $section->organization_id = $data['organization'];
    $section->responsible = $data['responsible'];
    $section->situation = $data['situation'];
    $section->save();

    return redirect()->route('structure-sections');
  }
  public function sectionUpdate(int $id) {
    $user = auth()->user();
    $data['orgs'] = Organization::where('client_id', $user->in_client)->get();
    $data['section'] = Section::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$data['section']) {
      return redirect()->route('structure-sections');
    }

    return view('content.pages.structure.section.update', $data);
  }

  public function sectionUpdateAction(int $id, Request $request) {
    $user = auth()->user();
    $update = $request->only(['code', 'name', 'organization', 'responsible', 'situation']);
    $sectionUpdate = Section::where('id', $id)->where('client_id', $user->in_client)->first();

    if (!$sectionUpdate) {
      return redirect()->route('structure-sections');
    }

    $sectionUpdate->code = strtoupper($update['code']);
    $sectionUpdate->name = strtoupper($update['name']);
    $sectionUpdate->organization_id = $update['organization'];
    $sectionUpdate->responsible = $update['responsible'];
    $sectionUpdate->situation = $update['situation'];
    $sectionUpdate->save();

    return redirect()->route('structure-sections');
  }

  public function sectionDelete(int $id) {
    $user = auth()->user();
    Section::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('structure-sections');
  }
}
