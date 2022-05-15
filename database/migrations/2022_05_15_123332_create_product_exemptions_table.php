<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductExemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_exemptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('specification')->comment('đặc tính kĩ thuật');
            $table->string('symbol')->comment('ký hiệu');
            $table->integer('amount');
            $table->unsignedBigInteger('exemption_id');
            $table->foreign('exemption_id')->references('id')->on('exemptions')->onDelete('cascade');
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
        Schema::dropIfExists('product_exemptions');
    }
}
