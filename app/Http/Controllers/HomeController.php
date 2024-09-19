<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use DB;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
	//	dd($request->user());
		$rol=DB::table('roles')-> select('crearventa','iduser')->where('iduser','=',$request->user()->id)->first();	
 $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
 -> where('id','=',$rol->iduser)->first();
         $nivel=Auth::user()->nivel;
     if ($nivel=="A")        
     {
		 $clientes=DB::table('clientes')->where('idempresa',$empresa->idempresa)->get();
		 $proveedor=DB::table('proveedores')->where('idempresa',$empresa->idempresa)->get();
		 $articulos=DB::table('articulos')->where('idempresa',$empresa->idempresa)->get();
		 $vendedores=DB::table('vendedores')->where('idempresa',$empresa->idempresa)->get();
		$y = date("Y");
		$vene =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0101',$y.'0131']) -> first();
		$vfeb =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0201',$y.'0231']) -> first();
		$vmar =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0301',$y.'0331']) -> first();
		$vabr =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0401',$y.'0430']) -> first();
		$vmay =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0501',$y.'0530']) -> first();
		$vjun =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0601',$y.'0630']) -> first();
		$vjul =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0701',$y.'0731']) -> first();
		$vago =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0801',$y.'0831']) -> first();
		$vsep =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0901',$y.'0931']) -> first();
		$voct =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1001',$y.'1101']) -> first();
		$vnov =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1101',$y.'1131']) -> first();
		$vdic =DB::table('venta')-> select(DB::raw('sum(total_venta) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1201',$y.'1231']) -> first();
        
		
        $cene =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0101',$y.'0131']) -> first(); 
		$cfeb =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0201',$y.'0231']) -> first();
		$cmar =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0301',$y.'0331']) -> first();
		$cabr =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0401',$y.'0430']) -> first();
		$cmay =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0501',$y.'0530']) -> first();
		$cjun =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0601',$y.'0630']) -> first();
		$cjul =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0701',$y.'0731']) -> first();
		$cago =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0801',$y.'0831']) -> first();
		$csep =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'0901',$y.'0931']) -> first();
		$coct =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1001',$y.'1031']) -> first();
		$cnov =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1101',$y.'1131']) -> first();
		$cdic =DB::table('compras')-> select(DB::raw('sum(total) as total '))->where('idempresa',$empresa->idempresa)-> whereBetween('fecha_hora', [$y.'1201',$y.'1231']) -> first();
        
		
        return view('home',["vene"=>$vene,"vfeb"=>$vfeb,"vmar"=>$vmar,"vabr"=>$vabr,"vmay"=>$vmay,"vjun"=>$vjun,"vjul"=>$vjul,"vago"=>$vago,"cene"=>$cene,"cfeb"=>$cfeb,"cmar"=>$cmar,"cmay"=>$cmay,"cabr"=>$cabr,"cjun"=>$cjun,"cjul"=>$cjul,"cago"=>$cago,"csep"=>$csep,"vsep"=>$vsep,"voct"=>$voct,"coct"=>$coct,"vnov"=>$vnov,"cnov"=>$cnov,"vdic"=>$vdic,"cdic"=>$cdic,"empresa"=>$empresa,"clientes"=>$clientes,"proveedor"=>$proveedor,"articulos"=>$articulos,"vendedores"=>$vendedores]);
    } else {
			if($rol <> null){	
			if ($rol->crearventa==1){
		$monedas=DB::table('monedas')->where('idempresa',$empresa->idempresa)->get();
		$vendedor=DB::table('vendedores')->where('idempresa',$empresa->idempresa)->get();
        $personas=DB::table('clientes')->join('vendedores','vendedores.id_vendedor','=','clientes.vendedor')->where('clientes.idempresa',$empresa->idempresa)->select('clientes.id_cliente','clientes.tipo_precio','clientes.tipo_cliente','clientes.nombre','clientes.cedula','vendedores.comision','vendedores.id_vendedor as nombrev')-> where('clientes.status','=','A')->groupby('clientes.id_cliente')->get();
         $contador=DB::table('venta')->where('idempresa',$empresa->idempresa)->select('idventa')->limit('1')->orderby('idventa','desc')->get();
      //dd($contador);
        $articulos =DB::table('articulos as art')
        -> select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'),'art.idarticulo','art.stock','art.costo','art.precio1 as precio_promedio','art.precio2 as precio2','art.iva','art.serial')
        -> where('art.estado','=','Activo')
		->where('idempresa',$empresa->idempresa)
        -> where ('art.stock','>','0')
        ->groupby('articulo','art.idarticulo')
        -> get();
		//dd($articulos);
		 $seriales =DB::table('seriales')->where('estatus','=',0)->get();
     if ($contador==""){$contador=0;}
      return view("ventas.venta.create",["seriales"=>$seriales,"rol"=>$rol,"personas"=>$personas,"articulos"=>$articulos,"monedas"=>$monedas,"contador"=>$contador,"empresa"=>$empresa,"vendedores"=>$vendedor]);
		} }else { 
	return view("reportes.mensajes.noautorizado");
	}
	}
    }
}
