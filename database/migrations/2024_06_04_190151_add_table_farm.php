<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('farms', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('name');
      $table->integer('property')->default(1);
      $table->integer('owner')->default(1);
      $table->integer('situation')->default(1);
      $table->string('creation_user')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('farms');
  }
};
