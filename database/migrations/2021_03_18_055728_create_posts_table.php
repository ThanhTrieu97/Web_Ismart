<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('post_desc');
            $table->text('content');
            $table->text('thumbnail');
            $table->unsignedBigInteger('page_id')->default(0);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->unsignedBigInteger('post_id')->default(0);
            $table->foreign('post_id')->references('id')->on('post_cats')->onDelete('cascade');
            $table->enum('status', [0, 1]);
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
