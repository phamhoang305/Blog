<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('provinceID')->unsigned()->nullable();
            $table->foreign('provinceID')->references('id')->on('province')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('DistrictID')->unsigned()->nullable();
            $table->foreign('districtID')->references('id')->on('district')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ward_name')->nullable();
            $table->string('ward_slug')->nullable();
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
        Schema::dropIfExists('ward');
    }
}
