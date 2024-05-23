<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Task;
use App\Models\User;

return new class extends Migration {
  public function up(): void {
    Schema::create('task_details', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Task::class);
      $table->string('commit_reference')->nullable();
      $table->string('description');
      $table->integer('type');
      $table->integer('situation');
      $table->foreignIdFor(User::class);
      $table->timestamp('initial_dt')->nullable();
      $table->timestamp('ending_dt')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    //
  }
};
