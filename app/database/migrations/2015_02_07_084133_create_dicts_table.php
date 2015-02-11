<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDictsTable
 * 字典表，字段说明表
 */
class CreateDictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('dicts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('dict_name', 20);
            $table->string('key', 20);
            $table->string('value', 100);
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
        Schema::drop('dicts');
	}

}
