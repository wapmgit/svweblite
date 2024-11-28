<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Clientes;
use App\Models\Notasadm;
use DB;
use Auth;
use Carbon\Carbon;

class ClientesController extends Controller
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
			$rol=DB::table('roles')-> select('newcliente','editcliente','crearventa','web','edoctacliente','iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
			$pacientes=DB::table('clientes')->where('clientes.nombre','LIKE','%'.$query.'%')
			->join('vendedores as ven','ven.id_vendedor','=','clientes.vendedor')
			->select('clientes.id_cliente','clientes.nombre','clientes.codpais','clientes.telefono','clientes.cedula','clientes.direccion','ven.nombre as vendedor')
			->where('clientes.status','A')
			->where('clientes.idempresa',$empresa->idempresa)
			->orderBy('clientes.id_cliente','desc')
			->paginate(20);

			return view('clientes.cliente.index',["rol"=>$rol,"pacientes"=>$pacientes,"empresa"=>$empresa,"searchText"=>$query]);
		}
	}
	public function create(Request $request)
	{		
		$rol=DB::table('roles')-> select('newcliente','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('users.id','=',$rol->iduser)->first();
		if ($rol->newcliente==1){
		$vendedor=DB::table('vendedores')->where('idempresa','=',$empresa->idempresa)->get();	
		return view("clientes.cliente.create",["vendedores"=>$vendedor,"empresa"=>$empresa]);
		} else { 
		return view("reportes.mensajes.noautorizado");
		}
	
	}
	public function store (Request $request)
    {
	$this->validate($request,[
            'nombre' => 'required',
			'rif'=>'required',
			'codigo'=>'required',
			'telefono'=>'required',
			'direccion'=>'required',
            'cedula' => 'required'
        ]);
		$rol=DB::table('roles')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        $paciente=new Clientes;
        $paciente->idempresa=$empresa->idempresa;
        $paciente->nombre=$request->get('nombre');
        $paciente->cedula=$request->get('cedula');
        $paciente->rif=$request->get('rif');
        $paciente->codpais=$request->get('codpais');
        $paciente->telefono=$request->get('telefono');
        $paciente->licencia=$request->get('licencia');
        $paciente->status='A';
        $paciente->direccion=$request->get('direccion');
        $paciente->tipo_cliente=$request->get('tipo_cliente');
        $paciente->tipo_precio=$request->get('precio');
        $paciente->diascredito=$request->get('diascre');
        if($request->get('agente')==1){
		$paciente->retencion=$request->get('retencion');
		}
		$paciente->vendedor=$request->get('idvendedor');
		 $mytime=Carbon::now('America/Caracas');
		$paciente->creado=$mytime->toDateTimeString();
        $paciente->save();
        return Redirect::to('clientes');

    }
	public function show(Request $request,$id)
    {
		//dd($id);
			$rol=DB::table('roles')-> select('abonarcxc','iduser')->where('iduser','=',$request->user()->id)->first();	
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$pacientes=DB::table('clientes')
			->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')
			->select('clientes.nombre','clientes.telefono','clientes.cedula','clientes.id_cliente','clientes.direccion','vendedores.nombre as vendedor')
			->where('clientes.id_cliente','=',$id)
			->first();
			$ventas=DB::table('venta')
			->join('detalle_venta as det','det.idventa','=','venta.idventa')
			->select('venta.tipo_comprobante','venta.num_comprobante','venta.serie_comprobante','venta.total_venta','venta.total_pagar','venta.fecha_hora','venta.comision','venta.descuento','venta.saldo','venta.devolu','venta.estado','venta.idventa')
				->where('venta.idcliente','=',$id)
				->orderBy('venta.idventa','desc')
				->groupBy('venta.idventa')
				->get();
				//recibos
		  $pagos=DB::table('recibos as re')
				  ->join('venta as v','v.idventa','=','re.idventa')
				  ->join('clientes as cli','cli.id_cliente','=','v.idcliente')
         -> select('re.idrecibo','re.monto','re.recibido','re.idbanco','re.idpago','v.tipo_comprobante','re.idventa','re.referencia','v.num_comprobante','re.fecha')
		 -> where('v.idcliente','=',$id)
            ->get(); 


        return view("clientes.cliente.show",["rol"=>$rol,"empresa"=>$empresa,"cliente"=>$pacientes,"ventas"=>$ventas,"pagos"=>$pagos]);
    }
	public function edit($historia)
	{
		$cliente=Clientes::find($historia);
		 $datos=DB::table('clientes as c')
			-> join('vendedores as v','c.vendedor','=','v.id_vendedor')
			->select('v.nombre as vendedor')
			-> where('c.id_cliente','=',$historia)
            ->first();
		$vendedor=DB::table('vendedores')->where('idempresa','=',$cliente->idempresa)->get();
		return view("clientes.cliente.edit",["cliente"=>$cliente,"vendedores"=>$vendedor,"datos"=>$datos]);
	}
	public function update(Request $request)
	{
			$this->validate($request,[
            'nombre' => 'required',
			'rif'=>'required',
			'codigo'=>'required',
			'telefono'=>'required',
			'direccion'=>'required',
            'cedula' => 'required'
        ]);
		$paciente=Clientes::findOrFail($request->get('id'));
        $paciente->nombre=$request->get('nombre');
        $paciente->cedula=$request->get('cedula');
        $paciente->telefono=$request->get('telefono');
        $paciente->rif=$request->get('rif');
        $paciente->codpais=$request->get('codpais');
    	$paciente->direccion=$request->get('direccion');
    	$paciente->tipo_cliente=$request->get('tipo_cliente');
    	$paciente->diascredito=$request->get('diascre');
        $paciente->tipo_precio=$request->get('precio');
		 $paciente->vendedor=$request->get('idvendedor');
        $paciente->update();
        return Redirect::to('clientes');
	}
	public function notas (Request $request){
		
	$contador=DB::table('notasadm')->select(DB::raw('count(ndocumento) as doc'))->where('tipo','=',$request->get('tipo'))->first();

   if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadm;
        $paciente->tipo=$request->get('tipo');
        $paciente->ndocumento=$numero+1;
        $paciente->idcliente=$request->get('idcliente');
        $paciente->descripcion=$request->get('descripcion');
        $paciente->referencia=$request->get('referencia');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
        return Redirect::to('edocuenta/'.$request->get('idcliente'));
     }
	public function reporteclientes(Request $request)
    {
		$rol=DB::table('roles')-> select('ranalisisc')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->ranalisisc==1){
        $corteHoy = date("Y-m-d");
        $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
             $query=trim($request->get('searchText'));
             $query2=trim($request->get('searchText2'));
             if (($query)==""){$query=$corteHoy; }
			$query2 = date_create($query2);
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
			
            $cventas=DB::table('venta as v')            
             ->join ('clientes as c', 'c.id_cliente','=','v.idcliente')     
            -> select(DB::raw('count(v.idventa) as nventas'),DB::raw('avg(v.total_venta) as vpromedio'),DB::raw('sum(v.total_venta) as vendido'),DB::raw('sum(v.saldo) as pendiente'),'c.nombre')
            ->whereBetween('v.fecha_emi', [$query, $query2])
            ->groupby('v.idcliente')
			->OrderBy('nventas','desc')
            ->get();
			//dd($cventas);
		//	dd($cventas[0]->nombre);
			  $cventasm=DB::table('venta as v')            
             ->join ('clientes as c', 'c.id_cliente','=','v.idcliente')     
            -> select(DB::raw('count(v.idventa) as nventas'),DB::raw('avg(v.total_venta) as vpromedio'),DB::raw('sum(v.total_venta) as vendido'),DB::raw('sum(v.saldo) as pendiente'),'c.nombre')
            ->whereBetween('v.fecha_emi', [$query, $query2])
            ->groupby('v.idcliente')
			->OrderBy('vendido','desc')
            ->get();
			$clientes=DB::table('clientes')->get();
			$nclientes=count($clientes);			
			//dd($nclientes);
			$clientes2=DB::table('clientes')->whereBetween('creado', [$query, $query2])->get();
			$newclientes=count($clientes2);
			$vclientes=DB::table('clientes as cli')->join('venta as v','v.idcliente','=','cli.id_cliente')
			-> select(DB::raw('count(v.idventa) as nventas'),DB::raw('sum(v.total_venta) as vendido'),DB::raw('sum(v.saldo) as pendiente'),'cli.nombre')
			->whereBetween('cli.creado', [$query, $query2])
			->groupby('v.idcliente')
			->get();
			//dd($vclientes);
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.clientes.index',["clientes2"=>$clientes2,"vclientes"=>$vclientes,"newclientes"=>$newclientes,"nclientes"=>$nclientes,"datos"=>$cventas,"datosm"=>$cventasm,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);
        
		} else { 
			return view("reportes.mensajes.noautorizado");
		}    
    }
	public function validar (Request $request){
		if($request->ajax()){
			$pacientes=DB::table('clientes')
			->where('cedula','=',$request->get('cedula'))
			->where('idempresa','=',$request->get('empresa'))
			->get();
			return response()->json($pacientes);
		}     
    }
	public function detallerecibos (Request $request){
		if($request->ajax()){
			if ($request->get('tipo')== "FAC"){
			$detal=DB::table('recibos as r')
			->select('r.idrecibo','r.tiporecibo','r.idbanco','r.monto','r.recibido','r.referencia','r.fecha')
			->where('r.idventa','=',$request->get('comprobante'))
			-> get(); }
			if ($request->get('tipo')== "N/D"){
			$detal=DB::table('recibos as r')
			->select('r.idrecibo','r.tiporecibo','r.idbanco','r.monto','r.recibido','r.referencia','r.fecha')
			->where('r.idnota','=',$request->get('comprobante'))
			-> get(); }
			return response()->json($detal);
		}
    }
	public function detallenc (Request $request){
            if($request->ajax()){
        $detal=DB::table('relacionnc as r')
		->join('mov_notas as m','m.id_mov','=','r.idmov')
		->select('m.tipodoc','m.iddoc','m.monto','m.user','m.fecha')
		->where('r.idnota','=',$request->get('comprobante'))
				-> get();
         return response()->json($detal); 
		 }
     }
	public function loadcsv(Request $request){
		//dd($request);
         $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$num=0;
		$consulta=[];
		$fname = $_FILES['sel_file']['name'];
		$chk_ext = explode(".",$fname);
	         if(strtolower(end($chk_ext)) == "csv")
			{
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
             while (($data = fgetcsv($handle, 2500, ";")) !== FALSE)
             {
               //Insertamos los datos con los valores...
                
			$linea[]=array('nombre'=>$data[0],'cedula'=>$data[1],'rif'=>$data[2],'telefono'=>$data[3],'direccion'=>$data[4],'diascredito'=>$data[5],'vendedor'=>$data[6]);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo
			}          
             //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);	
		//	dd($linea);
		foreach($linea as $indice=>$value) //Iteracion el array para extraer cada uno de los valores almacenados en cada items
		{
			$nombre=trim($value["nombre"]);//Codigo del producto
			$cedula=trim($value["cedula"]);//descripcion del producto
			$rif=trim($value["rif"]);//descripcion del producto
			$telefono=trim($value["telefono"]);//descripcion del producto
			$direccion=trim($value["direccion"]);//descripcion del producto
			$diascredito=trim($value["diascredito"]);//descripcion del producto
			$vendedor=trim($value["vendedor"]);//descripcion del producto
			$codigo=trim($cedula);
			/*$clientes=DB::table('clientes')->where('cedula','=',$codigo)->get();
			$num=count($clientes); 
			if ($num==0)//Si es == 0 inserto 
			{*/
				$paciente=new Clientes;
				$paciente->nombre=$nombre;
				$paciente->cedula=$cedula;
				$paciente->rif=$cedula;
				$paciente->telefono=$telefono;
				$paciente->status='A';
				$paciente->direccion=$direccion;
				$paciente->tipo_cliente=1;
				$paciente->tipo_precio=1;
				$paciente->diascredito=$diascredito;
				$paciente->vendedor=$vendedor;
				 $mytime=Carbon::now('America/Caracas');
				$paciente->creado=$mytime->toDateTimeString();
				$paciente->save();
				
				//$consulta[]=array("idarticulo"=>$articulos[0]->idarticulo,"nombre"=>$articulos[0]->nombre,"costo"=>$articulos[0]->costo,"cantidad"=>$cantidad);
			//}//fin del if que comprueba que se guarden los datos

		}//fin deforecha

    }
		return Redirect::to('clientes');
	}
		public function repclientes(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();				
			$clientes=DB::table('clientes')->where('idempresa',$empresa->idempresa)->get();
			return view('reportes.clientes.listac',["clientes"=>$clientes,"empresa"=>$empresa]);
            
    }
}
