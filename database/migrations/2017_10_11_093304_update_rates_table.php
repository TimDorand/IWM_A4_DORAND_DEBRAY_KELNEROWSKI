<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nulable()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('rest_id')->unsigned()->nulable()->after('user_id');
            $table->foreign('rest_id')->references('id')->on('restaurants');
            $table->integer('tag_id')->unsigned()->nulable()->after('rest_id');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['rest_id']);
            $table->dropColumn('rest_id');
            $table->dropForeign(['tag_id']);
            $table->dropColumn('tag_id');
        });
    }
}
