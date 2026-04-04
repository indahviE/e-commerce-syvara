<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->enum('discount_type', ['percentage', 'nominal']);
            $table->integer('discount_value');
            $table->date('valid_until');
            $table->timestamps();

            // Unique constraint: satu produk hanya bisa punya satu diskon
            $table->unique('product_id');

            // Indexes untuk query lebih cepat
            $table->index('valid_until');
            $table->index('discount_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
