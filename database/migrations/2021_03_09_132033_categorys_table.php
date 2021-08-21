<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cate_parentID')->unsigned()->nullable();
            $table->foreign('cate_parentID')->references('id')->on('categorys')->onUpdate('cascade')->onDelete('cascade');
            $table->string("cate_name")->nullable();
            $table->string("cate_icon")->nullable();
            $table->string("cate_slug_parent")->nullable();
            $table->string("cate_slug")->nullable();
            $table->text("cate_des")->nullable();
            $table->integer("cate_order")->nullable();
            $table->integer("cate_status")->nullable()->default(0);
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
        Schema::dropIfExists('categorys');
    }
}
