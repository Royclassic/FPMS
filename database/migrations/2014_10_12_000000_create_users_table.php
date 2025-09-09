<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('admission_staff_no', '100')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('locale')->default('en');
            $table->string('mime')->nullable();
            $table->string('phone')->nullable();
            $table->integer('year')->nullable();
            $table->tinyInteger('passrec')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->index('faculty_id');
            $table->index('course_id');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('password');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
