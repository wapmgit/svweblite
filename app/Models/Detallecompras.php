<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallecompras extends Model
{
    use HasFactory;
	protected $table='detalle_compras';
	
    protected $primaryKey='iddetalle_compra';

    public $timestamps=false;

    protected $fillable =[
    	'idcompra',
    	'idarticulo',
    	'cantidad',
    	'precio_compra',
		'precio_tasa',
		'precio_venta',
    	'subtotal',
		'fecha'
    ];

    protected $guarded =[

    ];
}
