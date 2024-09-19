<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;
	protected $table='compras';

    protected $primaryKey='idcompra';

    public $timestamps=false;

    protected $fillable =[
    	'idproveedor',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
		'total',
		'base',
		'miva',
		'exento',
		'saldo',
		'retenido',
		'condicion',
		'estatus',
    	'tasa',
		'user'
    ];

    protected $guarded =[

    ];
}
