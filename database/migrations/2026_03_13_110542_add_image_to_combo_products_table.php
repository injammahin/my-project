<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToComboProductsTable extends Migration
{
    public function up()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            // Add 'image' column for product image
            $table->string('image')->nullable()->after('gift_image');
        });
    }

    public function down()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            // Drop the 'image' column if rollback happens
            $table->dropColumn('image');
        });
    }
}