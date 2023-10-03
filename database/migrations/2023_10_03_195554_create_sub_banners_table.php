<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sub_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores');
            $table->string('start_at');
            $table->string('end_at');
            $table->enum('status',['Active','InActive'])->default('InActive');
            $table->json('image');
            $table->string('price');
            $table->string('total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_banners');
    }
};
