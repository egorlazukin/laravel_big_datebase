<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationCreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		if (Schema::hasTable('users') == false)
		{
			//
			Schema::create('users', function (Blueprint $table) {
				$table->id();
				$table->string('username');
				$table->string('password_hash');
				$table->string('email')->nullable();
				$table->string('old_password')->nullable();
				$table->timestamps();
			});    
			Schema::create('hash_authentication', function (Blueprint $table) {
				$table->id();
				$table->bigInteger('user_id')->unsigned()->index()->nullable();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->string('hash_login')->nullable();
				$table->timestamps();
			}); 
			Schema::create('private_key', function (Blueprint $table) {
				$table->id();
				$table->bigInteger('user_id')->unsigned()->index()->nullable();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->string('private_key_hash')->nullable();
				$table->timestamps();
			}); 
			Schema::create('user_base', function (Blueprint $table) {
				$table->id();
				$table->string('user_column_1')->nullable();
				$table->string('user_column_2')->nullable();
				$table->string('user_column_3')->nullable();
				$table->string('user_column_4')->nullable();
				$table->string('user_column_5')->nullable();
				$table->bigInteger('private_key_id')->unsigned()->index()->nullable();
				$table->foreign('private_key_id')->references('id')->on('private_key')->onDelete('cascade');
				$table->timestamps();
			});
			
			Schema::create('user_base_comment', function (Blueprint $table) {
				$table->id();
				$table->string('name_column_1')->nullable();
				$table->string('name_column_2')->nullable();
				$table->string('name_column_3')->nullable();
				$table->string('name_column_4')->nullable();
				$table->string('name_column_5')->nullable();
				$table->bigInteger('private_key_id')->unsigned()->index()->nullable();
				$table->foreign('private_key_id')->references('id')->on('private_key')->onDelete('cascade');
				$table->timestamps();
			});
			Schema::create('private_key_admin', function (Blueprint $table) {
				$table->engine = 'MEMORY';
				$table->id();
				$table->string('key_1')->nullable();
				$table->timestamps();
			});			
		}
		
		
		
		
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
