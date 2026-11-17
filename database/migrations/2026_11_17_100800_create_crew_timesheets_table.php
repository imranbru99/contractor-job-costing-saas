<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crew_timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('work_date');
            $table->string('clock_in')->nullable();
            $table->string('clock_out')->nullable();
            $table->decimal('hours', 8, 2)->default(0);
            $table->unsignedInteger('break_minutes')->default(0);
            $table->string('status')->default('submitted');
            $table->string('source')->default('manual');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crew_timesheets');
    }
};