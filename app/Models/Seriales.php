<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seriales extends Model
{
    use HasFactory;
		protected $table='seriales';
    
    protected $primaryKey='idserial';
    
    public $timestamps=false;
    
    protected $fillable =[
        'idarticulo',
        'chasis',
        'motor',
		'placa',
		'color',
		'año'
    ];
    
    protected $guarded =[
        
    ];
}
