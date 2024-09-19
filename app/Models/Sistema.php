<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
  use HasFactory;
		protected $table='sistema';
    
    protected $primaryKey='idempresa';
    
    public $timestamps=false;
    
    protected $fillable =[
        'fechainicio',
        'fechavence'
    ];
    
    protected $guarded =[
        
    ];
}
