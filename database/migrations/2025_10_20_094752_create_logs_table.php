<?php

// database/migrations/2025_01_01_000003_create_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('logs', function (Blueprint $t) {
      $t->id();
      $t->foreignId('job_id')->constrained()->cascadeOnDelete();
      $t->foreignId('activity_id')->constrained()->cascadeOnDelete();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->date('date');
      $t->decimal('hours', 6, 2)->nullable();
      $t->decimal('percent', 8, 3)->default(0);
      $t->text('description')->nullable();
      $t->string('evidence_url')->nullable();
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('logs'); }
};

