<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterComboProductsDescriptionColumn extends Migration
{
    public function up()
    {
        // Alter the 'description' column to a text type for larger content
        DB::statement('ALTER TABLE combo_products MODIFY description TEXT');
    }

    public function down()
    {
        // Revert to the original column type if needed
        DB::statement('ALTER TABLE combo_products MODIFY description VARCHAR(255)');
    }
}