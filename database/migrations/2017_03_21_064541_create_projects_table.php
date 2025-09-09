<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_name', 191);
            $table->text('project_summary'); // Change to text for larger content
            $table->unsignedInteger('project_admin')->nullable();
            $table->date('start_date');
            $table->date('deadline')->nullable();
            $table->text('notes'); // Change to text for larger content
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->text('feedback'); // Change to text for larger content
            $table->enum('manual_timelog', ['enable', 'disable'])->default('disable');
            $table->enum('client_view_task', ['enable', 'disable'])->default('disable');
            $table->enum('allow_client_notification', ['enable', 'disable'])->default('disable');
            $table->tinyInteger('completion_percent');
            $table->enum('calculate_task_progress', ['true', 'false'])->default('true');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('paused')->default(0);
            $table->double('project_budget', 20, 2)->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->double('hours_allocated', 8, 2)->nullable();

//            $table->index('category_id');
//            $table->index('client_id');
//            $table->index('currency_id');
//            $table->index('project_admin');
//
//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
//            $table->foreign('project_admin')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
