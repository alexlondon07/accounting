<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingTable extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('shopping', function(Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('date_shopping');
            $table->string('resposible');
            $table->string('enable', 5);
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::drop('shopping');
	}

}
