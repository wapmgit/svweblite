<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajustes extends Model
{
    use HasFactory;
	     protected $table='ajustes';

    protected $primaryKey='idajuste';

    public $timestamps=false;

    protected $fillable =[
    	'concepto',
    	'responsable',
       	'fecha_hora',
        'monto'
    
    ];

    protected $guarded =[

    ];
}
