<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function(Blueprint $table) {
            $table->string('key', 50)->unu;
            $table->string('value', 255);
        });

        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('group_id');
            $table->dateTime('last_post_updated')->nullable();
            $table->dateTime('last_updated')->nullable();
        });

        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('post_id');
            $table->text('message')->nullable();
            $table->text('story')->nullable();
            $table->dateTime('updated_time');
            $table->string('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configs');
        Schema::drop('groups');
        Schema::drop('posts');
    }
}
