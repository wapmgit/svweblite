<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vendedores;
use DB;
use Auth;

class VendedoresController extends Controller
{
	   public function __construct()
	{
	$this->middleware('auth');
	}
    public function index(Request $request)
    {
			$rol=DB::table('roles')-> select('newvendedor','editvendedor','iduser')->where('iduser','=',$request->user()->id)->first();
			 $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
			$vendedores=DB::table('vendedores')
			->where('nombre','LIKE','%'.$query.'%')
			->where('idempresa',$empresa->idempresa)
				->orderBy('id_vendedor','desc')
				->paginate(10);
    //dd($vendedores);
      return view("vendedor.vendedor.index",["rol"=>$rol,"vendedores"=>$vendedores,"searchText"=>$query,"empresa"=>$empresa]);
	 
	}
	public function create(Request $request)
	{
	$rol=DB::table('roles')->select('newvendedor')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->newvendedor==1){
			return view("vendedor.vendedor.create");
		} else { 
			return view("reportes.mensajes.noautorizado");
		}
	}
	public function store (Request $request)
    {
	
		$this->validate($request,[
            'nombre' => 'required',
            'cedula' => 'required'
        ]);
		
		$rol=DB::table('roles')-> select('newvendedor','iduser')->where('iduser','=',$request->user()->id)->first();
         $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        
		$paciente=new Vendedores;
		$paciente->idempresa=$empresa->idempresa;
        $paciente->nombre=$request->get('nombre');
        $paciente->cedula=$request->get('cedula');
        $paciente->telefono=$request->get('telefono');
        $paciente->direccion=$request->get('direccion');
        $paciente->comision=0;
        $paciente->save();
		
        return Redirect::to('vendedores');
    }	
	public function edit($id)
	{
		return view("vendedor.vendedor.edit",["vendedores"=>Vendedores::findOrFail($id)]);
	}
	public function update(Request $request,$id)
	{
		$this->validate($request,[
            'nombre' => 'required',
			'cedula' => 'required',
            'comision' => 'required'
        ]);
		
		$paciente=Vendedores::findOrFail($request->get('id'));
        $paciente->nombre=$request->get('nombre');
        $paciente->cedula=$request->get('cedula');
        $paciente->telefono=$request->get('telefono');
    	$paciente->direccion=$request->get('direccion');
    	$paciente->comision=0;
        $paciente->update();
        return Redirect::to('vendedores');
	}
	public function show($id)
    {
		$vend=Vendedores::findOrFail($id);
			 $empresa=DB::table('empresa')-> where('idempresa','=',$vend->idempresa)->first();
			$clientes=DB::table('clientes')->where('vendedor','=',$id)
				->get();
				
			$maventas=DB::table('venta as v')
				->join('clientes as c','c.id_cliente','=','v.idcliente')
				->select(DB::raw('SUM(v.saldo) as pendiente'),DB::raw('SUM(v.total_venta) as facturado'),'c.nombre')
				->where('idvendedor','=',$id)
				->orderby('facturado','DESC')
				->groupby('v.idcliente')
				->take(10)
				->get();
			$meventas=DB::table('venta as v')
				->join('clientes as c','c.id_cliente','=','v.idcliente')
				->select(DB::raw('SUM(v.saldo) as pendiente'),DB::raw('SUM(v.total_venta) as facturado'),'c.nombre')
				->where('idvendedor','=',$id)
				->orderby('facturado','ASC')
				->groupby('v.idcliente')
				->take(10)
				->get();
        return view("vendedor.vendedor.show",["maventas"=>$maventas,"meventas"=>$meventas,"vendedores"=>Vendedores::findOrFail($id),"clientes"=>$clientes,"empresa"=>$empresa]);
    }
 
}
