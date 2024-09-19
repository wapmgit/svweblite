<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notasadm extends Model
{
    use HasFactory;
	protected $table='notasadm';

    protected $primaryKey='idnota';

    public $timestamps=false;

    protected $fillable =[
    	'tipo',
    	'idcliente',
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
