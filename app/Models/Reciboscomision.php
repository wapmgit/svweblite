<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciboscomision extends Model
{
    use HasFactory;
	protected $table='reciboscomision';

    protected $primaryKey='id_recibo';

    public $timestamps=false;

    protected $fillable =[
    	'id_comision',
    	'monto',
       	'observacion',
        'fecha',
		'user'
    
    ];

    protected $guarded =[

    ];

}
