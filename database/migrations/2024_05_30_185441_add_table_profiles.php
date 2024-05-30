<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('profiles');
  }
};
