<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Sidebar;
use App\Models\Profile;

return new class extends Migration {
  public function up(): void {
    Schema::create("profile_permissions", function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Profile::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Sidebar::class)->constrained();
      $table->integer('list');
      $table->integer('create');
      $table->integer('update');
      $table->integer('delete');
      $table->string('description')->nullable();
      $table->string('creation_user')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('profile_permissions');
  }
};
