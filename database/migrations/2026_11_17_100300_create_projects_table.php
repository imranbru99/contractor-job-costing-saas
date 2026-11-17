<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('client_name')->nullable();
            $table->foreignId('client_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('draft');
            $table->decimal('contract_value', 14, 2)->default(0);
            $table->decimal('budget_labor', 14, 2)->default(0);
            $table->decimal('budget_materials', 14, 2)->default(0);
            $table->decimal('budget_other', 14, 2)->default(0);
            $table->decimal('contingency_pct', 5, 2)->default(5);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('actual_labor', 14, 2)->default(0);
            $table->decimal('actual_materials', 14, 2)->default(0);
            $table->decimal('actual_other', 14, 2)->default(0);
            $table->decimal('approved_change_orders', 14, 2)->default(0);
            $table->decimal('projected_margin_pct', 8, 2)->default(0);
            $table->decimal('projected_profit', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};