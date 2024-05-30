<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('sidebars', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('icon')->nullable(true);
      $table->string('slug');
      $table->integer('affiliate_id');
      $table->string('url');
      $table->string('client_id')->default(0); // 0 = Todos | ? = client_id
      // $table->string('permission');
      $table->integer('order');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('sidebars');
  }
};
