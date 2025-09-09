<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('panel', 191);
            $table->string('header_color', 191);
            $table->string('sidebar_color', 191);
            $table->string('sidebar_text_color', 191);
            $table->string('link_color', 191)->default('#ffffff');
            $table->longText('user_css')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *hpp
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_settings');
    }
}
