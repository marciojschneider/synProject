<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Module;
use App\Models\Profile;

return new class extends Migration {
  public function up(): void {
    Schema::create("module_permissions", function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Module::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Profile::class)->constrained()->onDelete('cascade');
      $table->integer('list');
      $table->integer('create');
      $table->integer('update');
      $table->integer('delete');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('module_permissions');
  }
};
