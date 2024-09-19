<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalledevolucion extends Model
{
    use HasFactory;
	    
    protected $table='detalle_devolucion';

    protected $primaryKey='iddetalle_devolucion';

    public $timestamps=false;

    protected $fillable =[
    	'iddevolucion',
    	'idarticulo',
    	'cantidad',
    	'precio_venta',
    	'descuento'
    ];

    protected $guarded =[

    ];
}
