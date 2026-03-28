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
        Schema::table('order', function (Blueprint $table) {
            $table->string("nama_penerima"); 
            $table->string("no_telp"); 
            $table->string("provinsi"); 
            $table->string("kabupaten"); 
            $table->string("kecamatan"); 
            $table->string("kode_pos"); 
            $table->string("catatan_kurir")->nullable(); 
            $table->string("payment_method"); 
            $table->unsignedBigInteger("voucher_id")->nullable();
            
            $table->foreign("voucher_id")->references("id")->on("vouchers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn("nama_penerima"); 
            $table->dropColumn("no_telp"); 
            $table->dropColumn("provinsi"); 
            $table->dropColumn("kabupaten"); 
            $table->dropColumn("kecamatan"); 
            $table->dropColumn("kode_pos"); 
            $table->dropColumn("catatan_kurir");
            $table->dropColumn("payment_method"); 
            $table->dropColumn("voucher_id");
        });
    }
};
