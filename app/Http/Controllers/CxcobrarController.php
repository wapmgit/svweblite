<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Clientes;
use App\Models\Recibos;
use App\Models\Ventas;
use App\Models\Formalibre;
use App\Models\RetencionVentas;
use App\Models\MovBancos;
use App\Models\Monedas;
use App\Models\Movnotas;
use App\Models\Relacionnc;
use App\Models\Notasadm;
use DB;
use Carbon\Carbon;
use Auth;

class CxcobrarController extends Controller
{
    public function __construct()
	{
$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request)
		{
		$rol=DB::table('roles')-> select('abonarcxc','crearventa','iduser')->where('iduser','=',$request->user()->id)->first();
			$query=trim($request->get('searchText'));
			 $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
			$pacientes=DB::table('venta as v')
			->join('clientes as c','c.id_cliente','=','v.idcliente')
			->join('vendedores as ve','ve.id_vendedor','=','c.vendedor')
			->select(DB::raw('SUM(v.saldo) as acumulado'),DB::raw('SUM(v.total_venta) as tventa'),'c.nombre','ve.nombre as vendedor','c.cedula','c.codpais','c.telefono','c.id_cliente')
			 -> where ('c.idempresa',$empresa->idempresa)
			->where('c.nombre','LIKE','%'.$query.'%')
			->where('v.saldo','>',0)
			->groupby('c.id_cliente')
			->paginate(20);
			//

			return view('clientes.cobrar.index',["empresa"=>$empresa,"rol"=>$rol,"pacientes"=>$pacientes,"searchText"=>$query]);
		}
	}
	public function show(Request $request, $historia)
		{
			$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
			$monedas=DB::table('monedas')-> where ('idempresa',$empresa->idempresa)->get();

			$cliente=Clientes::findOrFail($historia);
			$datos=DB::table('venta as v')
			->join('clientes as c','c.id_cliente','=','v.idcliente')
			->select('v.tasa','v.base','v.texe','v.total_iva as ivabs','v.flibre','v.mret','v.total_venta','c.id_cliente','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.fecha_hora','v.fecha_emi','v.saldo','v.idventa')
			->where('v.idcliente','=',$historia)
			->where('v.saldo','>',0)
		   ->get();
			//	dd($notas);
			return view('clientes.cobrar.show',["datos"=>$datos,"cliente"=>$cliente,"monedas"=>$monedas,"empresa"=>$empresa]);	
		}
	public function store (Request $request)
    {
		//dd($request);
		$tipodoc=$request->get('tipodoc');
		$user=Auth::user()->name;
		//dd($tipodoc);
			
		if($tipodoc==1){
			// inserta el recibo
			$cliente=Ventas::findOrFail($request->get('venta'));
          $idpago=$request->get('tidpago');
           $idbanco=$request->get('tidbanco');
		   $denomina=$request->get('denominacion');
           $tmonto=$request->get('tmonto');
           $tref=$request->get('tref');		 
           $contp=0;
             while($contp < count($idpago)){
				$recibo=new Recibos;
				$recibo->idventa=$request->get('venta');
				if($request->get('tdeuda')>0){
				$recibo->tiporecibo='A'; }else{$recibo->tiporecibo='A'; }
				$recibo->monto=$request->get('total_venta');
				$recibo->idpago=$idpago[$contp];
				$recibo->id_banco=0;
				$recibo->idbanco=$idbanco[$contp];
				$recibo->recibido=$denomina[$contp];			
				$recibo->monto=$tmonto[$contp]; 
				$recibo->referencia=$tref[$contp];
				$recibo->tasap=$request->get('peso');
				$recibo->tasab=$request->get('tc');
				$recibo->aux=$request->get('tdeuda');
				$mytime=Carbon::now('America/Caracas');
				$recibo->fecha=$mytime->toDateTimeString();	
				$recibo->usuario=$user;				
				$recibo->save();
				$contp=$contp+1;
			  } 
				$ventaup=ventas::findOrFail($request->get('venta'));
				$ventaup->saldo=($recibo->aux);
				$ventaup->update();

		}

	return Redirect::to('cxc');
    }
	public function pagocxc(Request $request)
    {	
		//dd($request);
		$moneda=explode("_",$request->get('pidpagomodal'));
		$fac=$request->get('factura');
		$saldo=$request->get('saldo'); 
		$cont = 0;
        while($cont < count($fac)){
			$venta=Ventas::findOrFail($fac[$cont]);
			$venta->saldo=0;	
			$venta->update();
				
				$recibo=new Recibos;
				$recibo->idventa=$fac[$cont];
				$recibo->tiporecibo="A";
				$recibo->idnota=0;
				$recibo->monto=$saldo[$cont];
				$recibo->idpago=$moneda[0];
				$recibo->idbanco=$moneda[1];
				$recibo->id_banco=0;
				$recibo->recibido=$saldo[$cont];			 
				$recibo->referencia="";
				$recibo->tasap=0;
				$recibo->tasab=0;
				$recibo->aux=0;
				$mytime=Carbon::now('America/Caracas');			
				$recibo->fecha=$mytime->toDateTimeString();
				$recibo->usuario=Auth::user()->name;
				$recibo->save();	
					$mon=Monedas::findOrFail($recibo->idpago);
							if($mon->idbanco>0){
						    $mov=new MovBancos;
									$mov->idbanco=$mon->idbanco;
									$mov->clasificador=2;
									$mov->tipodoc="FAC";
									$mov->docrelacion=$venta->idventa;
									$mov->iddocumento=$recibo->idrecibo;
									$mov->tipo_mov="N/C";
									$mov->numero="FAC-".$recibo->idventa." Rec-".$recibo->idrecibo;
									$mov->concepto="Cobranza";
									$mov->idbeneficiario=$venta->idcliente;	
									$mov->identificacion="";
									$mov->ced="";
									$mov->tipo_per="C";
									$mov->monto=$saldo[$cont];
									$mov->tasadolar=0;
									$mytime=Carbon::now('America/Caracas');
									$mov->fecha_mov=$mytime->toDateTimeString();	
									$mov->user=Auth::user()->name;
									$mov->save(); 
							}	
			$cont=$cont+1;
            } 
		return Redirect::to('cxc');
	}
	public function multiple (Request $request){
		//dd($request);
		$user=Auth::user()->name;
		$ventas=DB::table('venta as ve')
            -> select('ve.idventa as cod','ve.saldo')
            -> where ('ve.idcliente','=',$request->get('cliente'))
			->where('ve.saldo','>',0)
			->orderBy('ve.idventa','asc')
            ->get();
		$moneda=explode("_",$request->get('pidpagom'));
		if($moneda[1]==1){$abono=$request->get('montom')/$moneda[2];}else{
		$abono=$request->get('montom')*$moneda[2];}
		//dd($abono);
		$longitud = count($ventas);
		$array = array();
			foreach($ventas as $t){
			$arraycod[] = $t->cod;
			}
			for ($i=0;$i<$longitud;$i++){
			$mov=Ventas::findOrFail($arraycod[$i]);
			if($abono>0){
			$monto=$abono-$mov->saldo;
			$saldo=$mov->saldo;
			if($monto>0){ 	
				$mov->saldo=0;
				$recibo=new Recibos;
				$recibo->idventa=$arraycod[$i];
				$recibo->idnota=0;
				$recibo->tiporecibo='A';
				$recibo->idpago=$moneda[0];
				$recibo->idbanco=$request->get('nmoneda');		
				$recibo->monto=$saldo;
					if($moneda[1]==2){		
					$recibe=$saldo/$moneda[2];}else{
					$recibe=$saldo*$moneda[2];}
				$recibo->recibido=$recibe;
				$recibo->referencia="Pago Multiple";
				 $recibo->id_banco=0;
				 $recibo->tasab=0;
				 $recibo->tasap=0;
				$recibo->aux=0;
				$mytime=Carbon::now('America/Lima');
				$recibo->fecha=$mytime->toDateTimeString();
				$recibo->usuario=$user;
				$recibo->save();	
					//mov ban
					$mon=Monedas::findOrFail($recibo->idpago);
							if($mon->idbanco>0){
								    $movb=new MovBancos;
									$movb->idbanco=$mon->idbanco;
									$movb->clasificador=2;
									$movb->tipodoc="FAC";
									$movb->docrelacion=$arraycod[$i];
									$movb->iddocumento=$recibo->idrecibo;
									$movb->tipo_mov="N/C";
									$movb->numero="FAC-".$recibo->idventa." Rec-".$recibo->idrecibo;
									$movb->concepto="Cobranza";
									$movb->idbeneficiario=$mov->idcliente;	
									$movb->identificacion="";
									$movb->ced="";
									$movb->tipo_per="C";
									$movb->monto=$recibe;
									$movb->tasadolar=0;
									$mytime=Carbon::now('America/Caracas');
									$movb->fecha_mov=$mytime->toDateTimeString();	
									$movb->user=Auth::user()->name;
							$movb->save(); }
			}else{ 
			$mov->saldo=($monto*-1);
				$recibo=new Recibos;
			$recibo->idventa=$arraycod[$i];
			$recibo->idnota=0;
 			$recibo->tiporecibo='A';
            $recibo->idpago=$moneda[0];
            $recibo->idbanco=$request->get('nmoneda');			
			$recibo->monto=$abono;
				if($moneda[1]==2){		
				$recibo->recibido=$abono/$moneda[2];}else{
				$recibo->recibido=$abono*$moneda[2];}
            $recibo->referencia="Pago Multiple";
			$recibo->id_banco=0;
             $recibo->tasab=0;
			 $recibo->tasap=0;
            $recibo->aux=0;
            $mytime=Carbon::now('America/Lima');
			$recibo->fecha=$mytime->toDateTimeString();
			$recibo->usuario=$user;
			$recibo->save();
				$mon=Monedas::findOrFail($recibo->idpago);
							if($mon->idbanco>0){
								    $movb=new MovBancos;
									$movb->idbanco=$mon->idbanco;
									$movb->clasificador=2;
									$movb->tipodoc="FAC";
									$movb->docrelacion=$arraycod[$i];
									$movb->iddocumento=$recibo->idrecibo;
									$movb->tipo_mov="N/C";
									$movb->numero="FAC-".$recibo->idventa." Rec-".$recibo->idrecibo;
									$movb->concepto="Cobranza";
									$movb->idbeneficiario=$mov->idcliente;	
									$movb->identificacion="";
									$movb->ced="";
									$movb->tipo_per="C";
									$movb->monto=$recibo->recibido;
									$movb->tasadolar=0;
									$mytime=Carbon::now('America/Caracas');
									$movb->fecha_mov=$mytime->toDateTimeString();	
									$movb->user=Auth::user()->name;
									$movb->save(); 
							}
			}
		$mov->update();
		$abono=$monto;
		}
		}
		return Redirect::to('cxc');
	}
	public function aplicanc(Request $request)
	{
		//dd($request);
		if($request->get('tipo')=="N/D"){
			 $notas=Notasadm::findOrFail($request->get('iddoc'));
			 $notas->pendiente=($notas->pendiente-$request->get('total_abn'));
			 $notas->update();
			 	$mov=new Movnotas;
				$mov->tipodoc="N/D";
				$mov->iddoc=$request->get('iddoc');
				$mov->monto=$request->get('total_abn');
				$mov->referencia=$request->get('ref');
				$mytime=Carbon::now('America/Caracas');
				$mov->fecha=$mytime->toDateTimeString();
				$mov->user=Auth::user()->name;
				$mov->save();
				$nc=DB::table('notasadm as da')
				-> select('da.idnota as not','da.pendiente')
				-> where ('da.tipo','=',2)
				-> where ('da.idcliente','=',$request->get('idcliente'))
				-> where ('da.pendiente','>',0)
				->get();	
			$longitud = count($nc);
			$array = array();
			foreach($nc as $t){
			$arrayidnota[] = $t->not;
			}
			$abono=$request->get('total_abn');
				for ($i=0;$i<$longitud;$i++){
						if($abono>0){
					$bajanota=Notasadm::findOrFail($arrayidnota[$i]);
					$montonc=$bajanota->pendiente;
						if($montonc>$abono){
						$bajanota->pendiente=($bajanota->pendiente-$abono);
						$abono=0;}else{
						$bajanota->pendiente=0; $abono=($abono-$montonc);
						}
					$bajanota->update();
					$rnc=new Relacionnc;
				$rnc->idmov=$mov->id_mov;
				$rnc->idnota=$arrayidnota[$i];
				$rnc->save();	
				}	
				}	
				}
			if($request->get('tipo')=="FAC"){
				//dd($request);
			 $notas=Ventas::findOrFail($request->get('iddoc'));
			 $notas->saldo=($notas->saldo-$request->get('total_abn'));
			 $notas->update();
			 		if(($notas->saldo==0)and($request->get('convertirnc')=="on")){
						$pnro=DB::table('formalibre')
						->select(DB::raw('MAX(idforma) as pnum'))
						->first();	
						
						$fl=new Formalibre;
						$fl->idventa=$request->get('iddoc');
						$fl->nrocontrol=($pnro->pnum+1);
						$fl->save();
						
			$n=Ventas::findOrFail($request->get('iddoc'));
			 $n->flibre=1;
			 $n->update();
					} 
			 	$mov=new Movnotas;
				$mov->tipodoc="FAC";
				$mov->iddoc=$request->get('iddoc');
				$mov->monto=$request->get('total_abn');
				$mov->referencia=$request->get('ref');
				$mytime=Carbon::now('America/Caracas');
				$mov->fecha=$mytime->toDateTimeString();
				$mov->user=Auth::user()->name;
				$mov->save();	
				$nc=DB::table('notasadm as da')
				-> select('da.idnota as not','da.pendiente')
				-> where ('da.tipo','=',2)
				-> where ('da.idcliente','=',$request->get('idcliente'))
				-> where ('da.pendiente','>',0)
				->get();	
			$longitud = count($nc);
			$array = array();
			foreach($nc as $t){
			$arrayidnota[] = $t->not;
			}
			$abono=$request->get('total_abn');
				for ($i=0;$i<$longitud;$i++){
						if($abono>0){
					$bajanota=Notasadm::findOrFail($arrayidnota[$i]);
					$montonc=$bajanota->pendiente;
						if($montonc>$abono){
						$bajanota->pendiente=round(($bajanota->pendiente-$abono),2);
							$abono=0;
							}else{
						$bajanota->pendiente=0; $abono=($abono-$montonc);
						}
					$bajanota->update();
				$rnc=new Relacionnc;
				$rnc->idmov=$mov->id_mov;
				$rnc->idnota=$arrayidnota[$i];
				$rnc->save();	
				}	
				}
				}
		return Redirect::to('showcxc/'.$request->get('idcliente'));
	}
		public function detalle($id){
	
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            ->where ('v.idventa','=',$id)
            -> first();
            $detalles=DB::table('detalle_venta as dv')
            -> join('articulos as a','dv.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','dv.cantidad','dv.idarticulo','dv.descuento','dv.precio_venta')
            -> where ('dv.idventa','=',$id)
            ->get();
            $articulos=DB::table('articulos')-> where('estado','=','Activo')->get();
			$abonos=DB::table('recibos')-> where('idventa','=',$id)->get();
          //  dd($articulos);
  return view("clientes.cobrar.detalle",["venta"=>$venta,"empresa"=>$empresa,"detalles"=>$detalles,"articulos"=>$articulos,"abonos"=>$abonos]);
	}
	public function pagond(Request $request)
    {	
	//dd($request);
			$user=Auth::user()->name;
		$moneda=explode("_",$request->get('pidpagomodaln'));
		$fac=$request->get('nota');
		$saldo=$request->get('pendiente'); 
		$cont = 0;
        while($cont < count($fac)){
			$venta=Notasadm::findOrFail($fac[$cont]);
			$venta->pendiente=0;	
			$venta->update();
				
				$recibo=new Recibos;
				$recibo->idventa=0;
				$recibo->tiporecibo="A";
				$recibo->idnota=$fac[$cont];
				$recibo->monto=$saldo[$cont];
				$recibo->idpago=$moneda[0];
				$recibo->idbanco=$moneda[1];
				$recibo->recibido=$saldo[$cont];			 
				$recibo->referencia="";
				$recibo->tasap=0;
				$recibo->id_banco=0;
				$recibo->tasab=0;
				$recibo->aux=0;
				$mytime=Carbon::now('America/Caracas');			
				$recibo->fecha=$mytime->toDateTimeString();
				$recibo->usuario=$user;
				$recibo->save();
								$mon=Monedas::findOrFail($moneda[0]);
							if($mon->idbanco>0){
								    $mov=new MovBancos;
									$mov->idbanco=$mon->idbanco;
									$mov->clasificador=2;
									$mov->tipodoc="N/D";
									$mov->docrelacion=$venta->idnota;
									$mov->iddocumento=$recibo->idrecibo;
									$mov->tipo_mov="N/C";
									$mov->numero="N/D-".$recibo->idnota."Rec-".$recibo->idrecibo;
									$mov->concepto="Cobranza";
									$mov->idbeneficiario=$venta->idcliente;	
									$mov->identificacion="";
									$mov->ced="";
									$mov->tipo_per="C";
									$mov->monto=$saldo[$cont];	
									$mov->tasadolar=0;
									$mytime=Carbon::now('America/Caracas');
									$mov->fecha_mov=$mytime->toDateTimeString();	
									$mov->user=Auth::user()->name;
									$mov->save(); }
			$cont=$cont+1;
            } 
   return Redirect::to('showcxc/'.$request->get('idcliente'));
 }
	public function shownd($id){
		$dato=explode("_",$id);		
		
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
        $nota=DB::table('notasadm as no')
		->join('clientes as cl','cl.id_cliente','=','no.idcliente')
		->where('no.idnota','=',$dato[0])
		->first();
		//dd($dato[1]);
		$tipo=$dato[1];
		if($tipo==1){
			$pagos=DB::table('recibos as re')
			-> where ('re.idnota','=',$nota->idnota)
            ->get();
				$pndconnc=DB::table('mov_notas')
			->where('tipodoc','=',"N/D")
			->where('iddoc','=',$nota->idnota)
			->get();
		}else{
			$pagos=DB::table('relacionnc as re')
			->join('mov_notas as mn','mn.id_mov','=','re.idmov')
			->where('re.idnota','=',$nota->idnota)
			->get();
					$pndconnc=DB::table('mov_notas')
			->where('tipodoc','=',"N/C")
			->where('iddoc','=',$nota->idnota)
			->get();
		}

  return view("clientes.cobrar.detallend",["tipo"=>$tipo,"link"=>$dato[1],"nota"=>$nota,"empresa"=>$empresa,"pagos"=>$pagos,"datond"=>$pndconnc,]);
	}
		public function showret($id){
			
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$dato=explode("_",$id);		

			$ret=DB::table('retencionventas as ret')
			->join('venta as v','v.idventa','=','ret.idfactura')
			->join('clientes as cli','cli.id_cliente','=','v.idcliente')
			->join('formalibre as fl','fl.idventa','=','ret.idfactura')
			->where('ret.idret','=',$dato[0])
			->first();	
			//dd($ret);

  return view("clientes.cliente.retencion",["empresa"=>$empresa,"ret"=>$ret]);
	}
	 	public function pasarfl(Request $request)
	{
		//dd($request);
		$user=Auth::user()->name;
		$ventact=Ventas::findOrFail($request->get('idventafl'));
		$ventact->flibre=1;			 
		$mytime=Carbon::now('America/Caracas');
		$ventact->fecha_emi=$mytime->toDateTimeString();	
		$ventact->update();
			$pnro=DB::table('formalibre')
			->select(DB::raw('MAX(idforma) as pnum'))
			->first();				
			$fl=new Formalibre;
			$fl->idventa=$ventact->idventa;
			$fl->nrocontrol=($pnro->pnum+1);
			$fl->save();
         return Redirect::to('showcxc/'.$ventact->idcliente);
	}
	 	 	public function apliret(Request $request)
	{
		$query=trim($request->get('fecharet'));	
         $query = date_create($query); 
		$periodo=date_format($query, 'Y');
		$mes=date_format($query, 'm');
		//dd($request);
		$user=Auth::user()->name;
			$fl=new RetencionVentas;
			$fl->idfactura=$request->get('factura');
			$fl->idcliente=$request->get('idp');
			$fl->comprobante=$request->get('comprobanteret');
			$fl->pretencion=$request->get('idretenc');
			$fl->mretbs=$request->get('mret');
			$fl->mfactura=$request->get('mfac');
			$fl->impuesto=$request->get('miva');
			$fl->mretd=$request->get('mretd');
			$fl->tasa=$request->get('tasafac');
			$mytime=Carbon::now('America/Caracas');			
			$fl->fecharegistro=$mytime->toDateTimeString();
			$fl->fecha=$request->get('fecharet');
			$fl->periodo=$periodo;
			$fl->mes=$mes;
			$fl->usuario=$user;
			$fl->save();
			//actualizo saldo de venta
			$notas=Ventas::findOrFail($request->get('factura'));
			$notas->saldo=($notas->saldo-$request->get('mretd'));		
			$notas->mret=($notas->mret+$request->get('mretd'));		
			$notas->update();
        return Redirect::to('showcxc/'.$notas->idcliente);
	}
}
