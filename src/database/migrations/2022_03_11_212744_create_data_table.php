<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('datas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->string('buyer');
            $table->string('description');
            $table->decimal('unit_price');
            $table->decimal('quantity');
            $table->string('address');
            $table->string('provider');
            $table->bigInteger("file_id")->unsigned();

            $table->foreign("file_id")->references('id')->on('files');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datas');
    }
}
