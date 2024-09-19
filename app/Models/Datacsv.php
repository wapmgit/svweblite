<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datacsv extends Model
{
    use HasFactory;
	protected $table='datacsv';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idarticulo',
    	'nombre',
    	'costo',
    	'cantidad'
    ];

    protected $guarded =[

    ];
}
