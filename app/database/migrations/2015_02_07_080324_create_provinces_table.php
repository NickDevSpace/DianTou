<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProvincesTable
 * 省份表，到底是用树形结构直接把省份城市存一起呢还是省份城市分开
 */
class CreateProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('provinces', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('province_code', 10);
            $table->string('province_name', 100);
            $table->char('enabled', 1)->default('Y');  //是否启用
            $table->timestamps();
            $table->unique('province_code');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('provinces');
	}

}
