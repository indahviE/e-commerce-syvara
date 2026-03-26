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
        Schema::create('faq_products', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger("produk_id");
            $table->string("pertanyaan");
            $table->string("jawaban");

            $table->foreign("produk_id")->references("id")->on("products");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_products');
    }
};
