<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('combo_products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('description')->nullable();
        $table->decimal('sale_price', 10, 2);
        $table->decimal('regular_price', 10, 2)->nullable();
        $table->string('gift_name')->nullable();
        $table->string('gift_image')->nullable();
        $table->integer('sort_order')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_products');
    }
};
