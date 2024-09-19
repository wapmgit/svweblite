<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleajustes extends Model
{
    use HasFactory;
	protected $table='detalle_ajustes';

    protected $primaryKey='iddetalle_ajuste';

    public $timestamps=false;

    protected $fillable =[
    	'idajuste',
    	'idarticulo',
    	'tipo_ajuste',
    	'cantidad',   	
    	'costo',   	
    	'valorizado'
    ];

    protected $guarded =[

    ];
}
