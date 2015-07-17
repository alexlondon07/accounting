<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('description');
            $table->string('cost');
            $table->string('value');
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
		chema::drop('product');
	}

}
