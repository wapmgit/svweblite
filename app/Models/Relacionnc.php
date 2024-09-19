<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacionnc extends Model
{
    use HasFactory;
	protected $table='relacionnc';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'idmov',
    	'idnota'
    ];

    protected $guarded =[

    ];
}
