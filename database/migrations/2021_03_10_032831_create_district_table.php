<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('provinceID')->unsigned()->nullable();
            $table->foreign('provinceID')->references('id')->on('province')->onUpdate('cascade')->onDelete('cascade');
            $table->string('district_name')->nullable();
            $table->string('district_code')->nullable();
            $table->string('district_slug')->nullable();
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
        Schema::dropIfExists('district');
    }
}
