<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Ventas;
use App\Models\Movnotas;
use App\Models\Monedas;
use App\Models\Notasadm;
use App\Models\Recibos;
use App\Models\MovBancos;
use App\Models\DetalleVentas;
use App\Models\Kardex;
use App\Models\Articulos;
use App\Models\Seriales;
use App\Models\Devolucion;
use App\Models\Detalledevolucion;
use App\Models\Formalibre;
use App\Models\Clientes;
use Carbon\Carbon;
use DB;
use Auth;

class VentasController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth');
	function truncar($numero, $digitos)
	{
    $truncar = 10**$digitos;
    return intval($numero * $truncar) / $truncar;
	}
	}
	 public function index(Request $request)
    {
        if ($request)
        {
			$rol=DB::table('roles')-> select('crearventa','anularventa','iduser')->where('iduser','=',$request->user()->id)->first();
			   $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> join ('detalle_venta as dv','v.idventa','=','dv.idventa')
            -> select ('v.idventa','v.fecha_hora','p.nombre','v.flibre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.devolu','v.estado','v.total_venta','v.user')
            -> where ('p.nombre','LIKE','%'.$query.'%')
             -> where ('v.idempresa',$empresa->idempresa)
            -> orderBy('v.idventa','desc')
            -> groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
                ->paginate(50);
     
     return view ('ventas.venta.index',["rol"=>$rol,"ventas"=>$ventas,"searchText"=>$query,"empresa"=>$empresa]);
        }
    }
    public function create(Request $request){
		
		//dd($request->user()->id);
		$rol=DB::table('roles')-> select('crearventa','iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('id','=',$rol->iduser)->first();
		
		if ($rol->crearventa==1){
		$monedas=DB::table('monedas')->where('idempresa',$empresa->idempresa)->get();
		$vendedor=DB::table('vendedores')->where('idempresa',$empresa->idempresa)->get();
        $personas=DB::table('clientes')->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')->select('clientes.id_cliente','clientes.tipo_precio','clientes.tipo_cliente','clientes.nombre','clientes.cedula','vendedores.comision','vendedores.id_vendedor as nombrev')->where('clientes.idempresa',$empresa->idempresa)-> where('clientes.status','=','A')->groupby('clientes.id_cliente')->get();

		 	$contador=DB::table('venta')->select(DB::raw('count(idventa) as idventa'))->where('idempresa',$empresa->idempresa)->get();
    //  dd($contador);
	if($empresa->negativo==0){
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
        -> where('art.estado','=','Activo')
        -> where('art.idempresa','=',$empresa->idempresa)
        -> where ('art.stock','>','0')
        ->groupby('articulo','art.idarticulo')
	-> get();}else{
		  $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
        -> where('art.estado','=','Activo')
        -> where('art.idempresa','=',$empresa->idempresa)
        ->groupby('articulo','art.idarticulo')
		-> get();
		}
		//dd($articulos);
		   $seriales =DB::table('seriales')->where('estatus','=',0)->get();
     if ($contador==""){$contador=0;}
      return view("ventas.venta.create",["seriales"=>$seriales,"rol"=>$rol,"personas"=>$personas,"articulos"=>$articulos,"monedas"=>$monedas,"contador"=>$contador,"empresa"=>$empresa,"vendedores"=>$vendedor]);
    } else { 
	return view("reportes.mensajes.noautorizado");
	}
	}	
    public function store(Request $request){
		//dd($request);
		$rol=DB::table('roles')-> select('crearventa','iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('id','=',$rol->iduser)->first();
		$user=Auth::user()->name;
   try{
   DB::beginTransaction();
   $contador=DB::table('venta')->select(DB::raw('count(idventa) as idventa'))->where('idempresa',$empresa->idempresa)->first();
   if ($contador==NULL){$numero=0;}else{$numero=$contador->idventa;}

//registra la venta
    $venta=new Ventas;
	$idcliente=explode("_",$request->get('id_cliente'));
    $venta->idcliente=$idcliente[0];
    $venta->idempresa=$empresa->idempresa;
    $venta->tipo_comprobante=$request->get('tipo_comprobante');
    $venta->serie_comprobante="A";
    $venta->num_comprobante=($numero+1);
    $venta->idvendedor=$request->get('nvendedor');
    $venta->controlventa=($numero+1);
    $venta->control=$request->get('control');
    $venta->tasa=$request->get('tc');
    $venta->total_venta=$request->get('total_venta');
    $venta->base=$request->get('totalbase');
    $venta->total_iva=$request->get('total_iva');
    $venta->texe=$request->get('totalexe');
    $venta->descuento=$request->get('mdsctoventa');
    $mytime=Carbon::now('America/Caracas');
    $venta->fecha_hora=$mytime->toDateTimeString();
	$venta->fecha_emi=$request->get('fecha_emi');
    $venta->impuesto='16';
		if(($request->get('tdeuda')==0)and($request->get('convertir')=="on")){
			$venta->flibre=1;
			}
	if(empty($request->get('tdeuda'))){   $venta->saldo=$request->get('total_venta');}
	else { $venta->saldo=$request->get('tdeuda');}
    if ($venta->saldo > 0){
    $venta->estado='Credito';} else { $venta->estado='Contado';}
    $venta->devolu='0';
    $venta->comision=$request->get('comision');
    $venta->obs=$request->get('obs');
	$venta->montocomision=($request->get('total_venta')*($request->get('comision')/100));
	$venta->user=$user;
   $venta-> save();

    // inserta el recibo
          $idpago=$request->get('tidpago');
           $idbanco=$request->get('tidbanco');
		   $denomina=$request->get('denominacion');
           $tmonto=$request->get('tmonto');
           $tref=$request->get('tref');		 
           $contp=0;
		   if($request->get('totala')>0){
              while($contp < count($idpago)){
				$recibo=new Recibos;
				$recibo->idventa=$venta->idventa;
				if($request->get('tdeuda')>0){
				$recibo->tiporecibo='A'; }else{$recibo->tiporecibo='P'; }
				$recibo->monto=$request->get('total_venta');
				$pago=explode("_",$idbanco[$contp]);
				$recibo->idpago=$idpago[$contp]; // bbanco
				$recibo->idnota=0;
				$recibo->id_banco=0;
				$recibo->idbanco=$idbanco[$contp]; 
				$recibo->recibido=$denomina[$contp];			
				$recibo->monto=$tmonto[$contp]; 
				$recibo->referencia=$tref[$contp];
				$recibo->tasap=$request->get('peso');
				$recibo->tasab=$request->get('tc');
				$recibo->aux=$request->get('tdeuda');
				$recibo->fecha=$mytime->toDateTimeString();		
				$recibo->usuario=$user;					
				$recibo->save();			
				 $contp=$contp+1;
			  }  
		   }
		    
        $idarticulo = $request -> get('idarticulo');
        $cantidad = $request -> get('cantidad');
        $descuento = $request -> get('descuento');
        $precio_venta = $request -> get('precio_venta');
        $costoarticulo = $request -> get('costoarticulo');

        $cont = 0;
            while($cont < count($idarticulo)){
            $detalle=new DetalleVentas();
            $detalle->idventa=$venta->idventa;
            $detalle->idarticulo=$idarticulo[$cont];
            $detalle->costoarticulo=$costoarticulo[$cont];
            $detalle->cantidad=$cantidad[$cont];
            $detalle->descuento=$descuento[$cont];
            $detalle->precio_venta=$precio_venta[$cont];
			 $detalle->fecha_emi=$mytime->toDateTimeString();	
            $detalle->save();

				$kar=new Kardex;
		$kar->fecha=$mytime->toDateTimeString();
		$kar->documento="VENT-".($numero+1);
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
		$cli=Clientes::findOrFail($idcliente[0]);
        $cli->lastfact=$mytime->toDateTimeString();
        $cli->update();
	DB::commit();
}
catch(\Exception $e)
{
    DB::rollback();
}
	if($empresa->tikect==1){
		  return Redirect::to('recibo/'.$venta->idventa);
	}else{
	return Redirect::to('tcarta/'.$venta->idventa.'-1');
	}
	}
 public function showdevolucion(Request $request, $id)
    {   
			$rol=DB::table('roles')-> select('anularventa','iduser','ajustarventa')->where('iduser','=',$request->user()->id)->first();
			 $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> select ('v.tasa','v.saldo','v.idventa','v.fecha_hora','v.devolu','p.cedula','p.nombre','p.telefono','p.direccion','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where ('v.idventa','=',$id)
            -> first();

            $detalles=DB::table('detalle_venta as dv')
            -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','dv.iddetalle_venta','dv.idarticulo','dv.cantidad','dv.descuento','dv.precio_venta')
            -> where ('dv.idventa','=',$id)
            ->get();
			$recibo=DB::table('recibos as r')-> where ('r.idventa','=',$id)
            ->get();
			
		 $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
        -> where('art.estado','=','Activo')
        -> where('art.idempresa','=',$empresa->idempresa)
        -> where ('art.stock','>','0')
        ->groupby('articulo','art.idarticulo')
        -> get();
            return view("ventas.venta.devolucion",["rol"=>$rol,"listarticulos"=>$articulos,"venta"=>$venta,"detalles"=>$detalles,"recibo"=>$recibo,"empresa"=>$empresa]);
      
    }
public function devolucion(Request $request){
	$rol=DB::table('roles')-> select('anularventa','iduser')->where('iduser','=',$request->user()->id)->first();
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
//registra la devolucion
//dd($empresa);
	$user=Auth::user()->name;
    $devolucion=new Devolucion;
    $devolucion->idempresa=$empresa->idempresa;
    $devolucion->idventa=$request->get('idventa');
    $devolucion->comprobante=$request->get('comprobante');
    $mytime=Carbon::now('America/Lima');
    $devolucion->fecha_hora=$mytime->toDateTimeString();
    $devolucion->user=$user;
	$devolucion-> save();

    $venta=Ventas::findOrFail( $devolucion->idventa);
	$cliente=$venta->idcliente;
    $venta->devolu='1';
	$venta->saldo='0';
    $venta->update();
	$anularecibo=0;

//registra el detalle de la devolucion
        $idarticulo = $request -> get('idarticulo');
        $cantidad = $request -> get('cantidad');
        $descuento = $request -> get('descuento');
        $precio_venta = $request -> get('precio_venta');
        $recibos = $request -> get('idrecibo');
        $cont = 0;
        $contr = 0;

            while($cont < count($idarticulo)){
            $detalle=new Detalledevolucion();
            $detalle->iddevolucion=$devolucion->iddevolucion;
            $detalle->idarticulo=$idarticulo[$cont];
            $detalle->cantidad=$cantidad[$cont];
            $detalle->descuento=$descuento[$cont];
            $detalle->precio_venta=$precio_venta[$cont];
            $detalle->save();
            $articulo=Articulos::findOrFail($idarticulo[$cont]);
            $articulo->stock=($articulo->stock+$cantidad[$cont]);
            $articulo->update();
		$kar=new Kardex;
		$kar->fecha=$mytime->toDateTimeString();
		$kar->documento="DEV:V-".$request->get('comprobante');
		$kar->idarticulo=$idarticulo[$cont];
		$kar->cantidad=$cantidad[$cont];
		$kar->costo=$precio_venta[$cont];
		$kar->tipo=1; 
		$kar->user=$user;
		 $kar->save(); 
            $cont=$cont+1;
            }
		
				if($request -> get('idrecibo')){
			 while($contr < count($recibos)){
			$recibo=Recibos::findOrFail($recibos[$contr]);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
			$contr=$contr+1;
				}  			
			 }    
	if(Auth::user()->nivel=="A"){
		return Redirect::to('ventas');}else{
		return Redirect::to('ventacaja');
	}
}
	public function devoluparcial(Request $request){
	//dd($request);
	//    try{
	//DB::beginTransaction();
	$user=Auth::user()->name;
	$vdolar=$request -> get('tasa');
    $detalleventa=DetalleVentas::findOrFail($request->iddetalle);
	$idar=$detalleventa->idarticulo;
	$aux= $detalleventa->cantidad*$detalleventa->precio_venta;
	$nc=($detalleventa->cantidad-$request -> get('cantidad'));
	$aux2=$request -> get('cantidad')*$request -> get('precio');	
	$costo=$detalleventa->costoarticulo;

			$artcomi=Articulos::findOrFail($idar);
				if($artcomi->iva>0){ 
				$baseant=truncar((($detalleventa->precio_venta)/(($artcomi->iva/100)+1)), 2);
				$auxb=truncar(($baseant*$vdolar),2);
				$baseant=truncar(($detalleventa->cantidad*$auxb),2);	
				$subivant=truncar(($baseant*($artcomi->iva/100)), 2);	
				$subivant=truncar($subivant,2);
		
				$basenew=truncar((($request -> get('precio'))/(($artcomi->iva/100)+1)), 2);
				$auxbnew=truncar(($basenew*$vdolar),2);
				$basenew=truncar(($request -> get('cantidad')*$auxbnew),2);	
				$subivanew=truncar(($basenew*($artcomi->iva/100)), 2);	
				$subivanew=truncar($subivanew,2);

					$subexeant=0;
					$subexenew=0;
			}else{
					$subivant=$subivanew=$basenew=$baseant=0;
					$subexeant=truncar($detalleventa->cantidad*(($detalleventa->precio_venta*$vdolar)),2);
					$subexenew=truncar($request -> get('cantidad')*(($request -> get('precio')*$vdolar)),2);

			}				
					$aventa=Ventas::findOrFail($request -> get('idventa'));
					$abono=$aventa->total_venta-$aventa->saldo;
					$aventa->base=(($aventa->base-$baseant)+$basenew);
					$aventa->total_iva=(($aventa->total_iva-$subivant)+$subivanew);
					$aventa->texe=(($aventa->texe-$subexeant)+$subexenew);
					$descuento=$aventa->descuento;
					$aventa->total_venta=(($aventa->total_venta-($aux+$descuento))+$aux2);
					$aventa->total_pagar=0;	 
					$aventa->saldo=($aventa->total_venta-$abono);
					$aventa->montocomision=($aventa->total_venta*($aventa->comision/100));						
					$aventa->update();	
		
		$detalleventa->cantidad=$request -> get('cantidad');
		$detalleventa->precio_venta=$request -> get('precio');
		$detalleventa->update();
		
			$articulo=Articulos::findOrFail($idar);
            $articulo->stock=($articulo->stock+$nc);
            $articulo->update();
		$kar=new Kardex;
		$mytime=Carbon::now('America/Caracas');
		$kar->fecha=$mytime->toDateTimeString();
		$kar->documento="DEVP-".$request -> get('idventa');
		$kar->idarticulo=$idar;
		$kar->cantidad=$nc;
		$kar->costo=$costo;
		$kar->tipo=1; 
		$kar->user=$user;	
		 $kar->save();	
/* DB::commit();
}
catch(\Exception $e)
{
    DB::rollback();
} */

  return Redirect::to('fbs/'.$request -> get('idventa'));
}
public function recibo($id){

			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> select ('v.idempresa','v.idventa','v.descuento','v.fecha_hora','p.nombre','p.rif as cedula','p.direccion','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu')
            ->where ('v.idventa','=',$id)
            -> first();
            $detalles=DB::table('detalle_venta as dv')
            -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','a.iva','dv.cantidad','dv.descuento','dv.precio_venta')
            -> where ('dv.idventa','=',$id)
            ->get();
			$recibo=DB::table('recibos as r')-> where ('r.idventa','=',$id)
            ->get();

			$empresa=DB::table('empresa')-> where('idempresa','=',$venta->idempresa)->first();
            return view("ventas.venta.recibo",["venta"=>$venta,"recibos"=>$recibo,"empresa"=>$empresa,"detalles"=>$detalles]);
}
public function show(Request $request, $id){
//dd($id);
	$dato=explode("-",$id);
    $id=$dato[0];
    $ruta=$dato[1];
	//dd($ruta);

			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> select ('v.idempresa','v.idventa','p.id_cliente','v.fecha_hora','p.nombre','p.rif','p.cedula','p.telefono','p.direccion','v.descuento','v.control','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu','v.obs')
            ->where ('v.idventa','=',$id)
            -> first();
			//dd($venta);
            $detalles=DB::table('detalle_venta as dv')
            -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
            -> select('a.idarticulo','a.nombre as articulo','a.iva','a.unidad','dv.cantidad','dv.descuento','dv.precio_venta')
            -> where ('dv.idventa','=',$id)
            ->get();
			
			$recibo=DB::table('recibos as r')-> where ('r.idventa','=',$id)
            ->get();
			//dd($retencion);
			$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$recibonc=DB::table('mov_notas as mov')-> where ('mov.iddoc','=',$id)-> where ('mov.tipodoc','=',"FAC")
            ->get();

            return view("ventas.venta.show",["ruta"=>$ruta,"venta"=>$venta,"recibos"=>$recibo,"recibonc"=>$recibonc,"empresa"=>$empresa,"detalles"=>$detalles]);
}
public function fbs(Request $request, $id){

			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> select ('v.idempresa','v.idventa','v.fecha_hora','p.nombre','p.rif','p.cedula','p.telefono','p.direccion','v.control','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu')
            ->where ('v.idventa','=',$id)
            -> first();
            $detalles=DB::table('detalle_venta as dv')
            -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
            -> select('a.idarticulo','a.nombre as articulo','a.iva','a.unidad','dv.cantidad','dv.descuento','dv.precio_venta')
            -> where ('dv.idventa','=',$id)
            ->get();
			
			$recibo=DB::table('recibos as r')-> where ('r.idventa','=',$id)
            ->get();
			//dd($retencion);
			$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$recibonc=DB::table('mov_notas as mov')-> where ('mov.iddoc','=',$id)-> where ('mov.tipodoc','=',"FAC")
            ->get();
            return view("ventas.venta.formatobs",["venta"=>$venta,"recibos"=>$recibo,"recibonc"=>$recibonc,"empresa"=>$empresa,"detalles"=>$detalles]);
}
 public function almacena(Request $request)
    {	
	//dd($request);
     if($request->ajax()){
		 $paciente=new Clientes;
        $paciente->nombre=$request->get('cnombre');
        $paciente->idempresa=$request->get('idempresa');
        $paciente->cedula=$request->get('ccedula');
        $paciente->rif=$request->get('rif');
        $paciente->codpais=$request->get('codpais');
        $paciente->telefono=$request->get('ctelefono');
        $paciente->status='A';
        $paciente->direccion=$request->get('cdireccion');
        $paciente->tipo_cliente=$request->get('ctipo_cliente');
        $paciente->tipo_precio=1;
		 $paciente->vendedor=$request->get('idvendedor');
		  $mytime=Carbon::now('America/Caracas');
		$paciente->creado=$mytime->toDateTimeString();
        $paciente->save();
	// dd($paciente);
	$personas=DB::table('clientes')
	->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')
	->select('clientes.id_cliente','clientes.tipo_precio','clientes.nombre','clientes.cedula','clientes.tipo_cliente','vendedores.comision','vendedores.id_vendedor as nombrev')
	-> where('clientes.cedula','=',$request->get('ccedula'))->get();
           return response()->json($personas);
	}
    }
	public function validar (Request $request){
        if($request->ajax()){
			
			$pacientes=DB::table('clientes')->where('cedula','=',$request->get('ccedula'))
			->where('idempresa','=',$request->get('empresa'))
			->get();
         return response()->json($pacientes);
		}
      
     }
	 public function refrescar(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('id','=',$rol->iduser)->first();
		if($request->ajax()){
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2')
        -> where('art.idempresa',$empresa->idempresa)
        -> where('art.estado','=','Activo')
        -> where ('art.stock','>','0')
        ->groupby('articulo','art.idarticulo')
        -> get();
           return response()->json($articulos);
		}
    }
	public function facturar(Request $request, $idcliente){
		//dd($request);
		$rol=DB::table('roles')-> select('crearventa','iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('id','=',$rol->iduser)->first();	
		if ($rol->crearventa==1){
	    $monedas=DB::table('monedas')->where('idempresa',$empresa->idempresa)->get();
		$vendedor=DB::table('vendedores')->where('idempresa',$empresa->idempresa)->get();

         $personas=DB::table('clientes')->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')->select('clientes.id_cliente','clientes.tipo_precio','clientes.nombre','clientes.cedula','clientes.tipo_cliente','vendedores.comision','vendedores.id_vendedor as nombrev')
         -> where('status','=','A')
		 ->groupby('clientes.id_cliente')
         -> where ('id_cliente','=',$idcliente)
         ->get();
        	$contador=DB::table('venta')->select(DB::raw('count(idventa) as idventa'))->where('idempresa',$empresa->idempresa)->get();
      //dd($contador);
        $articulos =DB::table('articulos as art')
         -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
         -> where('art.idempresa','=',$empresa->idempresa)
         -> where('art.estado','=','Activo')
         -> where ('art.stock','>','0')
         ->groupby('articulo','art.idarticulo','art.stock')
         -> get();
		    $seriales =DB::table('seriales')->where('estatus','=',0)->get();
     return view("ventas.venta.create",["seriales"=>$seriales,"rol"=>$rol,"personas"=>$personas,"monedas"=>$monedas,"articulos"=>$articulos,"contador"=>$contador,"empresa"=>$empresa,"vendedores"=>$vendedor]);
	    } else { 
	return view("reportes.mensajes.noautorizado");
	}
	}
	public function anular(Request $request){
			//dd($request);
    $id=$request->get('id');
    $tipo=$request->get('tipo');
	if($tipo==1){
		$user=Auth::user()->name;
			 $recibo=Recibos::findOrFail($id);
			 $venta=$recibo->idventa;
			 $monton=$recibo->monto;
			 $nota=$recibo->idnota;
			 $recibo->referencia='Anulado ->'.$monton;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				$mbanco=DB::table('mov_ban')
				->where('tipodoc','=',$request->get('doc'))
				->where('iddocumento','=',$request->get('id'))->first();
			
				if($mbanco!= NULL){	
				$delmov=MovBancos::findOrFail($mbanco->id_mov);
				$delmov->monto=0;
				$delmov->concepto="Anul.".$request->get('doc')."Rec".$request->get('id')."M:".$monton;
				$delmov->estatus=1;
				$delmov->update();
				}
				
		if($request->get('doc')=="FAC"){
			$ingreso=Ventas::findOrFail($venta);
			$ingreso->saldo=($ingreso->saldo+$monton);
			$ingreso->update(); }else{
			$nd=Notasadm::findOrFail($nota);
			$nd->pendiente=($nd->pendiente+$monton);
			$nd->update();
		}
	}else{
		$nota=Movnotas::findOrFail($id);
				$nc=DB::table('relacionnc')-> where('idmov','=',$id)->first();
		$doc=$nota->tipodoc;
		
			if($doc=="N/D"){
				$mov=Notasadm::findOrFail($nota->iddoc); 	
				$mov->pendiente=$mov->pendiente+$nota->monto;
				$mov->update();
			}else{
				$mov=Ventas::findOrFail($nota->iddoc); 	
				$mov->saldo=$mov->saldo+$nota->monto;
				$mov->update();
			}
				$movnc=Notasadm::findOrFail($nc->idnota); 	
				$movnc->pendiente=$movnc->pendiente+$nota->monto;
				$movnc->update();
		$nota->monto=0;
		$nota->referencia="Anulado";
		$nota->update();		
	}	
				 return Redirect::to('detalleingresos');
	}
	public function vcxc(Request $request)
    {   
     if($request->ajax()){
		 	$idcliente=explode("_",$request->get('id_cliente'));
         $datov=DB::table('venta as v')
        ->select(DB::raw('SUM(v.saldo) as monto' ),'v.idcliente')
        ->where('v.idcliente','=',$idcliente[0])
         ->groupby('v.idcliente')
        -> get();
          return response()->json($datov);
 }
    }
	public function anulforma(Request $request){

    $ventaf=Formalibre::findOrFail($request->id);
    $ventaf->anulado=1;
    $ventaf->update();
    return Redirect::to('correlativof');
}
	public function deletearticulo(Request $request){
//dd($request);
    $dev=DetalleVentas::findOrFail($request->idarticulo);
	$valor=$dev->precio_venta*$dev->cantidad;
    $dev->cantidad=0;
    $dev->precio_venta=0;
    $dev->update();
	$ajv=Ventas::findOrFail($dev->idventa);
	$ajv->total_venta=$ajv->total_venta-$valor;
	$ajv->saldo=$ajv->saldo-$valor;
	 $ajv->update();
	
      return Redirect::to('showdevolucion/'.$ajv->idventa);
}
public function addarticuloventa(Request $request){
//dd($request);
		$dev=Articulos::findOrFail($request->pidarticulo);
		$valor=$dev->precio1*$request->cantidad;
		
	$ajv=Ventas::findOrFail($request->idventa);
	$ajv->total_venta=$ajv->total_venta+$valor;
	$ajv->saldo=$ajv->saldo+$valor;
	 $ajv->update();
	
	$detalle=new DetalleVentas();
            $detalle->idventa=$request->idventa;
            $detalle->idarticulo=$request->pidarticulo;
            $detalle->costoarticulo=$dev->costo;
            $detalle->cantidad=$request->cantidad;
            $detalle->descuento=0;
            $detalle->precio_venta=$dev->precio1;
			 $detalle->fecha_emi=$ajv->fecha_emi;	
            $detalle->save();
			

	
      return Redirect::to('showdevolucion/'.$ajv->idventa);
}
 public function visorprecio($id){
	// dd($id);
	 $ide=Auth::user()->idempresa;
	     $monedas=DB::table('monedas')-> where('idempresa','=',$ide)->get();
	   		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('empresa.idempresa','=',$id)->first();
	$articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
        -> where('art.estado','=','Activo')
        -> where('art.idempresa','=',$empresa->idempresa)
        -> where ('art.stock','>','0')
        ->groupby('articulo','art.idarticulo')
	-> get();
     return view("ventas.venta.visorprecios",["monedas"=>$monedas,"articulos"=>$articulos,"empresa"=>$empresa]);
 }
}
