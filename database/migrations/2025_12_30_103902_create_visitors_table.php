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
    Schema::create('visitors', function (Blueprint $table) {
        $table->id();
        $table->string('visitor_id')->unique();
        $table->string('ip')->nullable();
        $table->string('device')->nullable();
        $table->string('browser')->nullable();
        $table->string('platform')->nullable();
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
        Schema::dropIfExists('visitors');
    }
};
