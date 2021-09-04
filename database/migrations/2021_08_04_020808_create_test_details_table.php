<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_details', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid')->nullable();
            $table->unsignedBigInteger('test_listID')->nullable();
            $table->foreign('test_listID')->references('id')->on('test_lists')->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->text('note')->nullable();
            $table->json('item')->nullable()->default("[]");
            $table->integer('status')->nullable()->default(0);
            $table->string('check_uniqid')->nullable();
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
        Schema::dropIfExists('test_details');
    }
}
