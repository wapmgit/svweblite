<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;
	    use HasFactory;
	protected $table='pedidos';

    protected $primaryKey='idpedido';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
		'idvendedor',
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
