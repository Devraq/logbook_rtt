<?php

// database/migrations/2025_01_01_000004_create_job_assignees_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('job_assignees', function (Blueprint $t) {
      $t->id();
      $t->foreignId('job_id')->constrained()->cascadeOnDelete();
      $t->foreignId('user_id')->constrained()->cascadeOnDelete();
      $t->string('role')->nullable();
      $t->timestamps();
      $t->unique(['job_id','user_id']);
    });
  }
  public function down(): void { Schema::dropIfExists('job_assignees'); }
};
