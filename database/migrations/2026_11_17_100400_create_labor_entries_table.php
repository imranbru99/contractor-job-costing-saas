<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('labor_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->date('work_date');
            $table->string('crew_role')->nullable();
            $table->decimal('hours', 8, 2)->default(0);
            $table->decimal('hourly_rate', 10, 2)->default(0);
            $table->decimal('burden_rate', 10, 2)->default(0);
            $table->decimal('total_cost', 14, 2)->default(0);
            $table->string('cost_code')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('labor_entries');
    }
};