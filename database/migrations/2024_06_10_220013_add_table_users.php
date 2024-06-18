<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->string('password');
      $table->rememberToken(); // Verificar necessidade
      $table->integer('in_client')->nullable();
      $table->integer('in_profile')->nullable();
      $table->timestamp('in_time')->nullable();
      $table->integer('situation')->default(1);
      $table->string('creation_user')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void {
    Schema::dropIfExists('users');
  }
};
