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
        Schema::create('store_advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->string('start_at');
            $table->string('end_at');
            $table->string('price');
            $table->enum('status',['Active','InActive'])->default('InActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_advertisements');
    }
};
