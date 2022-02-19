<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_company');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('digital_code')->nullable()->comment('mã ký số');
            $table->string('import_gate')->comment('cửa khẩu nhập');
            $table->date('import_date')->comment('thời gian nhập');
            $table->string('url')->nullable()->comment('file đính kèm');
            $table->date('dead_line')->comment('ngày quá hạn');
            $table->boolean('status')->default(0)->comment('0: inactive, 1:active')->comment('trạng thái hồ sơ: đã xác nhận dấu đỏ hay chưa');
            $table->softDeletes();
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
        Schema::dropIfExists('documents');
    }
}
