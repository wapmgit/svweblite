<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Proveedores;
use App\Models\Notasadmp;
use Carbon\Carbon;
use DB;
use Auth;

class ProveedoresController extends Controller
{
   public function __construct()
	{
$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request)
		{
			$rol=DB::table('roles')-> select('newproveedor','editproveedor','crearcompra','edoctaproveedor','iduser')->where('iduser','=',$request->user()->id)->first();
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
			$proveedores=DB::table('proveedores')->where('nombre','LIKE','%'.$query.'%')
				->where('estatus','=','A')
				->where('idempresa',$empresa->idempresa)
				->orderBy('idproveedor','desc')
				->paginate(20);
				return view('proveedores.proveedor.index',["rol"=>$rol,"proveedor"=>$proveedores,"empresa"=>$empresa,"searchText"=>$query]);
		}
	} 
	public function create(Request $request)
	{
			$rol=DB::table('roles')-> select('newproveedor','iduser')->where('iduser','=',$request->user()->id)->first();	
			$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
	if ($rol->newproveedor==1){
	return view("proveedores.proveedor.create",["empresa"=>$empresa]);
		} else { 
	return view("reportes.mensajes.noautorizado");
	}
	}
    public function store (Request $request)
    {
		$this->validate($request,[
            'nombre' => 'required',
			'direccion'=>'required',
            'rif' => 'required'
        ]);
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();
        $proveedor=new Proveedores;
        $proveedor->idempresa=$empresa->idempresa;
        $proveedor->nombre=$request->get('nombre');
        $proveedor->rif=$request->get('rif');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->contacto=$request->get('contacto');
		$proveedor->estatus='A';       
		$mytime=Carbon::now('America/Caracas');
		$proveedor->creado=$mytime->toDateTimeString();		
        $proveedor->save();
        return Redirect::to('proveedores');

    }
	public function historico(Request $request, $id)
    {    
	    $rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();

	$datos=DB::table('proveedores')->where('idproveedor','=',$id)
	->first();
	$compras=DB::table('compras')->where('idproveedor','=',$id)->get();
	$gastos=DB::table('gastos')->where('idpersona','=',$id)->get();

				$link="2";
	$rcompras=DB::table('comprobante as re')
	->join('compras as c','c.idcompra','=','re.idcompra')
	->join('proveedores as pro','pro.idproveedor','=','c.idproveedor')
	 -> select('re.monto','re.recibido','re.idbanco','re.idpago','re.referencia','c.idcompra','c.num_comprobante','re.fecha_comp')
	 -> where('pro.idproveedor','=',$id)
		->get();

        return view("proveedores.proveedor.show",["gastos"=>$gastos,"rcompras"=>$rcompras,"empresa"=>$empresa,"datos"=>$datos,"compras"=>$compras,"link"=>$link]);
    }
	public function edit($idproveedor)
	{		
		return view("proveedores.proveedor.edit",["proveedor"=>Proveedores::findOrFail($idproveedor)]);
	}
	public function update(Request $request)
	{
		$this->validate($request,[
            'nombre' => 'required',
			'direccion'=>'required',
            'rif' => 'required'
        ]);
        $proveedor=Proveedores::findOrFail($request->get('id'));
        $proveedor->nombre=$request->get('nombre');
        $proveedor->rif=$request->get('rif');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->contacto=$request->get('contacto');
		$proveedor->tpersona=$request->get('tpersona');
        $proveedor->update();
		return Redirect::to('proveedores');
	}
		public function notas (Request $request){
		
	//	dd($request);
	$contador=DB::table('notasadmp')->select(DB::raw('count(idnota) as doc'))->where('tipo','=',$request->get('tipo'))->first();
	//dd($contador);
   if ($contador==NULL){$numero=0;}else{$numero=$contador->doc;}
        $paciente=new Notasadmp;
        $paciente->tipo=$request->get('tipo');
        $paciente->ndocumento=$numero+1;
        $paciente->idproveedor=$request->get('idcliente');
        $paciente->descripcion=$request->get('descripcion');
        $paciente->referencia=$request->get('referencia');
        $paciente->monto=$request->get('monto');
		$mytime=Carbon::now('America/Caracas');
		$paciente->fecha=$mytime->toDateTimeString();
        $paciente->pendiente=$request->get('monto');
		$paciente->usuario=Auth::user()->name;
        $paciente->save();
        return Redirect::to('historico/'.$request->get('idcliente'));
     }
		public function validar (Request $request){
        if($request->ajax()){
			$pacientes=DB::table('proveedores')
			->where('idempresa',$request->get('empresa'))
			->where('rif','=',$request->get('rif'))->get();
         // dd($municipios);
         return response()->json($pacientes);
		}
		}
	public function repproveedores(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();				
			$lista=DB::table('proveedores')->where('idempresa',$empresa->idempresa)->get();
			return view('reportes.proveedor.listac',["lista"=>$lista,"empresa"=>$empresa]);
            
    }
}
