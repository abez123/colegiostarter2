<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaestrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maestros', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre');
            $table->string('apelido_p');
            $table->string('apelido_m');
            $table->string('sexo');
            $table->string('direccion');
            $table->string('colonia');
            $table->string('cp');
            $table->string('telefonos');
            $table->string('username')->unique(); // used for slug.
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
            $table->string('admin',2);
            $table->string('mision');
            $table->string('cursos');
            $table->rememberToken();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maestros');
	}

}
