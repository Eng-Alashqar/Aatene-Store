<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_list_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('start_at');
            $table->string('end_at');
            $table->string('price');
            $table->string('total');
            $table->enum('status',['Active','InActive'])->default('InActive');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_list_ads');
    }
};
