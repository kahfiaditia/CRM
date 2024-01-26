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
        Schema::create('penjualan_detil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->unsignedBigInteger('obat_id')->nullable();
            $table->foreign('obat_id')->references('id')->on('obat');
            $table->double('qty')->nullable();
            $table->double('harga_jual')->nullable();
            $table->double('harga_beli')->nullable();
            $table->double('total')->nullable();
            $table->unsignedBigInteger('user_created')->nullable();
            $table->foreign('user_created')->references('id')->on('users');
            $table->unsignedBigInteger('user_updated')->nullable();
            $table->foreign('user_updated')->references('id')->on('users');
            $table->unsignedBigInteger('user_deleted')->nullable();
            $table->foreign('user_deleted')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_detil');
    }
};
