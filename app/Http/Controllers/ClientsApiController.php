<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\Clientes;
use Exception;
use sisventas\Mov_notas;
use DB;
class ClientsApiController extends Controller
{
    private $errorServer = ['status' => 500, 'message' => 'Error de comunicación con el servidor de la base de datos.', 'data' => ''];
    private $recordsNotFound = ['status' => 400, 'message' => '0 registros encontrados.', 'data' => ''];

    public function sendData()
    {
   try {
		$empresa=DB::table('empresa')->first();

	   $clients = DB::table('clientes as cli')
		  ->join('vendedores as vend','vend.id_vendedor','=','cli.vendedor')	
		 ->select(DB::raw('(space(12)*0) as cxc'),'cli.id_cliente','cli.nombre','cli.cedula','cli.cedula as rif','cli.direccion','cli.telefono','cli.diascredito as dias_credito','cli.vendedor','vend.comision')
		 ->orderby('id_cliente','desc')
		->where('status','=',"A")		 
		 ->groupby('cli.id_cliente')
		  ->get(); 	
		$ventas=DB::table('venta as v')
			->select(DB::raw('sum(v.saldo) as cuenta'),'v.idcliente')
			->where('v.tipo_comprobante','=','FAC')
			->where('v.devolu','=',0)
			->where('v.saldo','>',0)
			->groupby('v.idcliente')
			->get();
		$longitudc = count($clients);
			$longitudn = count($ventas);	
			for ($i=0;$i<$longitudc;$i++){
				for($j=0;$j<$longitudn;$j++){
				if ($clients[$i]->id_cliente==$ventas[$j]->idcliente){
					$clients[$i]->cxc=$ventas[$j]->cuenta;
				};
				}
			}	

		$q2=DB::table('notasadm as n')
			->join('clientes as c','c.id_cliente','=','n.idcliente')
			->select('n.tipo',DB::raw('sum(n.pendiente) as saldo'),'c.id_cliente','c.nombre')
			->where('n.pendiente','>',0)
			->groupby('n.tipo','n.idcliente')
			->get();
					 	
		$longitud = count($clients);		
			for ($i=0;$i<$longitud;$i++){
				foreach($q2 as $t){
						
					if(($clients[$i]->id_cliente==$t->id_cliente) and ($t->tipo==1)){
						$aux=$clients[$i]->cxc;
						if(is_null($aux)) {$aux=0;}
						$clients[$i]->cxc=($t->saldo + $aux);
					}  
					if(($clients[$i]->id_cliente==$t->id_cliente) and ($t->tipo==2)){
						$aux2=$clients[$i]->cxc;
						if(is_null($aux2)) {$aux2=0;}
						$clients[$i]->cxc=($aux2 - $t->saldo);
					} 
			}  
		}  
		//obtener la cuenta por cobrar
	        $q1=DB::table('venta')->select('idcliente',DB::raw('CONCAT("FAC-",idventa) as doc'),'fecha_hora as fecha','total_venta as monto','saldo')
						->where('tipo_comprobante','=','FAC')
						->where('devolu','=',0)
						->where('saldo','>',0); 
			$q3=DB::table('notasadm')->select('idcliente',DB::raw('CONCAT("N/D-",idnota) as doc'),'fecha as fecha','monto','pendiente as saldo')
			->where('pendiente','>',0)
			->where('tipo','=',1);
			$ventascxc= $q1->union($q3)->get(); 
				// los recibos
			$recibos=DB::table('venta as v')
			->join('recibos as r','r.idventa','=','v.idventa')
			->select('r.idventa','r.monto','r.idbanco as moneda','r.recibido','r.fecha')
			->where('v.saldo','>',0)
			->where('v.devolu','=',0)
			->get();
			
		$clientesjs=json_encode($clients);		
		$ventasjs=json_encode($ventascxc);
		$recibosjs=json_encode($recibos);
		
		
            $response = Http::post('http://pedidos.nks-sistemas.net/api/recibir-clientes', [      	
				'empresa' =>$empresa->codigo,
				'clientes' => $clientesjs,
				'ventas' => $ventasjs,			
				'recibos' => $recibosjs								
            ]);
		//return $response->getBody();
			
			
     } catch (Exception $e) {
		
	    return Redirect::to('sininternet');
     }
			 return Redirect::to('clientes');
	
    }
}
