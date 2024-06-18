<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Culture;
use App\Models\Group;
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create('varieties', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->string('name');
      $table->foreignIdFor(Culture::class)->constrained();
      $table->foreignIdFor(Group::class)->constrained();
      $table->integer('situation')->default(1);
      $table->integer('creation_user')->nullable();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('varieties');
  }
};
