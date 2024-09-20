<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Redirect;
use App\Models\Compras;
use App\Models\Gastos;
use App\Models\Detallecompras;
use App\Models\DevolucionCompras;
use App\Models\DetalledevolucionCompras;
use App\Models\Comprobantes;
use App\Models\MovBancos;
use App\Models\Proveedores;
use App\Models\Notasadmp;
use App\Models\Monedas;
use App\Models\Articulos;
use App\Models\Seriales;
use App\Models\Kardex;
use DB;
use Auth;
use Carbon\Carbon;

class ComprasController extends Controller
{
   	   public function __construct()
	{
	$this->middleware('auth');
	}
    public function index(Request $request)
    {
		
     if ($request)
        {$rol=DB::table('roles')-> select('crearcompra','anularcompra','iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
            $ingresos=DB::table('compras as i')
            -> join ('proveedores as p','i.idproveedor','=','p.idproveedor')
            -> join ('detalle_compras as di','i.idcompra','=','di.idcompra')
            -> select ('i.idcompra as idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.condicion as estado','i.estatus',DB::raw('sum(di.subtotal)as total'))
            -> where ('i.idempresa',$empresa->idempresa)
			-> where ('p.nombre','LIKE','%'.$query.'%')            
            -> groupBy('i.idcompra','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.condicion')
			->paginate(20);
     return view ('compras.ingreso.index',["empresa"=>$empresa,"rol"=>$rol,"ingresos"=>$ingresos,"searchText"=>$query]);
        }
	}
    public function create(Request $request){ 
		$rol=DB::table('roles')-> select('crearcompra','iduser')->where('iduser','=',$request->user()->id)->first();	
	if ($rol->crearcompra==1){
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		->where('id','=',$rol->iduser)->first();

		$monedas=DB::table('monedas')->where('idempresa',$empresa->idempresa)->get();
		$contador=DB::table('articulos')->select('idarticulo')->where('idempresa',$empresa->idempresa)->limit('1')->orderby('idarticulo','desc')->first();		
     
		$categorias=DB::table('categoria')->where('idempresa',$empresa->idempresa)->where('condicion','=','1')->get();
        $personas=DB::table('proveedores')
        -> where('estatus','=','A')->where('idempresa',$empresa->idempresa)->get();
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo,"-",art.nombre," - ",stock," - ",costo,"-",iva) as articulo'),'art.idarticulo','art.costo','art.serial')
        -> where('art.estado','=','Activo')
		->where('art.idempresa',$empresa->idempresa)
        -> get();
        return view("compras.ingreso.create",["cnt"=>$contador,"monedas"=>$monedas,"personas"=>$personas,"articulos"=>$articulos,"categorias"=>$categorias,"empresa"=>$empresa]);
	} else { 
	return view("reportes.mensajes.noautorizado");
	}   
   }
    public function store(Request $request){
	$rol=DB::table('roles')-> select('crearcompra','iduser')->where('iduser','=',$request->user()->id)->first();	
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
	$contador=DB::table('compras')->select(DB::raw('count(idcompra) as nrocompra'))->where('idempresa',$empresa->idempresa)->first();
	$user=Auth::user()->name;
	try{
    DB::beginTransaction();
    $ingreso=new Compras;
    $ingreso->idempresa=$empresa->idempresa;
    $ingreso->controlcompra=$contador->nrocompra+1;
    $ingreso->idproveedor=$request->get('idproveedor');
    $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
    $ingreso->serie_comprobante=$request->get('serie_comprobante');
    $ingreso->num_comprobante=$request->get('num_comprobante');
    $mytime=Carbon::now('America/Caracas');
    $ingreso->fecha_hora=$mytime->toDateTimeString();
    $ingreso->impuesto='16';
    $ingreso->emision=$request->get('emision');
    $ingreso->total=$request->get('total_venta');
    $ingreso->base=$request->get('base');
    $ingreso->miva=$request->get('iva');
    $ingreso->exento=$request->get('exento');
	if(empty($request->get('tdeuda'))){   $ingreso->saldo=$request->get('total_venta');}
	else { $ingreso->saldo=$request->get('tdeuda');}
    if ($ingreso->saldo > 0){
    $ingreso->condicion='Credito';} else { $ingreso->condicion='Contado';}
    $ingreso->tasa=$request->get('vtasa');
    $ingreso->user=$user;
    $ingreso-> save();	
		
	if($request->get('totala')>0){
  // inserta el recibo
          $idpago=$request->get('tidpago');
           $idbanco=$request->get('tidbanco');
		   $denomina=$request->get('denominacion');
           $tmonto=$request->get('tmonto');
           $tref=$request->get('tref');		 
           $contp=0;
              while($contp < count($idpago)){
				$recibo=new Comprobantes;
				$recibo->idcompra= $ingreso->idcompra;
				$recibo->monto=$request->get('total_venta');
				$recibo->idpago=$idpago[$contp];
				$recibo->idbanco=$idbanco[$contp];
				$recibo->recibido=$denomina[$contp];			
				$recibo->monto=$tmonto[$contp]; 
				$recibo->referencia=$tref[$contp];
				$recibo->tasap=$request->get('peso');
				$recibo->tasab=$request->get('tc');
				$recibo->aux=$request->get('tdeuda');
				$mytime=Carbon::now('America/Caracas');
				$recibo->fecha_comp=$mytime->toDateTimeString();						
				$recibo->save();	
				$contp=$contp+1;
			  } 
	}
	
// carga detalles de compra
        $idarticulo = $request -> get('idarticulo');
        $cantidad = $request -> get('cantidad');
        $precio_compra = $request -> get('precio_compra');
        $precio_cambio = $request -> get('ptasa');
        $precio_venta = $request -> get('precio_venta');
        $subtotal = $request -> get('stotal');
		
        
        $impuesto=0; $utilidad=0; $costo=0; $util2=0;
        $cont = 0; $cont2 = 0;
            while($cont < count($idarticulo)){
            $detalle=new DetalleCompras();
            $detalle->idcompra=$ingreso->idcompra;
            $detalle->idarticulo=$idarticulo[$cont];
            $detalle->cantidad=$cantidad[$cont];
            $detalle->precio_compra=$precio_compra[$cont];
            $detalle->precio_tasa=$precio_cambio[$cont];
            $detalle->precio_venta=$precio_venta[$cont];
            $detalle->subtotal=$subtotal[$cont];
			$mytime=Carbon::now('America/Caracas');
			$detalle->fecha=$mytime->toDateTimeString();
            $detalle->save();
			        //si posee serial
		$kar=new Kardex;
		$kar->fecha=$mytime->toDateTimeString();
		$kar->documento="COMP-".$request->get('num_comprobante');
		$kar->idarticulo=$idarticulo[$cont];
		$kar->cantidad=$cantidad[$cont];
		$kar->costo=$precio_compra[$cont];
		$kar->tipo=1; 
		$kar->user=$user;
		 $kar->save();
		 
        //actualizo costo   
        $articulo=Articulos::findOrFail($idarticulo[$cont]);
        $articulo->costo=$precio_compra[$cont];
        $articulo->costo_t=$precio_cambio[$cont];
        $costo= $precio_compra[$cont];
        $costot= $precio_cambio[$cont];
        $articulo->stock=$articulo->stock+$cantidad[$cont];
        $impuesto= $articulo->iva;
        $utilidad= $articulo->utilidad;

         $pt=($costo + (($utilidad/100)*$costo))+($costo + (($utilidad/100)*$costo))*($impuesto/100);
        $articulo->precio1=$pt;
        $articulo->precio_t=($costot + (($utilidad/100)*$costot))+($costot + (($utilidad/100)*$costot))*($impuesto/100);

        $articulo->update();
		$cont=$cont+1;
                    }
                     
               DB::commit();
			   }
catch(\Exception $e)
{
    DB::rollback();
}

return Redirect::to('showcompra/'.$ingreso->idcompra."-1");
}
	public function show($id){
		$data=explode("-",$id);
		$id=$data[0];
		$ruta=$data[1];
		
		$pago=DB::table('comprobante')
			-> where('idcompra','=',$id)->get();
		$ingreso=DB::table('compras as i')
			-> join ('proveedores as p','i.idproveedor','=','p.idproveedor')
			-> select ('i.idempresa','i.idcompra as idingreso','i.controlcompra','i.fecha_hora','i.total','p.nombre','p.telefono','rif','direccion','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.condicion as estado','i.base','i.miva','i.exento','i.estatus','i.idproveedor')
			->where ('i.idcompra','=',$id)
			-> first();


		$detalles=DB::table('detalle_compras as d')
			-> join('articulos as a','d.idarticulo','=','a.idarticulo')
			-> select('a.idarticulo','a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta','d.subtotal')
			-> where ('d.idcompra','=',$id)
			->get();		
		$empresa=DB::table('empresa')-> where('idempresa','=',$ingreso->idempresa)->first();
		return view("compras.ingreso.show",["ruta"=>$ruta,"ingreso"=>$ingreso,"empresa"=>$empresa,"detalles"=>$detalles,"pago"=>$pago]);
	}  
	public function etiquetas($id){
    $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $detalles=DB::table('detalle_compras as d')
            -> join('articulos as a','d.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','a.precio1','a.codigo')
            -> where ('d.idcompra','=',$id)
            ->get();
            return view("compras.ingreso.etiquetas",["empresa"=>$empresa,"detalles"=>$detalles]);
	}
	public function destroy(Request $request){
	
		//dd($request);
	$user=Auth::user()->name;
    $ingreso=new DevolucionCompras;
    $ingreso->idcompra=$request->get('id');
    $mytime=Carbon::now('America/Caracas');
    $ingreso->fecha_hora=$mytime->toDateTimeString();
	$ingreso->usuario=$user;
    $ingreso-> save();
	
	$ser=DB::table('seriales')
					->where('idcompra','=',$request->get('id'))->first();
			
				if($ser!= NULL){	
			$devs=Seriales::where('idcompra','=',$request->get('id'))->get();
			$devs->toQuery()->update(['estatus' => 1]);
				}
			$detalles=DB::table('detalle_compras as da')
            -> select('da.idarticulo as cod','da.cantidad')
            -> where ('da.idcompra','=',$request->get('id'))
            ->get();
					
		$longitud = count($detalles);
		$array = array();
			foreach($detalles as $t){
			$arraycod[] = $t->cod;
			$arraycan[] = $t->cantidad;
			}
		for ($i=0;$i<$longitud;$i++){
			$ingresod=new DetalledevolucionCompras;
			$ingresod->iddevolucion=$ingreso->iddevolucion;
			$ingresod->codarticulo=$arraycod[$i];
			$ingresod->cantidad=$arraycan[$i];
			$ingresod->fecha=$mytime->toDateTimeString();
			$ingresod-> save();
		
			$articulo=Articulos::findOrFail($arraycod[$i]);
			$articulo->stock=($articulo->stock-$arraycan[$i]);
			$articulo->update();
			
			$kar=new Kardex;			
			$kar->fecha=$mytime->toDateTimeString();
			$kar->documento="DEV:C-".$request->get('id');
			$kar->idarticulo=$arraycod[$i];
			$kar->cantidad=$arraycan[$i];
			$kar->costo=0;
			$kar->tipo=2; 
			$kar->user=$user;
			 $kar->save();
		}
			$comprobante=DB::table('comprobante as cb')
            -> select('cb.idrecibo')
            -> where ('cb.idcompra','=',$request->get('id'))
            ->get();
				$long = count($comprobante);
				$array = array();
			foreach($comprobante as $ct){
			$arrayid[] = $ct->idrecibo;
			}		 
				for ($j=0;$j<$long;$j++){
			$recibo=Comprobantes::findOrFail($arrayid[$j]);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				 	$mbanco=DB::table('mov_ban')
					->where('tipodoc','=',"COMP")
					->where('iddocumento','=',$arrayid[$j])->first();
			
				if($mbanco!= NULL){	
				$delmov=MovBancos::findOrFail($mbanco->id_mov);
				$delmov->monto=0;
				$delmov->concepto="Anul.".$request->get('id')."Rec".$arrayid[$j]."M:".$mrecibo;
				$delmov->estatus=1;
				$delmov->update();
				}
				}  
			
			 $ingreso=Compras::findOrFail($request->get('id'));
			 $ingreso->estatus='Anulada';
			  $ingreso->saldo='0';
			 $ingreso->update();
			 return Redirect::to('compras');
}
	public function almacena(Request $request)
    {	
		if($request->ajax()){	
		$paciente=new Proveedores;
        $paciente->nombre=$request->get('cnombre');
        $paciente->idempresa=$request->get('idempresa');
        $paciente->rif=$request->get('rif');
        $paciente->telefono=$request->get('ctelefono');
        $paciente->estatus='A';
        $paciente->tpersona=$request->get('tpersona');
        $paciente->direccion=$request->get('cdireccion');
        $paciente->contacto=$request->get('contacto');
        $paciente->save();
	
		$personas=DB::table('proveedores')-> where('rif','=',$request->get('rif'))->get();
           return response()->json($personas);
		}
    }
	public function validar (Request $request){
		if($request->ajax()){
        $result=DB::table('proveedores')
		->where('idempresa',$request->get('empresa'))
		->where('rif','=',$request->get('rif'))->get();
         return response()->json($result);
		}		
    }
	public function validarcod (Request $request){
            if($request->ajax()){
        $result=DB::table('articulos')
		->where('codigo','=',$request->get('codigo'))
		->where('idempresa','=',$request->get('idempresa'))
		->get();
         return response()->json($result);
		}     
	}
	public function almacenaart(Request $request)
    {
     if($request->ajax()){
		 $cat=explode("_",$request->get('idcategoria'));
		 $articulo=new Articulos;
		$articulo->idcategoria=$cat[0];
		$articulo->idempresa=$request->get('idempresa');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock="0";
        $articulo->estado='Activo';
        $articulo->utilidad=$request->get('utilidad');
        $articulo->precio1=$request->get('precio1');
        $articulo->costo=$request->get('costo');
        $articulo->iva=$request->get('impuesto');
		$articulo->save();

		$articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo,"-",art.nombre," - ",stock," - ",costo,"-",iva) as articulo'),'art.idarticulo','art.costo','art.serial')
        -> where('art.codigo','=',$request->get('codigo'))
        -> get();
           return response()->json($articulos);
		}
    }
	public function facturar($idproveedor){
		$categorias=DB::table('categoria')->where('condicion','=','1')->get();
		$contador=DB::table('articulos')->select('idarticulo')->limit('1')->orderby('idarticulo','desc')->first();		
		$empresa=DB::table('empresa')->join('sistema','sistema.idempresa','=','empresa.idempresa')->first();
		$monedas=DB::table('monedas')->get();
        $personas=DB::table('proveedores')
        -> where ('idproveedor','=',$idproveedor)
        -> where('estatus','=','A')->get();
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo,"-",art.nombre," - ",stock," - ",costo,"-",iva) as articulo'),'art.idarticulo','art.costo','art.serial')
        -> where('art.estado','=','Activo')
        -> get();
        return view("compras.ingreso.create",["cnt"=>$contador,"monedas"=>$monedas,"personas"=>$personas,"articulos"=>$articulos,"categorias"=>$categorias,"empresa"=>$empresa]);
    }
	public function anular(Request $request){
		
		$recibo=Comprobantes::findOrFail($request->get('id'));
	
		if($request->get('tiporecibo')==0){
			$compra=$recibo->idcompra;
			//
				$mbanco=DB::table('mov_ban')->where('tipodoc','=',"COMP")->where('iddocumento','=',$request->get('id'))->first();
				if($mbanco!= NULL){	
					$delmov=MovBancos::findOrFail($mbanco->id_mov);
					$montobanco=$delmov->monto;
					$idbanco=$delmov->idbanco;
					$delmov->monto=0;
					$delmov->concepto="Anul.".$delmov->docrelacion."Rec".$delmov->iddocumento."M:".$montobanco;
					$delmov->estatus=1;
					$delmov->update();	
				}
		}	if($request->get('tiporecibo')==1){
			$compra=$recibo->idgasto;	
				$mbanco=DB::table('mov_ban')->where('tipodoc','=',"GAST")->where('iddocumento','=',$request->get('id'))->first();
				if($mbanco!= NULL){	
					$delmov=MovBancos::findOrFail($mbanco->id_mov);
					$montobanco=$delmov->monto;
					$idbanco=$delmov->idbanco;
					$delmov->monto=0;
					$delmov->concepto="Anul.".$delmov->docrelacion."Rec".$delmov->iddocumento."M:".$montobanco;
					$delmov->estatus=1;
					$delmov->update();	
				}
		}
		if($request->get('tiporecibo')==2){
			$compra=$recibo->idnota;	
				$mbanco=DB::table('mov_ban')->where('tipodoc','=',"N/DP")->where('iddocumento','=',$request->get('id'))->first();
				if($mbanco!= NULL){	
					$delmov=MovBancos::findOrFail($mbanco->id_mov);
					$montobanco=$delmov->monto;
					$idbanco=$delmov->idbanco;
					$delmov->monto=0;
					$delmov->concepto="Anul.".$delmov->docrelacion."Rec".$delmov->iddocumento."M:".$montobanco;
					$delmov->estatus=1;
					$delmov->update();	
				}
		}
		 $monton=$recibo->monto;
		 $recibo->referencia='Anulado '.$monton.'$';
		 $recibo->monto=0;
		 $recibo->recibido=0;
		 $recibo->update();
			 if($request->get('tiporecibo')==0){
					 $ingreso=Compras::findOrFail($compra);
					  $ingreso->saldo=($ingreso->saldo+$monton);
					 $ingreso->update();
			 }if($request->get('tiporecibo')==1){
					 $ingreso=Gastos::findOrFail($compra);
					  $ingreso->saldo=($ingreso->saldo+$monton);
					 $ingreso->update(); 
			 }
			 if($request->get('tiporecibo')==2){
					 $ingreso=Notasadmp::findOrFail($compra);
					  $ingreso->pendiente=($ingreso->pendiente+$monton);
					 $ingreso->update(); 
			 }
return Redirect::to('detallegresos');
		
}
}
