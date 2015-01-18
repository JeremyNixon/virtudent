<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->boolean('remember_token');	
			$table->timestamps();
		});

		Schema::create('dentists', function($table){
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
            $table->string('organization');
			$table->timestamps();

		});

		Schema::create('patients', function($table){
			$table->increments('id');
			// $table->integer('dentist_id')->unsigned();
   //          $table->foreign('dentist_id')->references('id')->on('dentists');
            $table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('chart_number');
			$table->string('phone');
			$table->string('address');
			$table->string('password');
			$table->boolean('remember_token');	
			$table->timestamps();

		});

		

		// Schema::create('charts', function($table){
		// 	$table->increments('id');
		// 	$table->string('first_name');
		// 	$table->string('last_name');
  //           $table->string('organization');
		// 	$table->timestamps();

		// });

		// Schema::create('organizations', function($table){
		// 	$table->increments('id');
		// 	$table->string('first_name');
		// 	$table->string('last_name');
  //           $table->string('organization');
		// 	$table->timestamps();

		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		// Schema::table('patients', function($table) {
		// 	$table->dropForeign('patients_dentists_id_foreign'); # table_fields_foreign
		// });

		Schema::drop('dentists');
		Schema::drop('patients');
		Schema::drop('users');
	}

}
