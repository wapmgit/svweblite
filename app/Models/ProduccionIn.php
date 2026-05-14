<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduccionIn extends Model
{
    use HasFactory;
	protected $table='produccion_in';

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
