<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('organizations', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('name');
      $table->timestamp('machine_hour_dt')->nullable();
      $table->timestamp('ordinance_dt')->nullable();
      $table->timestamp('maintenance_dt')->nullable();
      $table->timestamp('fuel_dt')->nullable();
      $table->timestamp('harvest_dt')->nullable();
      $table->timestamp('inputs_dt')->nullable();
      $table->string('external_code');
      $table->integer('situation')->default(1);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('organizations');
  }
};
