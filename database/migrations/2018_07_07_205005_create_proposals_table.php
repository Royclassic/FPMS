<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->index('student_id');
            $table->string('field', 700);
            $table->string('subareas',700);
            $table->string('main_subarea',100);
            $table->string('file')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('status')->default(0);
            $table->string('remarks', 2000);
            $table->tinyInteger('completed');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
