<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Client;
use App\Models\Field;
use App\Models\Harvest;
use App\Models\Organization;
use App\Models\Section;
use App\Models\Culture;
use App\Models\PlantingMethod;
use App\Models\Process;
use App\Models\User;
use App\Models\Variety;

return new class extends Migration {
  public function up(): void {
    Schema::create('machine_hours', function (Blueprint $table) {
      $table->id();
      $table->string('report');
      $table->integer('transaction_type');
      $table->timestamp('transaction_dt')->nullable();
      $table->foreignIdFor(Harvest::class)->constrained();
      $table->foreignIdFor(Organization::class)->constrained();
      $table->foreignIdFor(Section::class)->constrained();
      $table->foreignIdFor(Field::class)->constrained();
      $table->foreignIdFor(Culture::class)->constrained();
      $table->foreignIdFor(Variety::class)->constrained();
      $table->foreignIdFor(PlantingMethod::class)->constrained();
      $table->foreignIdFor(Process::class)->constrained();
      $table->integer('equipament_id'); // Provisório
      $table->integer('implement_id')->nullable(); // Provisório
      $table->foreignIdFor(User::class)->constrained(); // Pessoa|Operador
      $table->decimal('quantity', 10, 2);
      $table->decimal('hourmeter_start', 10, 2);
      $table->decimal('hourmeter_end', 10, 2);
      $table->integer('stop_reason')->nullable(); // Provisório
      $table->string('stop_description')->nullable();
      $table->timestamp('stop_dt')->nullable();
      $table->timestamp('operator_start')->nullable();
      $table->timestamp('operator_end')->nullable();
      $table->decimal('quantity_box', 10, 2)->nullable();
      $table->decimal('quantity_diesel', 10, 2)->nullable();
      $table->decimal('hourmeter_rotor_start', 10, 2)->nullable();
      $table->decimal('hourmeter_rotor_end', 10, 2)->nullable();
      $table->decimal('hourmeter_diesel', 10, 2)->nullable();
      $table->integer('situation')->default(1);
      $table->integer('creation_user')->nullable();
      $table->foreignIdFor(Client::class)->constrained()->onDelete('cascade');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void {
    Schema::dropIfExists('machine_hours');
  }
};
