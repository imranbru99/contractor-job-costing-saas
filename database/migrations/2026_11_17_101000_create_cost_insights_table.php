<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('severity')->default('medium');
            $table->string('category')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('recommended_action')->nullable();
            $table->decimal('estimated_impact', 14, 2)->default(0);
            $table->decimal('confidence', 5, 2)->default(0.75);
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_insights');
    }
};