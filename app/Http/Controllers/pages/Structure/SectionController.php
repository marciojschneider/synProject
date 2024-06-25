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
    $user = auth()->user();
    $data = $request->only(['code', 'name', 'organization', 'responsible', 'situation']);

    $section = new Section();
    $section->code = mb_strtoupper($data['code'], 'UTF-8');
    $section->name = mb_strtoupper($data['name'], 'UTF-8');
    $section->organization_id = $data['organization'];
    $section->responsible = $data['responsible'];
    $section->situation = $data['situation'];
    $section->creation_user = $user->id;
    $section->client_id = $user->in_client;
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

    $sectionUpdate->code = mb_strtoupper($update['code'], 'UTF-8');
    $sectionUpdate->name = mb_strtoupper($update['name'], 'UTF-8');
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
