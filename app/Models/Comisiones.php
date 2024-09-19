<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    use HasFactory;
	  protected $table='comisiones';

    protected $primaryKey='id_comision';

    public $timestamps=false;

    protected $fillable =[
    	'id_vendedor',
    	'montoventas',
    	'montocomision',
		'pendiente',
		'fecha',
		'usuario'
    ];

    protected $guarded =[

    ];
}
