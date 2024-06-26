<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLikesTableForPolymorphic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');

            $table->unsignedBigInteger('likeable_id');
            $table->string('likeable_type');
            $table->index(['likeable_id', 'likeable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropIndex(['likeable_id', 'likeable_type']);
            $table->dropColumn(['likeable_id', 'likeable_type']);
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
}

