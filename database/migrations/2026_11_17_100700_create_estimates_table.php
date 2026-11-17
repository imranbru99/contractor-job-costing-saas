<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('number')->unique();
            $table->string('title');
            $table->string('status')->default('draft');
            $table->decimal('labor_total', 14, 2)->default(0);
            $table->decimal('materials_total', 14, 2)->default(0);
            $table->decimal('other_total', 14, 2)->default(0);
            $table->decimal('contingency_pct', 5, 2)->default(5);
            $table->decimal('markup_pct', 5, 2)->default(12);
            $table->decimal('bid_total', 14, 2)->default(0);
            $table->date('valid_until')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};