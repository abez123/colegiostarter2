<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clases', function(Blueprint $table)
		{
			$table->increments('id');
            $table -> string('name');
            $table -> time('lunesi');
            $table -> time('lunesf');
            $table -> time('martesi');
            $table -> time('martesf');
            $table -> time('miercolesi');
            $table -> time('miercolesf');
            $table -> time('juevesi');
            $table -> time('juevesf');
            $table -> time('viernesi');
            $table -> time('viernesf');
            $table -> time('sabadoi');
            $table -> time('sabadof');
            $table -> string('grupo_id');
            $table -> string('maestro_id');
            $table -> string('materia_id');
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
		Schema::drop('clases');
	}

}
