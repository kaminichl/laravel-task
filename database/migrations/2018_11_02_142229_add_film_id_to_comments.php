<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilmIdToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('comments', function($table) {
			$table->unsignedInteger('film_id');
			$table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function($table) {
			$table->dropForeign('comments_film_id_foreign');
			$table->dropColumn('film_id');
		});
    }
}
