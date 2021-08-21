<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_categorys', function (Blueprint $table) {
            $table->id();
            $table->string('uniqid')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('des')->nullable();
            $table->integer('order')->nullable();
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('test_categorys');
    }
}
