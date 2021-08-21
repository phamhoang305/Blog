<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_lists', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid')->nullable();
            $table->unsignedBigInteger('test_categoryID')->nullable();
            $table->foreign('test_categoryID')->references('id')->on('test_categorys')->onUpdate('cascade');
            $table->string('testlist_name')->nullable();
            $table->text('testlist_des')->nullable();
            $table->integer('testlist_status')->nullable()->default(0);
            $table->integer('testlist_order')->nullable()->default(0);
            $table->integer('testlist_minutes')->nullable()->default(0);
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
        Schema::dropIfExists('test_lists');
    }
}
