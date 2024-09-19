<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalledevolucionCompras extends Model
{
    use HasFactory;
	protected $table='detalle_devolucioncompras';

    protected $primaryKey='iddetalle';

    public $timestamps=false;

    protected $fillable =[
    	'codarticulo',
    	'cantidad'
    ];

    protected $guarded =[

    ];
}
