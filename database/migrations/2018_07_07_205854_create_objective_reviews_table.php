<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('objective_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->index('user_id');
            $table->index('objective_id');
            $table->string('review', 1200);
            $table->foreign('objective_id')->references('id')->on('objectives')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('objective_reviews');
    }
}
