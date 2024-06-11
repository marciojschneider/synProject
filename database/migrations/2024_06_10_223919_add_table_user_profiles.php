<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Client;
use App\Models\User;

return new class extends Migration {
  public function up(): void {
    Schema::create('user_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class)->constrained();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->integer('situation')->default(1);
      $table->string('creation_user')->nullable();
      $table->string('edition_user')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('user_profiles');
  }
};
