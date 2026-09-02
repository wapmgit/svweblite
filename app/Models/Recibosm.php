<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibosm extends Model
{
    use HasFactory;
		    protected $table='recibosm';

    protected $primaryKey='idrecibo';

    public $timestamps=false;

    protected $fillable =[
    	
    	'idmiembro',
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
}
