<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // blog table
      Schema::create('comments', function(Blueprint $table) {
        $table->increments('id');
        $table -> integer('author_id') -> unsigned() -> default(0);
        $table->foreign('author_id')
            ->references('id') -> on('users')
            ->onDelete('cascade');
        $table -> integer('post_id') -> unsigned() -> default(0);
        $table->foreign('post_id')
            ->references('id') -> on('posts')
            ->onDelete('cascade');
        $table->text('comment');
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
        Schema::drop('comments');
    }
}
