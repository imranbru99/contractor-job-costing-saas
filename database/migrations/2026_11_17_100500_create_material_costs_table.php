<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
            $table->string('item_name');
            $table->string('sku')->nullable();
            $table->decimal('quantity', 12, 3)->default(0);
            $table->string('unit')->default('ea');
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('waste_pct', 5, 2)->default(0);
            $table->decimal('total_cost', 14, 2)->default(0);
            $table->string('cost_code')->nullable();
            $table->date('issued_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_costs');
    }
};