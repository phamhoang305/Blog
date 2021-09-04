<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider')->nullable();
            $table->longText('provider_id')->nullable();
            $table->longText('access_token')->nullable();
            $table->bigInteger('roleID')->unsigned()->nullable();
            $table->foreign('roleID')->references('id')->on('roles')->onUpdate('cascade')->onDelete('set null');
            $table->string('avatar')->nullable();
            $table->string('type')->nullable()->default('userCreate');
            $table->string('username')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('email_verified_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('sex')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->string('darkMode')->nullable();
            $table->string('status_notice_userFollow')->nullable()->default('on');
            $table->string('status_approve')->nullable()->default('on');
            $table->string('pass_verified_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
