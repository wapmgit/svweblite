<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedidos extends Model
{
    use HasFactory;
	protected $table='detalle_pedido';

    protected $primaryKey='iddetalle_pedido';

    public $timestamps=false;

    protected $fillable =[
    	'idpedido',
    	'idarticulo',
    	'costoarticulo',
    	'cantidad',
    	'precio_venta',
    	'descuento',
		'fecha_emi',
		'fecha'
    ];

    protected $guarded =[

    ];
}
