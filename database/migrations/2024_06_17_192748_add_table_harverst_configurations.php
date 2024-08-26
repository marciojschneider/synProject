<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Harvest;
use App\Models\Culture;
use App\Models\Field;
use App\Models\Organization;
use App\Models\PlantingMethod;
use App\Models\Section;
use App\Models\Variety;
use App\Models\Client;

return new class extends Migration {
  public function up(): void {
    Schema::create('harvest_configurations', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Harvest::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Section::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Field::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Culture::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Variety::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(PlantingMethod::class)->constrained()->onDelete('cascade');
      $table->foreignIdFor(Organization::class)->constrained()->onDelete('cascade');
      $table->decimal('planting_area', 10, 2)->default(0);
      $table->integer('situation')->default(1);
      $table->integer('creation_user')->nullable();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('harvest_configurations');
  }
};
