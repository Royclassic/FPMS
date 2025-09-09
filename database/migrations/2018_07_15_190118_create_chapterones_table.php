<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapteronesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapterones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documentation_id')->unsigned();
            $table->string('file');
            $table->string('comment', 2000)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('completion')->default(0);
            $table->index('documentation_id');
            $table->foreign('documentation_id')->references('id')->on('documentations')->onDelete('cascade');
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
        Schema::dropIfExists('chapterones');
    }
}
