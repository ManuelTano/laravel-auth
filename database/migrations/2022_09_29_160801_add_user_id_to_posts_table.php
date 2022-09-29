<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPostsTable extends Migration
{
 
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}