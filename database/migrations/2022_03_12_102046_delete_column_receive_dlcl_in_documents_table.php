<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnReceiveDlclInDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('number_receive');
            $table->dropColumn('date_receive');
            $table->string('area_receive')->after('status')->default(0)->comment('0: MB, 1: MT, 2: MN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('number_receive')->after('status');
            $table->date('date_receive')->after('status');
            $table->dropColumn('area_receive');
        });
    }
}
