<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Comisiones;
use App\Models\Reciboscomision;
use App\Models\Ventas;
use App\Models\MovBancos;
use Carbon\Carbon;
use DB;
use Auth;

class ComisionesController extends Controller
{
    public function __construct()
	{
$this->middleware('auth');
	}
	 public function index(Request $request)
    {
        if ($request)
        {
			$rol=DB::table('roles')-> select('comisiones')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->comisiones==1){
			 $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> join ('vendedores as ve','p.vendedor','=','ve.id_vendedor')
            -> select (DB::raw('sum(v.total_venta) as monto'),DB::raw('sum(v.montocomision) as montocomision'),'ve.id_vendedor','ve.nombre','ve.telefono')
			 -> where ('v.devolu','=',0)
			 -> where ('v.saldo','=',0)
			  -> where ('v.idcomision','=',0)
            -> where ('ve.nombre','LIKE','%'.$query.'%')
            -> groupBy('p.vendedor')
                ->paginate(30);
     //dd($ventas);
     return view ('comisiones.comision.index',["ventas"=>$ventas,"searchText"=>$query,"empresa"=>$empresa]);
	     } else { 
	return view("reportes.mensajes.noautorizado");
	}
        }
    } 
	public function detalle($id){
		$vendedor=DB::table('vendedores')-> where('id_vendedor','=',$id)->first();
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
			 -> join ('vendedores as ve','p.vendedor','=','ve.id_vendedor')
            -> select ('v.idventa','v.fecha_hora','v.fecha_emi','p.nombre','p.cedula','v.comision','v.montocomision','p.direccion','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu')
           	 -> where ('v.devolu','=',0)
			 -> where ('v.saldo','=',0)
			 -> where ('v.idcomision','=',0)
			->where ('p.vendedor','=',$id)
            ->get();
            return view("comisiones.comision.detalle",["venta"=>$venta,"vendedor"=>$vendedor,"empresa"=>$empresa]);
	}
	public function store(Request $request){
		//dd($request);
			$user=Auth::user()->name;      
			$mov=new Comisiones;
			$mov->id_vendedor=$request->get('vendedor');
			$mov->montoventas=$request->get('mventas');
			$mov->montocomision=$request->get('mcomision');
			$mov->pendiente=$request->get('mcomision');
			$mytime=Carbon::now('America/Caracas');
			$mov->fecha=$mytime->toDateTimeString();
			$mov->usuario=$user;
			$mov-> save();
	        $idventa=$request->get('idventa');         
			$contp=0;
              while($contp < count($idventa)){
				$paciente=Ventas::findOrFail($idventa[$contp]);
				$paciente->idcomision=$mov->id_comision;
				$paciente->update();
				 $contp=$contp+1;
			  }  
		return Redirect::to('showcomision/'.$mov->id_comision);
  }
	public function show($id){
		$vendedor=DB::table('comisiones')-> join('vendedores','vendedores.id_vendedor','=','comisiones.id_vendedor')->where('id_comision','=',$id)->first();
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
			 -> join ('vendedores as ve','p.vendedor','=','ve.id_vendedor')
            -> select ('v.idventa','v.fecha_hora','v.fecha_emi','p.nombre','p.cedula','v.comision','v.montocomision','p.direccion','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu')
           	 -> where ('v.idcomision','=',$id)
            ->get();
		return view("comisiones.comision.show",["venta"=>$venta,"vendedor"=>$vendedor,"empresa"=>$empresa]);
	}
	public function comixpagar(Request $request){
		//dd($request);
		$rol=DB::table('roles')-> select('comisiones')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->comisiones==1){
		$monedas=DB::table('monedas')->get();
		$vendedor=DB::table('comisiones')-> join('vendedores','vendedores.id_vendedor','=','comisiones.id_vendedor')->where('comisiones.pendiente','>',0)->get();
		//dd($vendedor);
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            return view("comisiones.comision.xpagar",["vendedor"=>$vendedor,"empresa"=>$empresa,"monedas"=>$monedas]);
				     } else { 
	return view("reportes.mensajes.noautorizado");
	}
	}
	public function pagar(Request $request){
		//dd($request);
		
		$idpago=explode("_",$request->get('pidpago'));
		$tipo=$idpago[1];
		if($tipo==0){$pagado=$request->get('pagado');}
		if($tipo==1){$pagado=($request->get('pagado')/$idpago[2]);}
		if($tipo==2){$pagado=($request->get('pagado')*$idpago[2]);}
		$mone=DB::table('monedas')-> where('idmoneda','=',$idpago[0])->first();
		$user=Auth::user()->name;      
		$pago=new Reciboscomision;
		$pago->id_comision=$request->get('comision');
		$pago->monto=$pagado;
		$pago->observacion=$request->get('observacion')." pagado: ".$request->get('pagado').$mone->simbolo;
		$mytime=Carbon::now('America/Caracas');
		$pago->fecha=$mytime->toDateTimeString();
		$pago->user=$user;
		$pago-> save();
		$venta=Comisiones::findOrFail($request->get('comision'));
		$venta->pendiente=($venta->pendiente-$pagado);
		$venta->update();
		
			$vendedor=DB::table('comisiones')-> join('vendedores','vendedores.id_vendedor','=','comisiones.id_vendedor')->where('id_comision','=',$request->get('comision'))->first();
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			
			$mbanco=DB::table('monedas')
					->where('idmoneda','=',$idpago[0])->first();
			//dd($mbanco);
				if($mbanco->idbanco>0){	
         $mov=new MovBancos;
        $mov->idbanco=$mbanco->idbanco;
        $mov->clasificador=8;
        $mov->tipo_mov="N/D";
        $mov->tipodoc="COMI";
        $mov->docrelacion=$request->get('comision');
        $mov->iddocumento=$pago->id_recibo;
        $mov->numero="COMI-".$request->get('comision');
        $mov->concepto="Abono/Pago Comision";
        $mov->idbeneficiario=$vendedor->id_vendedor;	
		$mov->identificacion=$vendedor->nombre;
		$mov->ced=$vendedor->cedula;
		$mov->tipo_per="V";
        $mov->monto=$request->get('pagado');
		$mov->tasadolar=$empresa->tasa_banco;
        $mytime=Carbon::now('America/Caracas');
        $mov->fecha_mov=$mytime->toDateTimeString();
        $mov->user=$user;
        $mov->save();
		}
			return Redirect::to('recibocomision/'.$pago->id_recibo);
	}
	public function recibo($id){
		//DD($id);
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$datos=DB::table('reciboscomision as r')
            -> join ('comisiones as p','r.id_comision','=','p.id_comision')
			 -> join ('vendedores as ve','p.id_vendedor','=','ve.id_vendedor')
            -> select ('ve.nombre','ve.cedula','p.montoventas','p.montocomision','p.fecha as fechacomision','p.id_comision','r.monto','r.observacion','r.fecha','r.user')
           	 -> where ('r.id_recibo','=',$id)
            ->first();
            return view("comisiones.comision.recibo",["datos"=>$datos,"empresa"=>$empresa]);
	}
	public function lista($id){
		$dato=explode("_",$id);
		$comision=$dato[0];
		$link=$dato[1];
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$lista=DB::table('reciboscomision as r')
            -> join ('comisiones as p','r.id_comision','=','p.id_comision')
			 -> join ('vendedores as ve','p.id_vendedor','=','ve.id_vendedor')
            -> select ('ve.nombre','ve.cedula','p.montoventas','p.montocomision','p.fecha as fechacomision','p.id_comision','r.monto','r.id_recibo','r.observacion','r.fecha','r.user')
           	 -> where ('r.id_comision','=',$comision)
            ->get();
			//dd($lista);
            return view("comisiones.comision.listarecibos",["lista"=>$lista,"empresa"=>$empresa,"link"=>$link]);
	}
	public function pagadas(Request $request){
	$rol=DB::table('roles')-> select('comisiones')->where('iduser','=',$request->user()->id)->first();	
	if ($rol->comisiones==1){
	$query=trim($request->get('searchText'));
	$vendedor=DB::table('comisiones')-> join('vendedores','vendedores.id_vendedor','=','comisiones.id_vendedor')->where('comisiones.pendiente','=',0)-> where ('vendedores.nombre','LIKE','%'.$query.'%')->orderBy('comisiones.fecha','DESC')->get();
	//dd($vendedor);
	$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
	return view("comisiones.comision.pagadas",["vendedor"=>$vendedor,"empresa"=>$empresa,"searchText"=>$query]);
				     } else { 
	return view("reportes.mensajes.noautorizado");
	}
			}
	public function detallepagadas($id){
		//dd($id);
		$vendedor=DB::table('comisiones')-> join('vendedores','vendedores.id_vendedor','=','comisiones.id_vendedor')->where('id_comision','=',$id)->first();
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$venta=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
			 -> join ('vendedores as ve','p.vendedor','=','ve.id_vendedor')
            -> select ('v.idventa','v.fecha_hora','v.fecha_emi','p.nombre','p.cedula','v.comision','v.montocomision','p.direccion','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.devolu')
           	 -> where ('v.idcomision','=',$id)
            ->get();
            return view("comisiones.comision.detallecomision",["venta"=>$venta,"vendedor"=>$vendedor,"empresa"=>$empresa]);
	}
}
