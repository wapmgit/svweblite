<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
	   protected $table='empresa';
  protected $primaryKey='idempresa';
    public $timestamps=false;

    protected $fillable =[
    	'idempresa',
    	'nombre',
		'direccion',
		'rif',
		'telefono',
		'fechasistema',
		'inicio',
		'corre_iva',
		'corre_islr',
    	'peso',
    	'tc',
		'tasa_banco'
    ];
    protected $guarded =[

    ];
}
