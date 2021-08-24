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
			$table->string('silver_limit', 250)->default(100);
			$table->string('golden_limit', 250)->default(50);
			$table->string('platinum_limit', 250)->default(30);
			$table->string('coins', 250)->default(0);
			$table->string('uc', 250)->default(0);
			$table->string('redeem_uc', 250)->default(0);
			$table->string('total_uc', 250)->default(0);
			$table->string('total_coins', 250)->default(0);
			$table->string('password', 1000)->nullable();
			$table->string('device_token', 1000)->nullable();
			$table->string('remember_token', 1000)->nullable();
			$table->string('status', 250)->default(0);
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
