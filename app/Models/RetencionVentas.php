<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetencionVentas extends Model
{
    use HasFactory;
	protected $table='retencionventas';

    protected $primaryKey='idret';

    public $timestamps=false;

    protected $fillable =[
    	'idfactura',
    	'comprobante',
    	'pretencion',
    	'mfactura',
    	'impuesto',
    	'mretbs',
		'mretd',
		'periodo',
		'mes',
		'tasa',
		'fecharegistro',
		'fecha',
		'usuario'
    ];

    protected $guarded =[

    ];
}
