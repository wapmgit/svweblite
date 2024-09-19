<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevolucionCompras extends Model
{
    use HasFactory;
      
	protected $table='devolucioncompras';

    protected $primaryKey='iddevolucion';

    public $timestamps=false;

    protected $fillable =[
    	'idcompra',
    	'fecha_hora',
    	'usuario'
    ];

    protected $guarded =[

    ];
}
