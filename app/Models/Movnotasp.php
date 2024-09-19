<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movnotasp extends Model
{

	use HasFactory;
	protected $table='mov_notasp';
    
    protected $primaryKey='id_mov';
    
    public $timestamps=false;
    
    protected $fillable =[
        'tipodoc',
        'iddoc',
        'monto',
		'fecha',
		'user'
    ];
    
    protected $guarded =[
        
    ];
}
