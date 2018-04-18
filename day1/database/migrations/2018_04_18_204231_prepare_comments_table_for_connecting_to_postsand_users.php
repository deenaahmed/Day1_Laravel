<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrepareCommentsTableForConnectingToPostsandUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {

        $table->foreign('commentable_id')->references('id')->on('posts')->onCascade('update')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onCascade('update')->onDelete('cascade');            
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
