<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
	    protected $table='clientes';
    
    protected $primaryKey='id_cliente';
    
    public $timestamps=false;
    
    protected $fillable =[
        'nombre',
        'cedula',
        'rif',
        'telefono',
        'status',
        'direccion',
		'tipo_cliente',
		'diascredito',
		'tipo_precio',
		'vendedor',
		'create_at',
		'update_at'
    ];
    
    protected $guarded =[
        
    ];
}
