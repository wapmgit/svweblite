<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduccionOut extends Model
{
   use HasFactory;
	protected $table='produccion_out';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idproduccion',
    	'idarticulo',
    	'cantidad',
    	'costo'
    ];

    protected $guarded =[

    ];
}
