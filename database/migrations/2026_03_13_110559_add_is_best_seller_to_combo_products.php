<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBestSellerToComboProducts extends Migration
{
    public function up()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            // Add the 'is_best_seller' column to indicate best seller status
            $table->boolean('is_best_seller')->default(false)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            $table->dropColumn('is_best_seller');
        });
    }
}