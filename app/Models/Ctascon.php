<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ctascon extends Model
{
    use HasFactory;
	protected $table='ctascon';

    protected $primaryKey='idcod';

    public $timestamps=false;

    protected $fillable =[
    	'codigo',
    	'tipo',
    	'descripcion',
    	'inactiva'
    ];

    protected $guarded =[

    ];
}
