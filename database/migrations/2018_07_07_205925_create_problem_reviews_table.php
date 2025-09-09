<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('problem_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->index('user_id');
            $table->index('problem_id');
            $table->string('review', 1200);
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
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
        Schema::dropIfExists('problem_reviews');
    }
}
