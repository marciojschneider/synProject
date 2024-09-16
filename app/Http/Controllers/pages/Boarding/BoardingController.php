<?php

namespace App\Http\Controllers\pages\Boarding;

use App\Http\Controllers\Controller;

class BoardingController extends Controller {
  public function boardings() {
    return view('content.pages.boarding.boarding.list');
  }

  public function boardingUpdate(int $id) {
    return view('content.pages.boarding.boarding.update', compact('id'));
  }

  public function boardingRead(int $id) {
    return view('content.pages.boarding.boarding.read', compact('id'));
  }

  public function boardingDetail(int $id) {
    return view('content.pages.boarding.boarding.detail', compact('id'));
  }

  // Data Manager
  public function boardingImport() {
    return view('content.pages.boarding.boarding.import');
  }

  public function boardingExport() {
    return view('content.pages.boarding.boarding.export');
  }
}
