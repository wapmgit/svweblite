<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;
	protected $table='devolucion';

    protected $primaryKey='iddevolucion';

    public $timestamps=false;

    protected $fillable =[
    	'idventa',
    	'idempresa',
    	'comprobante',
    	'fecha_hora',
    	'user'
    ];
    protected $guarded =[

    ];
}
