<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 191);
            $table->string('company_email', 191);
            $table->string('company_phone', 191);
            $table->string('logo', 191)->nullable();
            $table->string('login_background', 191)->nullable();
            $table->text('address');
            $table->string('website', 191)->nullable();
            $table->string('timezone', 191)->default('Asia/Kolkata');
            $table->string('date_format', 20)->default('d-m-Y');
            $table->string('time_format', 20)->default('h:i a');
            $table->string('locale', 191)->default('en');
            $table->decimal('latitude', 10, 8)->default('26.91243360');
            $table->decimal('longitude', 11, 8)->default('75.78727090');
            $table->enum('active_theme', ['default', 'custom'])->default('default');
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();
            $table->index('last_updated_by');
            $table->foreign('last_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_settings');
    }
}
