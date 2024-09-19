<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobantes extends Model
{
    use HasFactory;
	   protected $table='comprobante';

    protected $primaryKey='idrecibo';

    public $timestamps=false;

    protected $fillable =[
    	
    	'idcompra',
    	'monto',
    	'efectivo',
    	'debito',
    	'refdeb',
    	'cheque',
    	'refche',
    	'transferencia',
    	'reftrans',
    	'aux',
    ];

    protected $guarded =[

    ];
}
