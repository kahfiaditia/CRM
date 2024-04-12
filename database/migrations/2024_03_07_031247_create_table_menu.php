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
        Schema::create('table_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu', 20);
            $table->string('route_menu', 30)->nullable();
            $table->string('typemenu', 20)->nullable();
            $table->string('icon_menu', 70)->nullable();
            $table->string('status', 1)->nullable();
            $table->string('order_menu', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_menu');
    }
};
