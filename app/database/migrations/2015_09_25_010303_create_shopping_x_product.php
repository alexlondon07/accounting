<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingXProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopping_x_product', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shopping_id');
            $table->unsignedInteger('product_id');
            $table->string('quantity');
            $table->string('cost');
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
		Schema::drop('shopping_x_product');
	}

}
