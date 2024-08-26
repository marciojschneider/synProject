<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Sidebar;
use App\Models\Profile;
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create("profile_permissions", function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Profile::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Sidebar::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->integer('affiliate_id');
      $table->integer('view')->default(1);
      $table->integer('create')->default(0);
      $table->integer('update')->default(0);
      $table->integer('delete')->default(0);
      $table->string('description')->nullable();
      $table->integer('creation_user')->nullable();
      $table->integer('situation')->default(1);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('profile_permissions');
  }
};
