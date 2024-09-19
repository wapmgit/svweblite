<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retenciones extends Model
{
    use HasFactory;
	protected $table='retenciones';

    protected $primaryKey='idretencion';

    public $timestamps=false;

    protected $fillable =[
    	'idcompra',
		'idcompra',
		'idproveedor',
		'documento',
		'correlativo',
    	'retenc',
    	'mfac',
    	'mbase',
    	'miva',
    	'mexento',
    	'mfecha',
		'mret',
		'mretd',
		'anulada'
    ];

    protected $guarded =[

    ];
}
