<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemDictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('system_dicts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('dict_name');      //字典项名称
            $table->string('dict_key');     //字典项key
            $table->string('dict_value')->nullable();     //字典项value
            $table->string('remark')->nullable();
            $table->char('enabled',1)->default('Y');
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
        Schema::drop('system_dicts');
	}

}
