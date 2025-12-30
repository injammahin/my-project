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
    Schema::create('visitor_events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('visitor_id')->constrained('visitors')->cascadeOnDelete();
        $table->string('event'); // page_view, add_to_cart, checkout, purchase
        $table->string('page')->nullable();
        $table->json('data')->nullable();
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
        Schema::dropIfExists('visitor_events');
    }
};
