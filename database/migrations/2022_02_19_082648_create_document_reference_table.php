<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_reference', function (Blueprint $table) {
            $table->bigInteger('document_id');
            $table->bigInteger('reference_id');
            $table->date('created_at')->comment('cấp ngày')->nullable();
            $table->string('code')->comment('mã số')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_reference');
    }
}
