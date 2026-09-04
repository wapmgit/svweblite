<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Miembros;
use App\Models\Recibosm;
use DB;
use Auth;
use Carbon\Carbon;
class MiembrosController extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth');					
	}

	public function index(Request $request)
	{
		if ($request)
		{
		//	dd($request->user()->id);
			$rol=DB::table('roles')-> select('newcliente','editcliente','iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
			$pacientes=DB::table('miembros')
			->join('clientes as cli','cli.id_cliente','=','miembros.idcliente')
			->select('miembros.idmiembro','cli.id_cliente','cli.nombre','cli.codpais','cli.telefono','cli.cedula','cli.direccion','miembros.ult_pago')
			->where('cli.nombre','LIKE','%'.$query.'%')
			->where('cli.status','A')
			->where('cli.idempresa',$empresa->idempresa)
			->orderBy('cli.id_cliente','desc')
			->paginate(20);

			return view('miembros.cliente.index',["rol"=>$rol,"pacientes"=>$pacientes,"empresa"=>$empresa,"searchText"=>$query]);
		}
	}
		public function create(Request $request)
	{		
		$rol=DB::table('roles')-> select('newcliente','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('users.id','=',$rol->iduser)->first();
		if ($rol->newcliente==1){
				$clientes=DB::table('clientes')->where('idempresa','=',$empresa->idempresa)->get();	
		return view("miembros.cliente.create",["clientes"=>$clientes,"empresa"=>$empresa]);
		} else { 
		return view("reportes.mensajes.noautorizado");
		}
	
	}
	public function store (Request $request)
    {
		//dd($request);
		$rol=DB::table('roles')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        $paciente=new Miembros;
        $paciente->idempresa=$empresa->idempresa;
        $paciente->idcliente=$request->get('idcliente');
        $paciente->fnacimiento=$request->get('fnacimiento');
        $paciente->condicion=$request->get('condicion');
        $paciente->medicamento=$request->get('medicamento');
        $paciente->alergias=$request->get('alergias');
        $paciente->sexo=$request->get('sexo');
        $paciente->fecha_inicio=$request->get('finicio');
        $paciente->montomes=$request->get('monto');
        $paciente->tipopago=$request->get('tipo_pago');
        $paciente->tel_emergencia=$request->get('telefono');
		$paciente->contacto=$request->get('contacto');
		 $mytime=Carbon::now('America/Caracas');
		$paciente->creado=$mytime->toDateTimeString();
        $paciente->save();
        return Redirect::to('membresia');

    }
	public function edit($historia)
	{
		 $datos=DB::table('miembros as mi')
			-> join('clientes as cli','cli.id_cliente','=','mi.idcliente')
			-> where('mi.idcliente','=',$historia)
            ->first();
		$empresa=DB::table('empresa')-> where('idempresa','=',$datos->idempresa)->first();
		return view("miembros.cliente.edit",["empresa"=>$empresa,"cliente"=>$datos]);
	}
		public function update(Request $request)
	{
		//dd($request);
		$paciente=Miembros::findOrFail($request->get('id'));
        $paciente->fnacimiento=$request->get('fnacimiento');
        $paciente->condicion=$request->get('condicion');
        $paciente->medicamento=$request->get('medicamento');
        $paciente->alergias=$request->get('alergias');
        $paciente->sexo=$request->get('sexo');
        $paciente->fecha_inicio=$request->get('finicio');
        $paciente->montomes=$request->get('monto');
        $paciente->tipopago=$request->get('tipo_pago');
        $paciente->tel_emergencia=$request->get('telefono');
		$paciente->contacto=$request->get('contacto');
        $paciente->update();
        return Redirect::to('membresia');
	}
		public function show(Request $request,$id)
    {
		//dd($id);
			$rol=DB::table('roles')-> select('abonarcxc','iduser')->where('iduser','=',$request->user()->id)->first();	
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$pacientes=DB::table('miembros')
			->join('clientes','clientes.id_cliente','=','miembros.idcliente')
			->select('clientes.nombre','clientes.telefono','clientes.cedula','clientes.id_cliente','clientes.direccion','miembros.montomes','miembros.idmiembro')
			->where('miembros.idmiembro','=',$id)
			->first();

				//recibos
		  $pagos=DB::table('recibosm as re')
				  ->join('miembros as mi','mi.idmiembro','=','re.idmiembro')
				  ->join('clientes as cli','cli.id_cliente','=','mi.idcliente')
         -> select('re.idrecibo','re.monto','re.recibido','re.idbanco','re.idpago','re.idmiembro','re.referencia','re.fecharecibo as fecha')
		 -> where('re.idmiembro','=',$id)
            ->get(); 

	$monedas=DB::table('monedas')-> where ('idempresa',$empresa->idempresa)->get();
        return view("miembros.cliente.show",["monedas"=>$monedas,"rol"=>$rol,"empresa"=>$empresa,"cliente"=>$pacientes,"pagos"=>$pagos]);
    }
	public function cobromes(Request $request){
//dd($request);

		$user=Auth::user()->name;
		//dd($tipodoc);
			
	
			// inserta el recibo
		
          $idpago=$request->get('tidpago');
           $idbanco=$request->get('tidbanco');
		   $denomina=$request->get('denominacion');
           $tmonto=$request->get('tmonto');
           $tref=$request->get('tref');		
			$fecha=$request->get('fecha');			   
           $contp=0;
             while($contp < count($idpago)){
				$recibo=new Recibosm;
				$recibo->idmiembro=$request->get('doc');
				if($request->get('tdeuda')>0){
				$recibo->tiporecibo='P'; }else{$recibo->tiporecibo='P'; }
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
				$recibo->fecharecibo=$fecha[$contp];
				$recibo->usuario=$user;				
				$recibo->save();
				$contp=$contp+1;
			  } 
			  	$act=Miembros::findOrFail($request->get('doc'));
				if (is_null($act->ult_pago)) {
					// Toma la fecha de inicio y obtiene el último día de ese mes
					$act->ult_pago = Carbon::parse($act->fecha_inicio)->endOfMonth()->toDateString();
				} else {
					// Suma un mes a la fecha de último pago
					$act->ult_pago = Carbon::parse($act->ult_pago)->addMonth()->toDateString();
				}
				$act->update();
		return Redirect::to('membresia');
	}
		public function reportemiembros(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();				
			
			$clientes=DB::table('miembros')
			->join('clientes','clientes.id_cliente','=','miembros.idcliente')
			->where('miembros.estatus',0)
			->where('clientes.idempresa',$empresa->idempresa)
			->orderby('clientes.nombre','asc')
			->get();
		//	dd($clientes);
			return view('miembros.cliente.listamiembros',["clientes"=>$clientes,"empresa"=>$empresa]);
            
    }
	  	public function reporteingresosm(Request $request)
    {   
      if ($request)
        {	
	$rol=DB::table('roles')-> select('rdetallei','iduser')->where('iduser','=',$request->user()->id)->first();	
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();	
		if ($rol->rdetallei==1){
			$corteHoy = date("Y-m-d");
            
            $query=trim($request->get('searchText'));
			if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
           $query2 = date_create($query2);  
	
            date_add($query2, date_interval_create_from_date_string('1 day'));
           $query2=date_format($query2, 'Y-m-d'); 
		   
		   $cobranza=DB::table('recibosm as re')
			->join('miembros as mi','mi.idmiembro','=','re.idmiembro' )
			->join('clientes','clientes.id_cliente','=','mi.idcliente')
			-> select('clientes.nombre','re.referencia','re.tiporecibo','re.idbanco','re.idpago','re.idrecibo','re.monto','re.recibido','re.fecharecibo')    
			-> where('mi.idempresa','=',$empresa->idempresa)
            -> whereBetween('re.fecharecibo', [$query, $query2])
			-> groupby('re.idrecibo','re.idbanco')
            ->get();
			//dd($cobranza);
            $comprobante=DB::table('recibosm')
			->join('miembros as mi','mi.idmiembro','=','recibosm.idmiembro' )
            -> select(DB::raw('sum(recibido) as mrecibido'),DB::raw('sum(monto) as mmonto'),'idbanco','tiporecibo')        
            -> where('mi.idempresa','=',$empresa->idempresa)
			-> whereBetween('fecha', [$query, $query2])
            ->groupby('idpago','idbanco','tiporecibo')
            ->get();
		   	//

		   $query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('miembros.cliente.indexcobros',["cobranza"=>$cobranza,"comprobante"=>$comprobante,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);
			   } else { 
			return view("reportes.mensajes.noautorizado")->with("empresa",$empresa);
			}
		}
			
	}

		public function reportealtcobro(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();				
					$corteHoy = date("Y-m-d");
		$query2=date("Y-m-d",strtotime($corteHoy."+ 4 days"));
		//dd($query2);
			$clientes=DB::table('miembros')
			->join('clientes','clientes.id_cliente','=','miembros.idcliente')
			->where('miembros.estatus',0)
			->where('clientes.idempresa',$empresa->idempresa)
			->where('miembros.ult_pago','<',$query2)
			->orderby('clientes.nombre','asc')
			->get();
			//dd($clientes);
			return view('miembros.reporte.alertcobros',["clientes"=>$clientes,"empresa"=>$empresa]);
            
    }
}
