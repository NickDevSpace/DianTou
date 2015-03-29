<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemMessageDeliveriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_message_deliveries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('message_id');
            $table->integer('receiver');
            $table->char('is_read', 1)->default('N');
            $table->char('is_deleted', 1)->default('N');
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
        Schema::drop('system_message_deliveries');
    }

}
