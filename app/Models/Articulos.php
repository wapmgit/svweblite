<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
	
	protected $table='articulos';

    protected $primaryKey='idarticulo';

    public $timestamps=false;

    protected $fillable =[
    	'idcategoria',
    	'codigo',
    	'nombre',
    	'stock',
    	'descripcion',
    	'imagen',
    	'estado',
        'utilidad',
        'precio1',
        'precio2',
		'util2',
		'costo',
		'costo_t',
		'iva'
		
    ];

    protected $guarded =[

    ];

}
