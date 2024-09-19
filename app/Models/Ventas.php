<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
	protected $table='venta';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
		'descuento',
		'total_pagar',
		'fecha_emi',
    	'impuesto',
		'condicion',
		'devolu',
		'comision',
		'montocomision',
		'idcomision',
    	'total_venta',
    	'user'
    ];

    protected $guarded =[

    ];
}
