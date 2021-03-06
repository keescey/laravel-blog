<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // blog table
      Schema::create('posts', function(Blueprint $table) {
        $table->increments('id');
        $table -> integer('author_id') -> unsigned() -> default(0);
        $table->foreign('author_id')
            ->references('id') -> on('users')
            ->onDelete('cascade');
        $table->string('title') -> unique();
        $table->string('subheading');
        $table->text('body');
        $table->boolean('active') -> unsigned() -> default(1);
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
        Schema::drop('post');
    }
}
