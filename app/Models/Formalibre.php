<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formalibre extends Model
{
    use HasFactory;
	protected $table='formalibre';

    protected $primaryKey='idforma';

    public $timestamps=false;

    protected $fillable =[
    	'idventa',
    	'nrocontrol'
    ];

    protected $guarded =[

    ];
	}
