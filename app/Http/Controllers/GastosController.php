<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Gastos;
use App\Models\Monedas;
use App\Models\MovBancos;
use App\Models\Comprobantes;


use Auth;
use Carbon\Carbon;
use DB;

class GastosController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
    {
        if ($request)
        {
		$rol=DB::table('roles')-> select('creargasto','anulargasto')->where('iduser','=',$request->user()->id)->first();
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
            $gasto=DB::table('gastos as g')->join('proveedores as p','p.idproveedor','=','g.idpersona')
			->select('g.*','p.nombre','p.rif')
            -> where ('p.nombre','LIKE','%'.$query.'%')
            -> orderBy('g.idgasto','desc')
            ->paginate(20);
     
     return view ('gastos.gasto.index',["rol"=>$rol,"gasto"=>$gasto,"empresa"=>$empresa,"searchText"=>$query]);
        }
    }
	public function create(Request $request){
		$rol=DB::table('roles')-> select('creargasto')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->creargasto==1){
			$monedas=DB::table('monedas')->get();
			$personas=DB::table('proveedores')
			-> where('estatus','=','A')->get();
			$empresa=DB::table('empresa')->join('sistema','sistema.idempresa','=','empresa.idempresa')->first();
			return view("gastos.gasto.create",["monedas"=>$monedas,"personas"=>$personas,"empresa"=>$empresa]);
		} else { 
			return view("reportes.mensajes.noautorizado");
		}
    }
	public function store(Request $request){
		
		$user=Auth::user()->name;
try{
    DB::beginTransaction();
			$ajuste=new Gastos;
			$ajuste->idpersona=$request->get('idproveedor');
			$ajuste->documento=$request->get('documento');
			$ajuste->control=$request->get('control');
			$ajuste->descripcion=$request->get('descripcion');
			$ajuste->monto=$request->get('monto');
			$ajuste->base=$request->get('base');
			$ajuste->iva=$request->get('iva');
			$ajuste->exento=$request->get('exento');
			$ajuste->tasa=$request->get('tasa');
			if($request->get('tdeuda')>0){
			$ajuste->saldo=$request->get('tdeuda');}else{$ajuste->saldo=0;}
			$mytime=Carbon::now('America/Caracas');
			$ajuste->fecha=$mytime->toDateTimeString();
			$ajuste->usuario=$user;
			$ajuste-> save();
			//dd($request);
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
				$recibo->idgasto= $ajuste->idgasto;
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
							$mon=Monedas::findOrFail($idpago[$contp]);
							if($mon->idbanco>0){
								    $mov=new MovBancos;
									$mov->idbanco=$mon->idbanco;
									$mov->clasificador=4;
									$mov->tipodoc="GAST";
									$mov->docrelacion=$ajuste->idgasto;
									$mov->iddocumento=$recibo->idrecibo;
									$mov->tipo_mov="N/D";
									$mov->numero="GAST-".$ajuste->idgasto." Rec-".$recibo->idrecibo;
									$mov->concepto="Gastos";
									$mov->idbeneficiario= $ajuste->idpersona;	
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
			 // dd($recibo);
				}
	DB::commit();
}
catch(\Exception $e)
{
    DB::rollback();
}
return Redirect::to('gastos');
}
	public function show($id){
		$data=explode("-",$id);
		$id=$data[0];
		$ruta=$data[1];
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$gasto=DB::table('gastos as g')
            -> join ('proveedores as p','p.idproveedor','=','g.idpersona')
            -> select ('g.*','p.nombre','p.rif','p.telefono','p.direccion')
            ->where ('g.idgasto','=',$id)
            -> first();
            $comprobante=DB::table('comprobante as co')
            -> where ('co.idgasto','=',$id)
            ->get();
            return view("gastos.gasto.show",["ruta"=>$ruta,"gasto"=>$gasto,"comprobante"=>$comprobante,"empresa"=>$empresa]);
	}
	public function destroy($id){
		//dd($id);
			$ingreso=Gastos::findOrFail($id);
			 $ingreso->descripcion=$ingreso->descripcion."-Anulada";
			  $ingreso->estatus=1;
			 $ingreso->update();
			$recibos=DB::table('comprobante')
            -> select('idrecibo')
            -> where ('idgasto','=',$id)
            ->get();
		$longitud = count($recibos);
		$array = array();
			foreach($recibos as $t){
			$arraycod[] = $t->idrecibo;
			}
		for ($i=0;$i<$longitud;$i++){
			$recibo=Comprobantes::findOrFail($arraycod[$i]);
					 $recibo->referencia='Anulado';
					 $recibo->monto='0';
					 $recibo->recibido='0';
					 $recibo->update();
				$mbanco=DB::table('mov_ban')->where('tipodoc','=',"GAST")->where('iddocumento','=',$recibo->idrecibo)->first();
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
			 	
		return Redirect::to('gastos');
	}	
	    	
}
