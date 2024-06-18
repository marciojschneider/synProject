<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Task;

return new class extends Migration {
  public function up(): void {
    Schema::create('task_details', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Task::class)->constrained()->onDelete('cascade');
      $table->string('commit_reference')->nullable();
      $table->string('description');
      $table->integer('type');
      $table->integer('situation');
      $table->string('creation_user')->nullable();
      $table->timestamp('initial_dt')->nullable();
      $table->timestamp('ending_dt')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('task_details');
  }
};
