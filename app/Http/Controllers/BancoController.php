<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Banco;
use App\Models\Monedas;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Recibos;
use App\Models\Gastos;
use App\Models\Comisiones;
use App\Models\Reciboscomision;
use App\Models\Comprobantes;
use App\Models\MovBancos;
use App\Models\Notasadm;
use App\Models\Notasadmp;
use Carbon\Carbon;
use DB;
use Auth;

class BancoController extends Controller
{

	public function index(Request $request){	
		if ($request){
				$rol=DB::table('roles')-> select('newbanco','accesobanco','editbanco')->where('iduser','=',$request->user()->id)->first();
			$monedas=DB::table('monedas')->where('idbanco','=','0')->get();
            $query=trim($request->get('searchText'));
            $bancos=DB::table('bancos')->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('idbanco','asc')
            ->paginate(20);
            return view('bancos.banco.index',["rol"=>$rol,"monedas"=>$monedas,"bancos"=>$bancos,"searchText"=>$query]);
		}
		
	}
		public function edit($id)
	{
		 $banco=Banco::findOrFail($id);
	 $monedas=DB::table('monedas')->get();
		return view("bancos.banco.edit",["banco"=>$banco,"monedas"=>$monedas]);
	}
		public function update(Request $request)
	{
		//dd($request);
		$bank=Banco::findOrFail($request->get('id'));
        $bank->nombre=$request->get('nombre');
        $bank->cuentaban=$request->get('cuenta');
        $bank->titular=$request->get('titular');
		$bank->email=$request->get('mail');
		$bank->tipocta=$request->get('tipoc');
        $bank->update();
		
		$monedas = Monedas::where('idbanco','=',$request->get('id'))->get();
	
		$monedas->toQuery()->update([
		'idbanco' => 0]);
		//dd($monedas);
		 $idm = $request -> get('pidserial');
        $cont = 0;
            while($cont < count($idm)){  
        $act=Monedas::findOrFail($idm[$cont]);
        $act->idbanco=$request->get('id');
        $act->update();
            $cont=$cont+1;
            }
        return Redirect::to('bancos');
	}
	   public function store (Request $request)
    {
//	dd($request);
        $categoria=new Banco;
        $categoria->codigo=$request->get('codigo');
        $categoria->nombre=$request->get('nombre');
        $categoria->cuentaban=$request->get('cuenta');
        $categoria->tipocta=$request->get('tipoc');
        $categoria->titular=$request->get('titular');
        $categoria->email=$request->get('mail');
        $categoria->save();
		
		  $idm = $request -> get('pidserial');
        $cont = 0;
            while($cont < count($idm)){  
        $articulo=Monedas::findOrFail($idm[$cont]);
        $articulo->idbanco=$categoria->idbanco;
        $articulo->update();
            $cont=$cont+1;
            }
       return Redirect::to('bancos');
    }
	    public function show(Request $request,$id)
    {  
        if ($id)
        {
			$rol=DB::table('roles')-> select('newndbanco','newncbanco','transferenciabanco','anularopbanco')->where('iduser','=',$request->user()->id)->first();
			$listbanco=DB::table('bancos')->get();
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$contador=DB::table('mov_ban')->select('id_mov')->limit('1')->orderby('id_mov','desc')->get();
            $banco=DB::table('bancos')->where('idbanco','=',$id)
            ->first();	
			 $clasificador=DB::table('ctascon')->where('inactiva','=',0)->get();
			$movimiento=DB::table('mov_ban')->where('idbanco','=',$id)->where('estatus','=',0)->get();
        $q1=DB::table('proveedores')->select('idproveedor as id','nombre','rif as cedula','tipo');
        $q=DB::table('vendedores')->select('id_vendedor as id','nombre','cedula','tipo');
        $q2=DB::table('clientes')->select('id_cliente as id','nombre','cedula','tipo')->where('status','=',"A");
		$clientes= $q1->union($q)->union($q2)->get(); 
			
			
	return view('bancos.banco.show',["rol"=>$rol,"listbanco"=>$listbanco,"clasificador"=> $clasificador,"clientes"=>$clientes,"movimiento"=>$movimiento,"contador"=>$contador,"banco"=>$banco,"empresa"=>$empresa]);
        }
    }
	   public function adddebito(Request $request)
    {    
	     $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$idcliente=explode("_",$request->get('cliente'));
		$user=Auth::user()->name;
         $mov=new MovBancos;
        $mov->idbanco=$request->get('idbanco');
        $mov->clasificador=$request->get('clasificador');
        $mov->tipo_mov="N/D";
        $mov->numero=$request->get('numero');
        $mov->concepto=$request->get('concepto');
        $mov->idbeneficiario=$idcliente[0];	
		$mov->identificacion=$idcliente[1];
		$mov->ced=$idcliente[2];
		$mov->tipo_per=$idcliente[3];
        $mov->monto=$request->get('monto');
		$mov->tasadolar=$empresa->tasa_banco;
        $mytime=Carbon::now('America/Caracas');
        $mov->fecha_mov=$request->get('fecha');
        $mov->user=Auth::user()->name;
        $mov->save();
	if (isset($_POST["cxc"])) {
		$contador=DB::table('notasadm')->select(DB::raw('count(idnota) as doc'))->where('tipo','=',1)->first();
		if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadm;
        $paciente->tipo=1;
		$paciente->ndocumento=$numero+1;
        $paciente->idcliente=$idcliente[0];
        $paciente->descripcion=$request->get('concepto');
        $paciente->referencia=$request->get('numero');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
	} 
		if (isset($_POST["ncp"])) {
		$contador=DB::table('notasadmp')->select(DB::raw('count(idnota) as doc'))->where('tipo','=',2)->first();
		if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadmp;
        $paciente->tipo=2;
		$paciente->ndocumento=$numero+1;
        $paciente->idproveedor=$idcliente[0];
        $paciente->descripcion=$request->get('concepto');
        $paciente->referencia=$request->get('numero');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
	} 
	return Redirect::to('showbanco/'.$request->get('idbanco'));
   
    }
		   public function addcredito(Request $request)
    {    
	//dd($request);

	      $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$idcliente=explode("_",$request->get('cliente'));
		$user=Auth::user()->name;
         $mov=new MovBancos;
        $mov->idbanco=$request->get('idbanco');
        $mov->clasificador=$request->get('clasificador');
        $mov->tipo_mov="N/C";
        $mov->numero=$request->get('numero');
        $mov->concepto=$request->get('concepto');
        $mov->idbeneficiario=$idcliente[0];	
		$mov->identificacion=$idcliente[1];
		$mov->ced=$idcliente[2];
		$mov->tipo_per=$idcliente[3];
        $mov->monto=$request->get('monto');
		$mov->tasadolar=$empresa->tasa_banco;
        $mytime=Carbon::now('America/Caracas');
        $mov->fecha_mov=$request->get('fecha');
        $mov->user=Auth::user()->name;
        $mov->save();
	if (isset($_POST["cxc"])) {
			$contador=DB::table('notasadm')->select(DB::raw('count(idnota) as doc'))->where('tipo','=',2)->first();
		if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadm;
        $paciente->tipo=2;
		$paciente->ndocumento=$numero+1;
        $paciente->idcliente=$idcliente[0];
        $paciente->descripcion=$request->get('concepto');
        $paciente->referencia=$request->get('numero');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
	} 
		if (isset($_POST["ndp"])) {
				$contador=DB::table('notasadmp')->select(DB::raw('count(idnota) as doc'))->where('tipo','=',1)->first();
		if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadmp;
        $paciente->tipo=1;
		$paciente->ndocumento=$numero+1;
        $paciente->idproveedor=$idcliente[0];
        $paciente->descripcion=$request->get('concepto');
        $paciente->referencia=$request->get('numero');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
	} 
	return Redirect::to('showbanco/'.$request->get('idbanco'));
   
    }
	public function addtraspaso(Request $request)
    {    
//dd($request);
	     $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();

		$user=Auth::user()->name;
         $mov=new MovBancos;
        $mov->idbanco=$request->get('idbanco');
        $mov->clasificador=$request->get('clasificador');
        $mov->tipo_mov="TRA";
        $mov->numero=$request->get('numero');
        $mov->concepto=$request->get('concepto');
        $mov->idbeneficiario=0;	
		$mov->identificacion=0;
		$mov->ced=0;
		$mov->tipo_per=0;
        $mov->monto=$request->get('monto');
		$mov->tasadolar=$empresa->tasa_banco;
        $mytime=Carbon::now('America/Caracas');
        $mov->fecha_mov=$mytime->toDateTimeString();
        $mov->user=Auth::user()->name;
        $mov->save();
			$contador=DB::table('mov_ban')->select('id_mov')->orderby('id_mov','desc')->first();
			$numero=$contador->id_mov+1;
		//	dd($contador->id_mov);
         $mov2=new MovBancos;
        $mov2->idbanco=$request->get('bdestino');
        $mov2->clasificador=$request->get('clasificador');
        $mov2->tipo_mov="N/C";
        $mov2->numero="TS00000".$numero;
        $mov2->concepto=$request->get('concepto');
        $mov2->idbeneficiario=0;	
		$mov2->identificacion=0;
		$mov2->ced=0;
		$mov2->tipo_per=0;
        $mov2->monto=$request->get('mdestino');
		$mov2->tasadolar=$empresa->tasa_banco;
        $mytime=Carbon::now('America/Caracas');
        $mov2->fecha_mov=$mytime->toDateTimeString();
        $mov2->user=Auth::user()->name;
        $mov2->save();
	return Redirect::to('showbanco/'.$request->get('idbanco'));
   
    }
	public function detalle($id)
    {    
	//dd($id);
	$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
       $banco=DB::table('bancos')->where('idbanco','=',$id)->first();
        $movimiento=DB::table('mov_ban as mov')
        ->join('ctascon','idcod','=','mov.clasificador')
        ->where('idbanco','=',$id)
		->where('mov.estatus','=',0)
        ->get();
  
     //dd($movimiento);
        return view("bancos.banco.detalle",["movimiento"=>$movimiento,"banco"=>$banco]);
    }
	public function consulta($var1)
    {    
	$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
    $data=substr($var1, 0, 3);
    $data2=substr($var1, 3, 2);
    IF($data=="DEB"){$data="N/D"; $nombre="DEBITOS";} IF($data=="CRE"){$data="N/C"; $nombre="CREDITOS";}
    IF($data=="DEP"){ $nombre="DEPOSITOS";}IF($data=="TRA"){ $nombre="TRANSFERENCIAS";}

        $banco=DB::table('bancos')->where('idbanco','=',$data2)->first();
        $movimiento=DB::table('mov_ban')
        ->join('ctascon','ctascon.idcod','=','mov_ban.clasificador')
        ->select('mov_ban.id_mov','mov_ban.tipo_mov','mov_ban.numero','mov_ban.concepto','mov_ban.monto','mov_ban.fecha_mov','mov_ban.user','ctascon.descrip','mov_ban.identificacion as nombre','mov_ban.ced as cedula')
        ->where('mov_ban.estatus','=',0)
		->where('idbanco','=',$data2)
        ->where('tipo_mov','=',$data)
        ->paginate(50);
     // dd($id);
        return view("bancos.banco.consulta",["banco"=>$banco,"movimiento"=>$movimiento,"detalle"=>$nombre,"empresa"=>$empresa]);
    }
		public function recibo($id)
    {   
        $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $mov=DB::table('mov_ban')
            ->where('id_mov','=',$id)
           ->first();
          //dd($mov);

        return view('reportes.banco.recibobanco',["movimiento"=>$mov,"empresa"=>$empresa]);
            
    }
	public function movimientos(Request $request)
    {    
	$id=$request->get('id');
	$rol=DB::table('roles')-> select('anularopbanco')->where('iduser','=',$request->user()->id)->first();
      $corteHoy = date("Y-m-d");
        $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
         $banco=DB::table('bancos')->select('nombre','idbanco')-> where('idbanco','=',$id)->first(); 
		//dd($banco);
             $query=trim($request->get('searchText'));
                if (($query)==""){$query=$corteHoy; }
				$query2=trim($request->get('searchText2'));
				if (($query2)==""){$query2=$corteHoy; }
             
         $query2 = date_create($query2);
         $query = date_create($query);
		  $fbanco = date_format($query, 'Y-m-d');
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');

            $mov=DB::table('mov_ban as mv')
			->join('ctascon as cta','mv.clasificador','=','cta.idcod')
            ->where('mv.idbanco','=',$id)
			->where('mv.estatus','=',0)
            -> whereBetween('mv.fecha_mov', [$query, $query2])
            ->orderby('mv.id_mov', 'asc')
           ->get();
       // dd($mov);
	 $saldo=DB::table('mov_ban')
	 ->select('tipo_mov',DB::raw('SUM(monto) as tmonto' ))
	 ->where('idbanco','=',$id)
	  -> whereBetween('fecha_mov', ['2023-12-01', $fbanco])
	  	 ->where('mov_ban.estatus','=',0)
	 ->groupby('tipo_mov')->get();
	 // dd($saldo);
        return view('reportes.banco.detalladohistorico',["rol"=>$rol,"saldo"=>$saldo,"movimiento"=>$mov,"empresa"=>$empresa,"banco"=>$banco]);
            
    }
	public function cuentas(Request $request)
    {
		//dd($request);
         $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$corteHoy = date("Y-m-d");
             $query=trim($request->get('searchText'));
                if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
			$query2 = date_create($query2);
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
            $banco=$request->get('id');
            $clasi=$request->get('clasi');
                if ($clasi == 0){
                    $datosbanco= DB::table('bancos as bco')->where('bco.idbanco','=',$banco)->first();
            $datos=DB::table('mov_ban as mb')
            ->join ('bancos as b', 'mb.idbanco','=','b.idbanco')
            ->join('ctascon as cta','mb.clasificador','=','cta.idcod')
            ->select (DB::raw('SUM(mb.monto) as monto' ),DB::raw('SUM(mb.tasadolar) as dolares' ),'mb.clasificador','cta.descrip','mb.tipo_mov')
            ->where('mb.idbanco','=',$banco)
			 ->where('mb.estatus','=',0)
            ->whereBetween('mb.fecha_mov', [$query, $query2])      
           ->groupby('mb.clasificador','mb.tipo_mov') 
		    ->orderby('mb.tipo_mov','asc')
            ->get();
			$detallado=DB::table('mov_ban as mb')
            ->join ('bancos as b', 'mb.idbanco','=','b.idbanco')
            ->select ('mb.monto','mb.concepto','mb.clasificador','mb.tipo_mov','mb.fecha_mov','b.nombre','mb.identificacion as persona','mb.ced')
            ->where('mb.idbanco','=',$banco)
			 ->where('mb.estatus','=',0)
            ->whereBetween('mb.fecha_mov', [$query, $query2])      
		    ->orderby('mb.tipo_mov','asc')
            ->get();
			//dd($detallado);
	 $saldo=DB::table('mov_ban')
	 ->select('tipo_mov',DB::raw('SUM(monto) as tmonto' ))
	 ->where('idbanco','=',$banco)
	  ->where('mov_ban.estatus','=',0)
	  -> whereBetween('fecha_mov', ['2023-012-01', $query])
	 ->groupby('tipo_mov')->get();
          return view('reportes.banco.indexagrupado',["detallado"=>$detallado,"datosbanco"=>$datosbanco,"datos"=>$datos,"empresa"=>$empresa,"saldo"=>$saldo,"searchText"=>$query,"searchText2"=>$query2]);
                }else{
			$datosbanco= DB::table('bancos as bco')->where('bco.idbanco','=',$banco)->first();
            $datos=DB::table('mov_ban as mb')
            ->join ('bancos as b', 'mb.idbanco','=','b.idbanco')
            ->join('ctascon as cta','mb.clasificador','=','cta.idcod')
            ->select ('cta.descrip','b.nombre','mb.tipo_mov','mb.clasificador','mb.concepto','mb.numero','mb.monto','mb.fecha_mov','mb.user','mb.identificacion as cliente','mb.ced')              
            ->where('mb.idbanco','=',$banco)
			 ->where('mb.estatus','=',0)
            ->where('mb.clasificador','=',$clasi)
            ->whereBetween('mb.fecha_mov', [$query, $query2])      
           ->groupby('mb.id_mov') 
            ->get();
                 return view('reportes.banco.index',["detallado"=>$datos,"datosbanco"=>$datosbanco,"datos"=>$datos,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]); 
            }

            
    }
	public function delete(Request $request)
    {		
	//dd($request);
$id=$request->get('id');
		$delmov=MovBancos::findOrFail($id);
		$montobanco=$delmov->monto;
		$idbanco=$delmov->idbanco;
		$delmov->monto=0;
		$delmov->concepto="Anul.".$delmov->docrelacion."Rec".$delmov->iddocumento."M:".$montobanco;
		$delmov->estatus=1;
		$delmov->update();
				
	if($delmov->tipodoc == "FAC"){
			$recibo=Recibos::findOrFail($delmov->iddocumento);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				
			$actventa=Ventas::findOrFail($delmov->docrelacion);
			$actventa->saldo=$actventa->saldo+$mrecibo;
			$actventa->update();
	}
		if($delmov->tipodoc == "COMP"){
			$recibo=Comprobantes::findOrFail($delmov->iddocumento);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				
			$actventa=Compras::findOrFail($delmov->docrelacion);
			$actventa->saldo=$actventa->saldo+$mrecibo;
			$actventa->update();
	}
			if($delmov->tipodoc == "GAST"){
			$recibo=Comprobantes::findOrFail($delmov->iddocumento);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				
			$actventa=Gastos::findOrFail($delmov->docrelacion);
			$actventa->saldo=$actventa->saldo+$mrecibo;
			$actventa->update();
	}
		if($delmov->tipodoc == "N/D"){
			$recibo=Recibos::findOrFail($delmov->iddocumento);
			$mrecibo=$recibo->monto;	
			 $recibo->referencia='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->recibido='0';
			 $recibo->update();
				
			$actventa=Notasadm::findOrFail($delmov->docrelacion);
			$actventa->pendiente=$actventa->pendiente+$mrecibo;
			$actventa->update();
	}
			if($delmov->tipodoc == "COMI"){
			$recibo=Reciboscomision::findOrFail($delmov->iddocumento);
			$mrecibo=$recibo->monto;	
			 $recibo->observacion='Anulado ->'.$mrecibo;
			 $recibo->monto='0';
			 $recibo->update();
				
			$actventa=comisiones::findOrFail($delmov->docrelacion);
			$actventa->pendiente=$actventa->pendiente+$mrecibo;
			$actventa->update();
	}
	return Redirect::to('showbanco/'.$idbanco);
    }
		 public function resumen(Request $request)
			{   
			$rol=DB::table('roles')-> select('resumenbanco')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->resumenbanco==1){
			$corteHoy = date("Y-m-d");
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
			$query2=trim($request->get('searchText2'));
			if (($query)==""){$query=$corteHoy; }
			if (($query2)==""){$query2=$corteHoy; }
            $query2=trim($request->get('searchText2'));
			
            $query2 = date_create($query2);  	
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');	
			 
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$banco=DB::table('bancos')->get();
            $mov=DB::table('bancos as ba')
            ->join('mov_ban as mv','ba.idbanco','=','mv.idbanco')
            ->join('ctascon','mv.clasificador','=','ctascon.idcod')
            ->select('mv.*','ctascon.descrip')
			 ->where('mv.estatus','=',0)
			 -> whereBetween('mv.fecha_mov', [$query, $query2])
			// -> where('mv.fecha_mov','like','%'.$cortehoy.'%')
            ->orderby('mv.id_mov', 'asc')
           ->get();
        //dd($mov);
		 $query2 = date_create($query2);  	
            date_add($query2, date_interval_create_from_date_string('-1 day'));
            $query2=date_format($query2, 'Y-m-d');	
        return view('bancos.resumen.index',["banco"=>$banco,"datos"=>$mov,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);
           	     } else { 
		return view("reportes.mensajes.noautorizado");
			} 
		}
}
