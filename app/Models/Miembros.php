<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembros extends Model
{ 
	    use HasFactory;
	protected $table='miembros';

    protected $primaryKey='idmiembro';

    public $timestamps=false;

    protected $fillable =[
    	'idempresa',
    	'idcliente',
    	'fnacimiento',
		'condicion',
		'medicamento',
		'alergias',
		'fecha_inicio',
		'montomes',
		'tel_emergencia',
		'contacto'
    ];

    protected $guarded =[

    ];
}
