<?php

// database/migrations/2025_01_01_000002_create_activities_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('activities', function (Blueprint $t) {
      $t->id();
      $t->foreignId('job_id')->constrained()->cascadeOnDelete();
      $t->foreignId('parent_id')->nullable()->constrained('activities')->nullOnDelete();
      $t->string('title');
      $t->text('description')->nullable();
      $t->date('start_date')->nullable();
      $t->date('end_date')->nullable();
      $t->foreignId('assignee_id')->nullable()->constrained('users')->nullOnDelete();
      $t->decimal('weight', 8, 2)->default(1);
      $t->enum('status', ['planned','ongoing','finished'])->default('planned');
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('activities'); }
};

