<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateIndustriesTable
 * 行业表，分行业大类，行业小类
 */
class CreateIndustriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('industries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('industry_code', 10); //大分类为I01 I02  小分类I0101 I0201
            $table->string('industry_name', 255);
            $table->string('parent', 10)->default('I');
            $table->char('enabled', 1)->default('Y');
            $table->timestamps();

            $table->unique('industry_code');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('industries');
	}

}
