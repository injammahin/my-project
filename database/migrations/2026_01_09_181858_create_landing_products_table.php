<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('landing_products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('size_label')->nullable(); // 200 ml, 400 ml
            $table->integer('price')->default(0);
            $table->integer('old_price')->nullable();
            $table->string('image')->nullable(); // storage path
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_products');
    }
};
