<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pedidos;
use App\Models\Detallespedidos;
use Carbon\Carbon;
use DB;
use Exception;
use Auth;

class PedidosApiController extends Controller
{
	private $errorServer = ['status' => 500, 'message' => 'Error de comunicación con el servidor de la base de datos.', 'data' => ''];
	private $recordsNotFound = ['status' => 400, 'message' => '0 registros encontrados.', 'data' => ''];

	public function sendData()
    {	
	 $empresa=DB::table('empresa')->first();
        try {
		$user="Administracion";
            $response = Http::post('http://pedidos.nks-sistemas.net/api/enviar-pedidos', [
                   'empresa' => $empresa->codigo
            ]);
		$datos= $response->getBody();
		$datos2=  json_decode($datos,false);          		 
		$datos3=$datos2->data;
		
			$longitud = count($datos3);	
			$array = array();
			foreach($datos3 as $t){
			$arraycliente[] 	= $t->cliente_id;
			$arrayvend[] 		= $t->vendedor;
			$arraymonto[] 		= $t->total_pedido;
			$arraydiascre[] 	= $t->dias_credito;
			$arraycomi[] 		= $t->comision;
			$arrayarticulos[] 	= $t->articulos;	
			}
				for ($i=0;$i<$longitud;$i++){
				$venta=new Pedidos;
				$venta->idcliente=$arraycliente[$i];
				$venta->tipo_comprobante="PED";
				$venta->serie_comprobante="NE00";
					$contador=DB::table('pedidos')->select('idpedido')->limit('1')->orderby('idpedido','desc')->first();
					$numero=$contador->idpedido;
				$venta->num_comprobante=($numero+1);
				$venta->total_venta=$arraymonto[$i];
				$mytime=Carbon::now('America/Caracas');
				$venta->fecha_hora=$mytime->toDateTimeString();
				$venta->fecha_emi=$mytime->toDateTimeString();
				$venta->impuesto='16';
				$venta->saldo=$arraymonto[$i];
				$venta->estado='Credito';	
				$venta->devolu='0';
				$venta->idvendedor=$arrayvend[$i];
				$venta->diascre=$arraydiascre[$i];
				$venta->comision=$arraycomi[$i];
				$venta->montocomision=(($arraymonto[$i])*($arraycomi[$i]/100));
				$venta->user=$user;
				$venta->pweb=1;
				$venta-> save();
				
				$arr=json_decode( $arrayarticulos[$i],TRUE);  
				$longart=count($arr);
							for ($j=0;$j<$longart;$j++){
						            $detalle=new DetallesPedidos();
									$detalle->idpedido=$venta->idpedido;
									$detalle->idarticulo=$arr[$j]['idarticulo']; 		
									$detalle->costoarticulo=(float)$arr[$j]['costo'];
									$detalle->cantidad=$arr[$j]['cantidad'];
									$detalle->descuento=0;
									$detalle->precio_venta=$arr[$j]['precio'];
									$detalle->fecha_emi=$mytime->toDateTimeString();	
									$detalle->save();
							}   						
			}
        } catch (Exception $e) {

          return Redirect::to('sininternet');
      }
			  return Redirect::to('pedidos');
    }

}
