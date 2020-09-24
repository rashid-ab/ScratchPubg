<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	public function boot() {
		Schema::defaultStringLength(191);
	}
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200)->nullable();
			$table->string('email', 250)->nullable();
			$table->string('image', 1000)->nullable();
			$table->string('gender', 100);
			$table->integer('subscription', 191)->nullable();
			$table->integer('start_date', 191)->nullable();
			$table->integer('end_date', 191)->nullable();
			$table->integer('age', 20)->nullable();
			$table->string('password', 250);
			$table->string('phone', 20)->nullable();
			$table->string('remember_token', 500)->nullable();
			$table->integer('status')->default(1);
			$table->string('category')->default('free');
			$table->integer('delete_status')->default(1);
			$table->integer('device_token');
			$table->integer('role');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
