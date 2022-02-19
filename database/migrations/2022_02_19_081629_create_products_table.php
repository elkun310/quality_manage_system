<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('specification')->comment('đặc tính kĩ thuật');
            $table->string('symbol')->comment('ký hiệu');
            $table->string('origin')->comment('xuất xứ');
            $table->integer('amount');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
