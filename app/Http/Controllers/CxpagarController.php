<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Proveedores;
use App\Models\Comprobantes;
use App\Models\Compras;
use App\Models\Retenciones;
use App\Models\MovBancos;
use App\Models\Notasadmp;
use App\Models\Movnotasp;
use App\Models\Relacionncp;
use App\Models\Monedas;
use App\Models\Gastos;
use App\Models\Empresa;
use DB;
use Carbon\Carbon;
use Auth;

class CxpagarController extends Controller
{
       public function __construct()
	{
$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request)
		{
			$rol=DB::table('roles')-> select('abonarcxp','crearcompra','iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
			$query=trim($request->get('searchText'));
			$proveedores=DB::table('compras as i')
			->join('proveedores as p','p.idproveedor','=','i.idproveedor')
			->select(DB::raw('SUM(i.saldo) as acumulado'),'p.nombre','p.rif','p.telefono','p.idproveedor')
			->where('i.idempresa',$empresa->idempresa)
			->where('p.nombre','LIKE','%'.$query.'%')
			->groupby('p.idproveedor')
			->where('i.saldo','>',0)
			->paginate(20);
		return view('proveedores.pagar.index',["rol"=>$rol,"proveedores"=>$proveedores,"searchText"=>$query]);
		}
	}
	public function show(Request $request, $historia)
	{
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
			$monedas=DB::table('monedas')-> where ('idempresa',$empresa->idempresa)->get();
			
		$proveedor=Proveedores::findOrFail($historia);
			$datos=DB::table('compras as i')
			->join('proveedores as p','p.idproveedor','=','i.idproveedor')
			->select('i.total','p.idproveedor','i.retenido','i.tipo_comprobante','i.num_comprobante','i.serie_comprobante','i.fecha_hora','i.saldo','i.idcompra as idingreso','i.base','i.miva','i.exento','i.tasa')
			->where('i.idproveedor','=',$historia)
			->where('i.saldo','>',0)
		   ->paginate(20);
	
     return view('proveedores.pagar.show',["monedas"=>$monedas,"datos"=>$datos,"proveedor"=>$proveedor,"empresa"=>$empresa]);	
	}
	public function store (Request $request)
    {
		//dd($request);
		// inserta el recibo
          $idpago=$request->get('tidpago');
           $idbanco=$request->get('tidbanco');
		   $denomina=$request->get('denominacion');
           $tmonto=$request->get('tmonto');
           $tref=$request->get('tref');		 
           $contp=0;
              while($contp < count($idpago)){
				$recibo=new Comprobantes;
			  if($request->get('tipop')==0){
				
				$recibo->idcompra=$request->get('venta'); 
					$doc="COMP";
					$ndoc=$recibo->idcompra;
						$prov=Compras::findOrFail($request->get('venta'));
						$person=$prov->idproveedor;
						$clasi=7;
			  }if($request->get('tipop')==1){
				 $recibo->idgasto=$request->get('venta'); 
					$doc="GAST";
					$ndoc=$recibo->idgasto;
					$prov=Gastos::findOrFail($request->get('venta'));
					$person=$prov->idpersona;
					$clasi=4;
			  }
			  if($request->get('tipop')==2){
				 $recibo->idnota=$request->get('venta'); 
					$doc="N/DP";
					$ndoc=$recibo->idnota;
					$prov=Notasadmp::findOrFail($request->get('venta'));
					$person=$prov->idproveedor;
					$clasi=9;
			  }
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
						$mon=Monedas::findOrFail($idpago[$contp]);
							if($mon->idbanco>0){
								    $mov=new MovBancos;
									$mov->idbanco=$mon->idbanco;
									$mov->clasificador=$clasi;
									$mov->tipodoc=$doc;
									$mov->docrelacion=$request->get('venta'); 
									$mov->iddocumento=$recibo->idrecibo;
									$mov->tipo_mov="N/D";
									$mov->numero=$doc."-".$ndoc." Rec-".$recibo->idrecibo;
									$mov->concepto="Pago ".$doc;
									$mov->idbeneficiario= $person;	
									$mov->identificacion="";
									$mov->ced="";
									$mov->tipo_per="P";
									$mov->monto=$denomina[$contp];
									$mov->tasadolar=$request->get('tc');
									$mytime=Carbon::now('America/Caracas');
									$mov->fecha_mov=$mytime->toDateTimeString();	
									$mov->user=Auth::user()->name;
									$mov->save();
							}
				$contp=$contp+1;
			  } 
		if($request->get('tipop')==0){
		$compraup=Compras::findOrFail($request->get('venta'));
		$compraup->saldo=($recibo->aux);
		$compraup->update();}
		if($request->get('tipop')==1){
	 	$compraup=Gastos::findOrFail($request->get('venta'));
		$compraup->saldo=($recibo->aux);
		$compraup->update();}
		if($request->get('tipop')==2){
	 	$ndup=Notasadmp::findOrFail($request->get('venta'));
		$ndup->pendiente=($recibo->aux);
		$ndup->update();
			  }
	 return Redirect::to('showcxp/'.$request->get('idp'));
    }
	 public function retencion(Request $request)
    {	
	//dd($request);
		$idret=explode("_",$request->get('idretenc'));
		$fac=$request->get('factura');
		$emp=Empresa::findOrFail(1);
		if($idret[2]==1){$emp->corre_iva=$emp->corre_iva+1; $corre=$emp->corre_iva; }else{ $emp->corre_islr=$emp->corre_islr+1; $corre=$emp->corre_iva;}
		$emp->update();
		//dd($corre);
				$recibo=new Retenciones;
				$recibo->idcompra=$fac;
				$recibo->idproveedor=$request->get('idp');
				$recibo->documento=$request->get('docu');
				$recibo->retenc=$idret[0];
				$recibo->correlativo=$corre;
				$recibo->mfac=$request->get('mfac');
				$recibo->mbase=$request->get('mbase');
				$recibo->miva=$request->get('miva');
				$recibo->mexento=$request->get('mexen');
				$recibo->mret=$request->get('mret');
				$recibo->mretd=$request->get('mretd');
				$mytime=Carbon::now('America/Caracas');			
				$recibo->fecha=$mytime->toDateTimeString();
				$recibo->save();
		
			$compra=Compras::findOrFail($fac);
			$compra->saldo=($compra->saldo-$request->get('mretd'));
			$compra->retenido=($compra->retenido+$request->get('mretd'));
			//dd($venta);
			$compra->update();
			
		return Redirect::to('showcxp/'.$request->get('idp'));
	}
	public function retenciongasto(Request $request)
    {	
		$idret=explode("_",$request->get('idretencg'));
		$fac=$request->get('facturag');
		$emp=Empresa::findOrFail(1);
		if($idret[2]==1){$emp->corre_iva=$emp->corre_iva+1; $corre=$emp->corre_iva; }else{ $emp->corre_islr=$emp->corre_islr+1; $corre=$emp->corre_islr;}
		$emp->update();
				$recibo=new Retenciones;
				$recibo->idgasto=$fac;
				$recibo->idproveedor=$request->get('idpg');
				$recibo->documento=$request->get('docug');
				$recibo->retenc=$idret[0];
				$recibo->correlativo=$corre;
				$recibo->mfac=$request->get('mfacg');
				$recibo->mbase=$request->get('mbaseg');
				$recibo->miva=$request->get('mivag');
				$recibo->mexento=$request->get('mexeng');
				$recibo->mret=$request->get('mretg');
				$recibo->mretd=$request->get('mretdg');
				$mytime=Carbon::now('America/Caracas');			
				$recibo->fecha=$mytime->toDateTimeString();
				$recibo->save();
		
			$gto=Gastos::findOrFail($fac);
			$gto->saldo=($gto->saldo-$request->get('mretdg'));
			$gto->retenido=($gto->retenido+$request->get('mretdg'));
			$gto->update();
		return Redirect::to('showcxp/'.$request->get('idpg'));
	}
	public function detalle(Request $request,$id){

		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
					
		$pago=DB::table('comprobante')
        -> where('idcompra','=',$id)->get();	
		$ingreso=DB::table('compras as i')
            -> join ('proveedores as p','i.idproveedor','=','p.idproveedor')
            -> select ('i.controlcompra','i.idcompra as idingreso','i.idproveedor','i.fecha_hora','i.total','p.nombre','rif','p.telefono','direccion','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.condicion as estado','i.base','i.miva','i.exento','i.estatus')
            ->where ('i.idcompra','=',$id)
            -> first();

            $detalles=DB::table('detalle_compras as d')
            -> join('articulos as a','d.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta','d.subtotal')
            -> where ('d.idcompra','=',$id)
            ->get();	
            return view("proveedores.pagar.detalle",["ingreso"=>$ingreso,"empresa"=>$empresa,"detalles"=>$detalles,"pago"=>$pago]);

	}
	public function pago(Request $request)
    {	
	//dd($request);
		$moneda=explode("_",$request->get('pidpagomodal'));
		$fac=$request->get('factura');
		$saldo=$request->get('saldo'); 
		$cont = 0;
        while($cont < count($fac)){
			$venta=Compras::findOrFail($fac[$cont]);
			$venta->saldo=0;	
			$venta->update();
				
				$recibo=new Comprobantes;
				$recibo->idcompra=$fac[$cont];
				$recibo->monto=$saldo[$cont];
				$recibo->idnota=0;
				$recibo->idpago=$moneda[0];
				$recibo->idbanco=$moneda[1];
				$recibo->id_banco=0;
				$recibo->recibido=$saldo[$cont];			 
				$recibo->referencia="";
				$recibo->tasap="0";
				$recibo->tasab="0";
				$recibo->aux=0;
				$mytime=Carbon::now('America/Caracas');			
				$recibo->fecha_comp=$mytime->toDateTimeString();
				$recibo->save();	
					$mon=Monedas::findOrFail($recibo->idpago);
							if($mon->idbanco>0){
						    $mov=new MovBancos;
									$mov->idbanco=$mon->idbanco;
									$mov->clasificador=7;
									$mov->tipodoc="COMP";
									$mov->docrelacion=$fac[$cont];
									$mov->iddocumento=$recibo->idrecibo;
									$mov->tipo_mov="N/D";
									$mov->numero="COMP-".$recibo->idcompra." Rec-".$recibo->idrecibo;
									$mov->concepto="Pago Compras";
									$mov->idbeneficiario=$venta->idproveedor;	
									$mov->identificacion="";
									$mov->ced="";
									$mov->tipo_per="P";
									$mov->monto=$saldo[$cont];
									$mov->tasadolar=0;
									$mytime=Carbon::now('America/Caracas');
									$mov->fecha_mov=$mytime->toDateTimeString();	
									$mov->user=Auth::user()->name;
									$mov->save(); 
							}	
			$cont=$cont+1;
            } 
   return Redirect::to('cxp');
 }
	 	public function shownota($id){
		$dato=explode("_",$id);		
		
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
        $nota=DB::table('notasadmp as no')
		->join('proveedores as p','p.idproveedor','=','no.idproveedor')
		->where('no.idnota','=',$dato[0])
		->first();
		//dd($nota);
		$tipo=$dato[2];
		if($tipo==1){
			$pagos=DB::table('comprobante as re')
			-> where ('re.idnota','=',$nota->idnota)
            ->get();
				$pndconnc=DB::table('mov_notasp')
			->where('tipodoc','=',"N/D")
			->where('iddoc','=',$nota->idnota)
			->get();
		}else{
			$pagos=DB::table('relacionnc as re')
			->join('mov_notasp as mn','mn.id_mov','=','re.idmov')
			->where('re.idnota','=',$nota->idnota)
			->get();
					$pndconnc=DB::table('mov_notas')
			->where('tipodoc','=',"N/C")
			->where('iddoc','=',$nota->idnota)
			->get();
		}

  return view("proveedores.pagar.detallend",["tipo"=>$tipo,"link"=>$dato[1],"nota"=>$nota,"empresa"=>$empresa,"pagos"=>$pagos,"datond"=>$pndconnc,]);
	}
		public function aplicanc(Request $request)
	{
		//dd($request);
		if($request->get('tipo')=="N/D"){
			 $notas=Notasadmp::findOrFail($request->get('iddoc'));
			 $notas->pendiente=($notas->pendiente-$request->get('total_abn'));
			 $notas->update();
			 	$mov=new Movnotasp;
				$mov->tipodoc="N/D";
				$mov->iddoc=$request->get('iddoc');
				$mov->monto=$request->get('total_abn');
				$mov->referencia=$request->get('ref');
				$mytime=Carbon::now('America/Caracas');
				$mov->fecha=$mytime->toDateTimeString();
				$mov->user=Auth::user()->name;
				$mov->save();
				$nc=DB::table('notasadmp as da')
				-> select('da.idnota as not','da.pendiente')
				-> where ('da.tipo','=',2)
				-> where ('da.idproveedor','=',$request->get('idcliente'))
				-> where ('da.pendiente','>',0)
				->orderby ('idnota','asc')
				->get();	
			$longitud = count($nc);
			$array = array();
			foreach($nc as $t){
			$arrayidnota[] = $t->not;
			}
			$abono=$request->get('total_abn');
				for ($i=0;$i<$longitud;$i++){
						if($abono>0){
					$bajanota=Notasadmp::findOrFail($arrayidnota[$i]);
					$montonc=$bajanota->pendiente;
						if($montonc>$abono){
						$bajanota->pendiente=($bajanota->pendiente-$abono);
						$abono=0; }else{
						$bajanota->pendiente=0; $abono=($abono-$montonc);
						}
					$bajanota->update();
					$rnc=new Relacionncp;
				$rnc->idmov=$mov->id_mov;
				$rnc->idnota=$arrayidnota[$i];
				$rnc->save();	
				}	
				}	
				}
			if($request->get('tipo')=="FAC"){
				//dd($request);
			 $notas=Compras::findOrFail($request->get('iddoc'));
			 $notas->saldo=($notas->saldo-$request->get('total_abn'));
			 $notas->update();
 
			 	$mov=new Movnotasp;
				$mov->tipodoc="FAC";
				$mov->iddoc=$request->get('iddoc');
				$mov->monto=$request->get('total_abn');
				$mov->referencia=$request->get('ref');
				$mytime=Carbon::now('America/Caracas');
				$mov->fecha=$mytime->toDateTimeString();
				$mov->user=Auth::user()->name;
				$mov->save();	
				$nc=DB::table('notasadmp as da')
				-> select('da.idnota as not','da.pendiente')
				-> where ('da.tipo','=',2)
				-> where ('da.idproveedor','=',$request->get('idcliente'))
				-> where ('da.pendiente','>',0)
				->orderby ('idnota','asc')
				->get();	
			$longitud = count($nc);
			$array = array();
			foreach($nc as $t){
			$arrayidnota[] = $t->not;
			}
			$abono=$request->get('total_abn');
				for ($i=0;$i<$longitud;$i++){
					if($abono>0){
					$bajanota=Notasadmp::findOrFail($arrayidnota[$i]);
					$montonc=$bajanota->pendiente;
						if($montonc>$abono){
						$bajanota->pendiente=round(($bajanota->pendiente-$abono),2);
						$abono=0;
						}
						else{
						$bajanota->pendiente=0; $abono=($abono-$montonc);
						}
					$bajanota->update();
				$rnc=new Relacionncp;
				$rnc->idmov=$mov->id_mov;
				$rnc->idnota=$arrayidnota[$i];
				$rnc->save();	
				}	
				}
			}
		return Redirect::to('showcxp/'.$request->get('idcliente'));
	}
}
