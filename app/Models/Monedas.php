<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monedas extends Model
{
    use HasFactory;
	protected $table='monedas';

    protected $primaryKey='idmoneda';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',
    	'tipo',
    	'simbolo',
    	'valor'
    ];

    protected $guarded =[

    ];
}
