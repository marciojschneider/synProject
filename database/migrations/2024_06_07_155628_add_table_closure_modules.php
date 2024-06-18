<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Sidebar;
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create('closure_modules', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Sidebar::class)->constrained();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamp('dt_closure');
      $table->integer('situation')->default(1);
      $table->integer('creation_user')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('closure_modules');
  }
};
