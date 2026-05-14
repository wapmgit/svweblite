<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
   use HasFactory;
	protected $table='produccion';

    protected $primaryKey='idproduccion';

    public $timestamps=false;

    protected $fillable =[
    	'controlp',
    	'idempresa',
    	'concepto',
    	'responsable',
    	'valor',
    	'fecha'
    ];

    protected $guarded =[

    ];
}
