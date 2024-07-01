<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Imports Adicionais
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineHour extends Model {
  use HasFactory, SoftDeletes;
}
