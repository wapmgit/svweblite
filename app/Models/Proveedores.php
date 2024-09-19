<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
	 protected $table='proveedores';

    protected $primaryKey='idproveedor';

    public $timestamps=false;

    protected $fillable =[
    	
    	'nombre',
    	'rif',
    	'direccion',
    	'telefono',
		'contacto',
		'estatus',
		'tpersona'
    ];

    protected $guarded =[

    ];
}
