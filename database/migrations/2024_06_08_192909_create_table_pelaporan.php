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
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 12)->nullable();
            $table->unsignedBigInteger('id_ar')->nullable();
            $table->foreign('id_ar')->references('id')->on('users');
            $table->string('screenshoot', 64)->nullable();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->foreign('id_customer')->references('id')->on('pelanggan');
            $table->unsignedBigInteger('id_aplikasi')->nullable();
            $table->foreign('id_aplikasi')->references('id')->on('aplikasi');
            $table->string('progres', 15)->nullable();
            $table->string('deskripsi', 128)->nullable();
            $table->string('link', 256)->nullable();
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
        Schema::dropIfExists('pelaporan');
    }
};
