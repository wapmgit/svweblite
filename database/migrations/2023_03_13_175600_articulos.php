<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::create('articulos', function (Blueprint $table) {
		$table->increments('idarticulo');
		$table->string('idcategoria',5);
		$table->string('codigo',20);
		$table->string('nombre',50);
		$table->float('stock',9,3);
		$table->string('descripcion',50);
		$table->string('imagen',50);
		$table->string('estado',15);
		$table->float('utilidad',9,3);
		$table->float('precio1',9,3);
		$table->float('precio2',9,3);
		$table->float('precio_t',9,3);
		$table->float('util2',9,3);
		$table->float('costo',9,3);
		$table->float('costo_t',9,3);
		$table->string('iva',2);
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
        Schema::dropIfExists('articulos');
    }
}
