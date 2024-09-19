<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notasadmp extends Model
{
    use HasFactory;
	protected $table='notasadmp';

    protected $primaryKey='idnota';

    public $timestamps=false;

    protected $fillable =[
    	'tipo',
		'ndocumento',
    	'idproveedor',
    	'descripcion',
    	'referencia',   	
    	'monto',
		'fecha',
		'pendiente',
		'usuario'
    ];

    protected $guarded =[

    ];
}
