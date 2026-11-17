<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('change_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('draft');
            $table->decimal('amount', 14, 2)->default(0);
            $table->decimal('cost_impact', 14, 2)->default(0);
            $table->decimal('margin_impact', 14, 2)->default(0);
            $table->date('requested_at')->nullable();
            $table->date('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['project_id', 'number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('change_orders');
    }
};