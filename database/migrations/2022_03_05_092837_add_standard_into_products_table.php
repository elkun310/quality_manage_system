<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStandardIntoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('standard')->after('symbol');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('standard');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('standard');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->string('standard')->after('status');
        });
    }
}
