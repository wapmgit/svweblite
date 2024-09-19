<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovBancos extends Model
{
    use HasFactory;
		protected $table='mov_ban';

    protected $primaryKey='id_mov';

    public $timestamps=false;

    protected $fillable =[
    	'idbanco',
    	'tipodoc',
    	'iddocumento',
    	'tipo_mov',
    	'tipo_per',
		'idbeneficiario',
		'numero',
		'concepto',
    	'nombre',
		'identificacion',
		'tasadolar',
		'fecha_mov',
		'estatus',
    	'user'
    ];

    protected $guarded =[

    ];
}
