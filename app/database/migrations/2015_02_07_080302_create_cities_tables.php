<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('cities', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('city_code', 10);
            $table->string('city_name', 100);
            $table->string('province_code', 10);
            $table->char('enabled', 1)->default('Y');   //是否启用
            $table->timestamps();
            $table->unique(array('province_code', 'city_code'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('cities');
	}

}
