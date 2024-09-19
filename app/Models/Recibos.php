<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{
    use HasFactory;
	    protected $table='recibos';

    protected $primaryKey='idrecibo';

    public $timestamps=false;

    protected $fillable =[
    	
    	'idventa',
		'idnota',
    	'monto',
    	'tiporecibo',
		'idpago',
    	'id_banco',
    	'idbanco',
    	'recibido',
    	'tasab',
    	'tasap',
		'referencia',
    	'fecha',
    	'aux',
		'usuario'
    ];

    protected $guarded =[

    ];
}
