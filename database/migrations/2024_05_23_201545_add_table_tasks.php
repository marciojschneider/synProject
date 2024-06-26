<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Sidebar;
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->foreignIdFor(Sidebar::class)->constrained();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamp('initial_dt')->nullable();
      $table->timestamp('expected_dt')->nullable();
      $table->integer('creation_user')->nullable();
      $table->string('description');
      $table->integer('situation')->default(1);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('tasks');
  }
};
