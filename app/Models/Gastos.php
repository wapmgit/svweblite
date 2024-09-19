<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;
	       protected $table='gastos';

    protected $primaryKey='idgasto';

    public $timestamps=false;

    protected $fillable =[
    	'idpersona',
    	'tipop',
    	'documento',
    	'control',
    	'descripcion',
    	'base',
    	'iva',
    	'exento',
    	'monto',
    	'saldo',
    	'retenido',
    	'tasa',
    	'fecha',
    	'usuario'
    ];

    protected $guarded =[

    ];
}
