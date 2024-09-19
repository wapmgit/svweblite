<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Pedidos;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use App\Models\DetallesPedidos;
use App\Models\Kardex;
use App\Models\Articulos;
use App\Models\Devolucion;
use App\Models\Detalledevolucion;
use App\Models\Clientes;
use Carbon\Carbon;
use DB;
use Auth;
class PedidosController extends Controller
{
	
   public function __construct()
	{
		$this->middleware('auth');
	}
	 public function index(Request $request)
    {
		//dd($request);
        if ($request)
        {
			$rol=DB::table('roles')-> select('crearpedido','anularpedido','web')->where('iduser','=',$request->user()->id)->first();
			   $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
            $ventas=DB::table('pedidos as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
			->join('vendedores as ve','ve.id_vendedor','=','v.idvendedor')
            -> join ('detalle_pedido as dv','v.idpedido','=','dv.idpedido')
            -> select ('v.idpedido','v.fecha_hora','v.pweb','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.devolu','v.estado','v.total_venta','ve.nombre as user')
            -> where ('v.impor','=',0)
            -> where ('v.devolu','=',0)
			-> where ('p.nombre','LIKE','%'.$query.'%')
            -> orderBy('v.idpedido','desc')
            -> groupBy('v.idpedido')
            ->paginate(20);
     
     return view ('pedidos.pedido.index',["rol"=>$rol,"ventas"=>$ventas,"searchText"=>$query,"empresa"=>$empresa]);
        }
    }
	public function create(Request $request){
		$rol=DB::table('roles')-> select('crearpedido')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->crearpedido==1){
		$monedas=DB::table('monedas')->get();
		$vendedor=DB::table('vendedores')->get();
        $empresa=DB::table('empresa')->join('sistema','sistema.idempresa','=','empresa.idempresa')->first();
        $personas=DB::table('clientes')->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')->select('clientes.id_cliente','clientes.tipo_precio','clientes.tipo_cliente','clientes.nombre','clientes.cedula','vendedores.comision','vendedores.id_vendedor as nombrev')-> where('clientes.status','=','A')->groupby('clientes.id_cliente')->get();
         $contador=DB::table('pedidos')->select('idpedido')->limit('1')->orderby('idpedido','desc')->get();
      //dd($contador);
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2')
        -> where('art.estado','=','Activo')
        ->groupby('articulo','art.idarticulo')
        -> get();
		//dd($articulos);
     if ($contador==""){$contador=0;}
      return view("pedidos.pedido.create",["rol"=>$rol,"personas"=>$personas,"articulos"=>$articulos,"monedas"=>$monedas,"contador"=>$contador,"empresa"=>$empresa,"vendedores"=>$vendedor]);
    } else { 
	return view("reportes.mensajes.noautorizado");
	}
	}	
	public function store(Request $request){
	
		$user=Auth::user()->name;
 try{
  DB::beginTransaction(); 
   $contador=DB::table('pedidos')->select('idpedido')->limit('1')->orderby('idpedido','desc')->first();
   if ($contador==NULL){$numero=0;}else{$numero=$contador->idpedido;}

//registra la venta
    $venta=new Pedidos;
	$idcliente=explode("_",$request->get('id_cliente'));
    $venta->idcliente=$idcliente[0];
    $venta->tipo_comprobante=$request->get('tipo_comprobante');
    $venta->idvendedor=$request->get('nvendedor');
    $venta->serie_comprobante=$request->get('serie_comprobante');
    $venta->num_comprobante=($numero+1);
    $venta->total_venta=$request->get('total_venta');
    $mytime=Carbon::now('America/Caracas');
    $venta->fecha_hora=$mytime->toDateTimeString();
	$venta->fecha_emi=$request->get('fecha_emi');
    $venta->impuesto='16';
	$venta->saldo=$request->get('total_venta');
    $venta->estado='Credito';
    $venta->devolu='0';
    $venta->comision=$request->get('comision');
	$venta->montocomision=($request->get('total_venta')*($request->get('comision')/100));
	$venta->user=$user;
   $venta-> save();

        $idarticulo = $request -> get('idarticulo');
        $cantidad = $request -> get('cantidad');
        $descuento = $request -> get('descuento');
        $precio_venta = $request -> get('precio_venta');
        $costoarticulo = $request -> get('costoarticulo');

        $cont = 0;
            while($cont < count($idarticulo)){
            $detalle=new DetallesPedidos();
            $detalle->idpedido=$venta->idpedido;
            $detalle->idarticulo=$idarticulo[$cont];
            $detalle->costoarticulo=$costoarticulo[$cont];
            $detalle->cantidad=$cantidad[$cont];
            $detalle->descuento=$descuento[$cont];
            $detalle->precio_venta=$precio_venta[$cont];
			 $detalle->fecha_emi=$mytime->toDateTimeString();	
            $detalle->save();
            $cont=$cont+1;
            }
	DB::commit();
}
catch(\Exception $e)
{
    DB::rollback();
}
  return Redirect::to('pedidos');
}
public function show(Request $request,$id){
	$rol=DB::table('roles')-> select('importarpedido','editpedido')->where('iduser','=',$request->user()->id)->first();	
    $user=Auth::user()->name;
    $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();

    $venta=DB::table('pedidos as pe')
    -> join ('clientes as p','pe.idcliente','=','p.id_cliente')
	->join('vendedores as v','v.id_vendedor','=','pe.idvendedor')
    -> select ('v.nombre as nombrev','pe.idpedido','pe.fecha_hora','p.nombre','p.telefono','p.cedula','p.direccion','pe.tipo_comprobante','pe.serie_comprobante','pe.num_comprobante','pe.impuesto','pe.estado','pe.total_venta','pe.devolu')
    ->where ('pe.idpedido','=',$id)
    -> first();

    $detalles=DB::table('detalle_pedido as dv')
    -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
    -> select('a.nombre as articulo','dv.cantidad','dv.descuento','dv.iddetalle_pedido','a.idarticulo','a.iva','dv.precio_venta','a.costo','a.stock')
    -> where ('dv.idpedido','=',$id)
    ->get();
	$articulos =DB::table('articulos as art')
	-> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva')
	-> where('art.estado','=','Activo')
	-> where ('art.stock','>','0')
	->groupby('articulo','art.idarticulo')
	-> get();
	//dd($detalles);
    return view("pedidos.pedido.show",["rol"=>$rol,"venta"=>$venta,"empresa"=>$empresa,"detalles"=>$detalles,"articulos"=>$articulos]);
}
	public function ajuste(Request $request){
	//	dd($request);
	
	try{
	DB::beginTransaction();
	$user=Auth::user()->name;
    $detalleventa=Detallespedidos::findOrFail($request->iddetalle);
	$aux= $detalleventa->cantidad*$detalleventa->precio_venta;
	$aux2=$request -> get('cantidad')*$request -> get('precio');	
	$costo=$detalleventa->costoarticulo;

		$venta=Pedidos::findOrFail($request -> get('idventa'));
			if($venta->total_venta>0){
		  	 $descuento=($venta->descuento);
			 $venta->total_venta=(($venta->total_venta-($aux+$descuento))+$aux2);
			$venta->total_pagar=0;	 
			 $venta->saldo=(($venta->total_venta-($aux+$descuento))+$aux2);
			$venta->montocomision=($venta->total_venta*($venta->comision/100));
			$venta->update();	}
	$detalleventa->cantidad=$request -> get('cantidad');
	$detalleventa->precio_venta=$request -> get('precio');
	$detalleventa->update();

	 DB::commit();
	}
	catch(\Exception $e)
	{
		DB::rollback();
	}
	return Redirect::to('showpedido/'.$request -> get('idventa'));
	}
	function facturar(Request $request){
		//dd($request);
		$user=Auth::user()->name;
		//correlativo de ventas
		  $contador=DB::table('venta')->select('idventa')->limit('1')->orderby('idventa','desc')->first();
		if ($contador==NULL){$numero=0;}else{$numero=$contador->idventa;}
		//busco el pedido
		$dpedido=Pedidos::findOrFail($request -> get('idventa'));
		$dpedido->impor=1;
		$dpedido->update();
		//registro la venta
		$venta=new Ventas;
		$venta->idcliente=$dpedido->idcliente;
		$venta->tipo_comprobante="FAC";
		$venta->serie_comprobante=$dpedido->serie_comprobante;
		$venta->control=$request->get('control');
		$venta->num_comprobante=($numero+1);
		$venta->total_venta=$dpedido->total_venta;
		$venta->tasa=$request->get('tasa');
		$venta->base=$request->get('total_base');
		$venta->total_iva=$request->get('total_iva');
		$venta->texe=$request->get('texe');
		$venta->idvendedor=$dpedido->idvendedor;
		$mytime=Carbon::now('America/Caracas');
		$venta->fecha_hora=$mytime->toDateTimeString();
		$venta->fecha_emi=$request->get('fecha_emi');
		$venta->impuesto='16';
		$venta->saldo=$dpedido->total_venta;
		$venta->estado='Credito';
		$venta->devolu='0';
		$venta->comision=$dpedido->comision;
		$venta->montocomision=$dpedido->montocomision;
		$venta->user=$user;
   $venta-> save();
   //de la venta
   
    $idarticulo = $request -> get('idarticulo');
    $cantidad = $request -> get('cantidad');
    $precio_venta = $request -> get('precio');
    $costoarticulo = $request -> get('costo');
    $descuento = $request -> get('descuento');
	 $fecha_emi = $request->get('fecha_emi');
	 $serie = $request->get('serie_comprobante');
	 
    $mytime=Carbon::now('America/Caracas');
    $cont = 0;
        while($cont < count($idarticulo)){
			if($cantidad[$cont]>0){
        $detalle=new DetalleVentas();
        $detalle->idventa=$venta->idventa;
        $detalle->idarticulo=$idarticulo[$cont];
        $detalle->costoarticulo=$costoarticulo[$cont];
        $detalle->cantidad=$cantidad[$cont];
        $detalle->descuento=$descuento[$cont];
        $detalle->precio_venta=$precio_venta[$cont];
         $detalle->fecha=$mytime->toDateTimeString();	
         $detalle->fecha_emi=$fecha_emi;	
        $detalle->save();
            $kar=new Kardex;
    $kar->fecha=$mytime->toDateTimeString();
    $kar->documento="VENT-".$venta->idventa;
    $kar->idarticulo=$idarticulo[$cont];
    $kar->cantidad=$cantidad[$cont];
    $kar->costo=$costoarticulo[$cont];
    $kar->tipo=2; 
    $kar->user=$user;
     $kar->save();  
                  //actualizo stock   
    $articulo=Articulos::findOrFail($idarticulo[$cont]);
    $articulo->stock=$articulo->stock-$cantidad[$cont];
    $articulo->update();
        $cont=$cont+1;
        }
		}
        return Redirect::to('pedidos');
	}
	public function destroy(Request $request){
		//dd($request);
			 $venta=Pedidos::findOrFail($request->get('id'));
			 $venta->devolu=1;
             $venta->update();
			 return Redirect::to('pedidos');
	}
	public function reporte(Request $request){
		$rol=DB::table('roles')-> select('editpedido')->where('iduser','=',$request->user()->id)->first();
		if ($request->get('idvendedor'))
        {		
		$query=trim($request->get('idvendedor'));
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$vendedor=DB::table('vendedores')->get();
		$detalles=DB::table('detalle_pedido as dv')
		->join('pedidos as ve','ve.idpedido','=','dv.idpedido')
		-> join('articulos as a','dv.idarticulo','=','a.idarticulo')
		-> select(DB::raw('sum(dv.cantidad) as cantidad'),'ve.idvendedor as vendedor','a.nombre as articulo','a.stock','a.idarticulo')
		->where('ve.tipo_comprobante','=',"PED")
		->where('ve.idvendedor','=',$query)
		->where('ve.devolu','=',0)
		->where('ve.impor','=',0)
		->groupby('dv.idarticulo','ve.idvendedor')
		->get();
		$ven=DB::table('vendedores')-> where('id_vendedor','=',$query)->first();
		$query=$ven->nombre;
		$valida=1;
		}else{
		$query=trim($request->get('idvendedor'));
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$vendedor=DB::table('vendedores')->get();
		$detalles=DB::table('detalle_pedido as dv')
		->join('pedidos as ve','ve.idpedido','=','dv.idpedido')
		-> join('articulos as a','dv.idarticulo','=','a.idarticulo')
		-> select(DB::raw('sum(dv.cantidad) as cantidad'),'a.nombre as articulo','a.stock','a.idarticulo')
		->where('ve.devolu','=',0)
		->where('ve.impor','=',0)
		->groupby('dv.idarticulo')
		->get();		
		$query="Todos Vendedores";
		$valida=0;
			}
		return view("reportes.pedido.index",["rol"=>$rol,"valida"=>$valida,"vendedor"=>$vendedor,"ventas"=>$detalles,"searchText"=>$query,"empresa"=>$empresa]);
	}
	public function ajustepv(Request $request, $id){
	
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
  	$var=explode("_",$id);
	//dd($var);
	$detalles=DB::table('pedidos as ve')
	->join('detalle_pedido as dv','dv.idpedido','=','ve.idpedido')
	->join('clientes as cl','ve.idcliente','=','cl.id_cliente')
    -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
    -> select('ve.idpedido','cl.nombre','a.nombre as articulo','a.stock','dv.cantidad','cl.vendedor','dv.iddetalle_pedido','dv.idarticulo')
	->where('ve.idvendedor','=',$var[1])
	->where('ve.devolu','=',0)
	->where('ve.impor','=',0)
	->where('dv.idarticulo','=',$var[0])
    ->get();	
	//dd($detalles);
	return view ('reportes.pedido.ajuste',["detalles"=>$detalles,"empresa"=>$empresa]);
	}
	public function devolucionpedido(Request $request){
	//d($request);
	try{
	DB::beginTransaction();
	$user=Auth::user()->name;
    $detalleventa=Detallespedidos::findOrFail($request->iddetalle);
	$aux= $detalleventa->cantidad*$detalleventa->precio_venta;
	$aux2=$request->cantidad*$detalleventa->precio_venta;
	$costo=$detalleventa->costoarticulo;
		$venta=Pedidos::findOrFail($request->idventa);
			if($venta->total_venta>0){
		  	  $descuento=($venta->descuento);
			  $venta->total_venta=($venta->total_venta-($aux2+$descuento));
			  $venta->total_pagar=0;	  
	  }else{
	  $venta->total_venta=($venta->total_venta-($aux2));
	  $venta->total_pagar=($venta->total_pagar-($aux2));}
	  $venta->saldo=($venta->saldo-($aux2));
	  $venta->montocomision=($venta->total_venta*($venta->comision/100));
	  $venta->update();	
	$detalleventa->cantidad=($detalleventa->cantidad-$request->cantidad);
	$detalleventa->update();
	 DB::commit();
	}
	catch(\Exception $e)
	{
		DB::rollback();
	}
	return Redirect::to('ajustepv/'.$request->idarticulo."_".$request->vendedor);
	}
	public function addart(Request $request){
		//dd($request);
			$mytime=Carbon::now('America/Caracas');
			$detalle=new DetallesPedidos();
            $detalle->idpedido=$request->idpedido;
            $detalle->idarticulo=$request->idarticulo;
            $detalle->costoarticulo=$request->pcostoarticulo;
            $detalle->cantidad=$request->pcantidad;
            $detalle->descuento=0;
            $detalle->precio_venta=$request->pprecio_venta;
			 $detalle->fecha_emi=$mytime->toDateTimeString();	
            $detalle->save();
		$nvv=($request->pcantidad*$request->pprecio_venta);
		$venta=Pedidos::findOrFail($request->idpedido);
		$venta->total_venta=($venta->total_venta+$nvv);
		$venta->saldo=($venta->total_venta);
		$venta->montocomision=($venta->total_venta*($venta->comision/100));
		$venta->update();
		return Redirect::to('showpedido/'.$request->idpedido);
	}
		public function descargados(Request $request)
    { 		
			$rol=DB::table('roles')-> select('importarpedido','web')->where('iduser','=',$request->user()->id)->first();	
			//dd($rol);
	 if ($rol->web==1){
		 try {	
		
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$client = new Client();	
			$response = $client->request('POST', 'http://pedidos.nks-sistemas.net/api/pedidos-descargados?limite=50&empresa='.$empresa->codigo);		
			$datos= $response->getBody();
			$datos2=  json_decode($datos,false);          		 
			$datos3=$datos2->data;
			if(count($datos3)>0){
	
				//dd($datos3);
				foreach($datos3 as $art){	
					$cliente=DB::table('clientes')->select('nombre','id_cliente')-> where('id_cliente','=',$art->cliente_id)->first();							
					$arraynombre[]		= $cliente->nombre;
				}
			}else{ $arraynombre[]=0; }
			
		} catch (Exception $e) {
           return Redirect::to('sininternet');
        }
		//dd($datos3);
		return view ('pedidos.descargados.index',["rol"=>$rol,"empresa"=>$empresa,"datos3"=>$datos3,"nombresc"=>$arraynombre]);
    } else { 
	return view("reportes.mensajes.noautorizado");
	}
	}
		public function bajarpedido($id)
	 {
		$user=Auth::user()->name;
      //  try {
		$client = new Client();	
		$response = $client->request('POST', 'http://pedidos.nks-sistemas.net/api/descargar-pedido?id='.$id);		
		$datos= $response->getBody();
		$datos2=  json_decode($datos,false);          		 
		$datos3=$datos2->data;
		//dd($datos2);
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
					  if ($contador==""){$numero=0;}else{$numero=$contador->idpedido;}
					
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
				//del registro de articulo del pedido
				//$longart = count($arrayarticulos);
				
				$arr=json_decode( $arrayarticulos[$i],TRUE);  
				$longart=count($arr);
					//dd($arr);
							for ($j=0;$j<$longart;$j++){
						            $detalle=new DetallesPedidos();
									$detalle->idpedido=$venta->idpedido;
									$detalle->idarticulo=$arr[$j]['idarticulo']; 		
									$detalle->costoarticulo=(float)$arr[$j]['costo'];
									$detalle->cantidad=$arr[$j]['cantidad'];
									$detalle->descuento=0;
									$detalle->precio_venta=$arr[$j]['precio'];
									$detalle->fecha=$mytime->toDateTimeString();	
									$detalle->fecha_emi=$mytime->toDateTimeString();	
									$detalle->save();
							}   						
			}

			  return Redirect::to('pedidos');
	}
}
