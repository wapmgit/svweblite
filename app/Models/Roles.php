<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
	       protected $table='roles';

    protected $primaryKey='idrol';

    public $timestamps=false;

    protected $fillable =[
    	'newcliente',
    	'editcliente',
    	'editvendedor',
    	'newvendedor',
    	'newproveedor',
    	'editproveedor',
    	'newarticulo',
    	'editarticulo',
    	'crearcompra',
		'anularcompra',
		'crearventa',
		'anularventa',
		'crearpedido',
		'editpedido',
		'anularpedido',
		'creargasto',
		'anulargasto',
		'crearajuste',
		'abonarcxp',
		'abonarcxc',
		'abonargasto',
		'actroles',
		'comisiones',
		'acttasa',
		'actuser',
		'rventas',
		'ccaja',
		'rdetallei',
		'rcxc',
		'rcompras',
		'rdetallec',
		'rcxp',
		'web',
		'updatepass'
		
    ];

    protected $guarded =[

    ];
}
