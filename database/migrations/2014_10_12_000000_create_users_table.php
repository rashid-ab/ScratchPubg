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
			$table->string('pubg_id', 250)->nullable();
			$table->string('coins', 250)->nullable();
			$table->string('uc', 250)->nullable();
			$table->string('redeem_uc', 250)->nullable();
			$table->string('password', 250)->nullable();
			$table->string('status', 250)->nullable();
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
