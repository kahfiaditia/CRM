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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('obat', 30);
            $table->string('deskripsi', 30)->nullable();
            $table->double('stok')->default(0);
            $table->double('stok_minimal')->nullable();
            $table->double('harga_beli')->default(0);
            $table->double('harga_jual')->default(0);
            $table->string('status', 1)->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->foreign('jenis_id')->references('id')->on('jenis');
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
        Schema::dropIfExists('obat');
    }
};
