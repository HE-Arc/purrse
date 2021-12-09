<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('list_id')->unsigned()->index();
            $table->string('name');
            $table->string('color');
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
        });

        Schema::create('user_to_group', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('group_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });

        Schema::create('user_to_list', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('list_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
        });

        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('list_id')->unsigned()->index();
            $table->string('name');
            $table->string('description');
            $table->float('budget');
            $table->float('total');
            $table->float('to_pay');
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('space_id')->unsigned()->index();
            $table->string('name');
            $table->float('cost');
            $table->date('date');
            $table->boolean('is_paid');
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
        });

        Schema::create('expense_to_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('expense_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_to_group');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('lists');
        Schema::dropIfExists('user_to_list');
        Schema::dropIfExists('spaces');
        Schema::dropIfExists('expense_to_user');
        Schema::dropIfExists('expenses');
    }
}
