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
Schema::create('event_stats', function (Blueprint $table) {
    $table->id();
    $table->date('date');
    $table->string('event');
    $table->string('page')->nullable();
    $table->integer('count')->default(0);
    $table->integer('total_seconds')->default(0);
    $table->timestamps();

    $table->unique(['date','event','page']);
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_stats');
    }
};
