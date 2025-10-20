<?php

// database/migrations/2025_01_01_000001_create_jobs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('jobs', function (Blueprint $t) {
      $t->id();
      $t->string('title');
      $t->text('description')->nullable();
      $t->date('start_date')->nullable();
      $t->date('end_date')->nullable();
      $t->decimal('weight', 8, 2)->default(1);
      $t->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
      $t->enum('status', ['planned','ongoing','finished','cancelled'])->default('planned');
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('jobs'); }
};
