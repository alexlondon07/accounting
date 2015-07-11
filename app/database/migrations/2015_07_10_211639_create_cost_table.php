<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostTable extends Migration {

	/**
	* Run the migrations.
	* @return void
	*/
	public function up()
	{
		Schema::create('cost', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('description');
            $table->integer('value');
            $table->date('date_cost');
            $table->string('resposible');
            $table->string('enable');
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
		Schema::drop('cost');
	}

}
