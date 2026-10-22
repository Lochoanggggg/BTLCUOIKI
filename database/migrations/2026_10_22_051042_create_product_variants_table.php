<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('size_id')->constrained()->restrictOnDelete();
            $table->foreignId('color_id')->constrained()->restrictOnDelete();
            $table->string('sku', 80)->unique();
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('price', 12, 2)->nullable(); // null = use product price
            $table->timestamps();
            $table->unique(['product_id', 'size_id', 'color_id'], 'product_variant_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
