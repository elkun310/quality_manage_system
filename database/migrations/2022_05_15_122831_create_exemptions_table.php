<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_company');
            $table->date('expired')->comment('thời hạn');
            $table->string('dispatch_number')->comment('số công văn');
            $table->date('dispatch_date')->comment('ngày công văn');
            $table->string('dispatch_file')->nullable()->file('file công văn');
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
        Schema::dropIfExists('exemptions');
    }
}
