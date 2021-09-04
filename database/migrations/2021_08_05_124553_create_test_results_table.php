<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->string('results_uniqid')->nullable();
            $table->unsignedBigInteger('userID')->nullable();
            $table->foreign('userID')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('test_listID')->nullable();
            $table->foreign('test_listID')->references('id')->on('test_lists')->onUpdate('cascade');
            $table->json('result_test')->nullable()->default("[]");
            $table->integer('true_number')->nullable()->default(0);
            $table->integer('error_number')->nullable()->default(0);
            $table->integer('nocheck_number')->nullable()->default(0);
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
        Schema::dropIfExists('test_results');
    }
}
