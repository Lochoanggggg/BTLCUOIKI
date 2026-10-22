<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            // Keep the order if the original variant is later deleted.
            $table->foreignId('product_variant_id')->nullable()->constrained()->nullOnDelete();
            // Snapshot fields preserve what the customer purchased at that time.
            $table->string('product_name', 200);
            $table->string('size_name', 20);
            $table->string('color_name', 50);
            $table->decimal('unit_price', 12, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
