<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_home', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('nameeg')->nullable();
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->text('type')->nullable();
            $table->text('value')->nullable();
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
        Schema::dropIfExists('setting_home');
    }
}
