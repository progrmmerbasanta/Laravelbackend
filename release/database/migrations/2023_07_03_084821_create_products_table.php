<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function   ( Blueprint $table ) {
			$table->increments('id');
			$table->string('name');
			$table->decimal('price', 8, 2);
			$table->string('description');
			$table->string('stars');
			$table->string('img');
			$table->string('location');
			$table->integer('typeId');
			
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
