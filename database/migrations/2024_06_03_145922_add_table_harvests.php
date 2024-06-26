<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create("harvests", function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('name');
      $table->integer('situation')->default(1);
      $table->timestamp('initial_dt')->nullable();
      $table->timestamp('ending_dt')->nullable();
      $table->integer('creation_user')->nullable();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->integer('price_table')->default(0); // Apenas provisório.
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('harvests');
  }
};
