<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;
	protected $table='kardex';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'id',
    	'fecha',
    	'documento',
    	'cantidad',
    	'costo',
		'user',
    	'tipo'
    ];

    protected $guarded =[

    ];
}
