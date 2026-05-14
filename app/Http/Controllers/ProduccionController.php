<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Produccion;
use App\Models\ProduccionIn;
use App\Models\Produccionout;
use App\Models\Kardex;
use App\Models\Articulos;
use Carbon\Carbon;
use DB;
use Auth;


class ProduccionController extends Controller
{
  	  public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request){	
	$rol=DB::table('roles')-> select('iduser','newproduccion')->where('iduser','=',$request->user()->id)->first();
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($request){
            $query=trim($request->get('searchText'));
            $data=DB::table('produccion')->where('concepto','LIKE','%'.$query.'%')
            ->where ('idempresa',$empresa->idempresa)
            ->orderBy('idproduccion','desc')
            ->paginate(50);
            return view('produccion.produccion.index',["data"=>$data,"searchText"=>$query,"empresa"=>$empresa,"rol"=>$rol]);
		}
		
	}
	public function create(Request $request){
		$rol=DB::table('roles')-> select('newproduccion','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		 ->where('id','=',$rol->iduser)->first();
		if ($rol->newproduccion==1){	
			$articulos =DB::table('articulos as art')
			->join('categoria as cat','cat.idcategoria','art.idcategoria')
			-> select(DB::raw('CONCAT(art.codigo,"_",art.nombre,"_",art.stock) as articulo'),'art.idarticulo','art.stock','art.costo','cat.mprima')
			-> where('art.estado','=','Activo')
			->where('art.idempresa',$empresa->idempresa)
			-> get();
			return view("produccion.produccion.create",["rol"=>$rol,"articulos"=>$articulos,"empresa"=>$empresa]);
		} else { 
		return view("reportes.mensajes.noautorizado");
		}
    }
	public function store(Request $request){

		$rol=DB::table('roles')-> select('crearajuste','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		 ->where('id','=',$rol->iduser)->first();
		    $contador=DB::table('produccion')->select(DB::raw('count(idproduccion) as produccion'))->where('idempresa',$empresa->idempresa)->first();
   if ($contador==NULL){$numero=0;}else{$numero=$contador->produccion;}
		$user=Auth::user()->name;
		try{
		DB::beginTransaction();
			$ajuste=new Produccion;
			$ajuste->idempresa=$empresa->idempresa;
			$ajuste->controlp=$numero+1;
			$ajuste->concepto=$request->get('concepto');
			$ajuste->responsable=$request->get('responsable');
			$ajuste->valor=$request->get('totalo')+$request->get('totalop');
			$mytime=Carbon::now('America/Caracas');
			$ajuste->fecha=$mytime->toDateTimeString();	 
			$ajuste-> save();
//de la salida
			$idarticulo = $request -> get('idarticulo');
			$cantidad = $request -> get('cantidad');

			$cont = 0;
            while($cont < count($idarticulo)){
				$articulo=Articulos::findOrFail($idarticulo[$cont]);
				$detalle=new ProduccionOut();
				$detalle->idproduccion=$ajuste->idproduccion;
				$detalle->idarticulo=$idarticulo[$cont];
				$detalle->cantidad=$cantidad[$cont];
				$detalle->costo=($cantidad[$cont]*$articulo->costo);
				$detalle->save();
				
				$articulo->stock=($articulo->stock-$cantidad[$cont]);
				$articulo->update();
				
					$kar=new Kardex;
					$kar->fecha=$mytime->toDateTimeString();
					$kar->documento="PROD-".$ajuste->idproduccion;
					$kar->idarticulo=$idarticulo[$cont];
					$kar->cantidad=$cantidad[$cont];
					$kar->costo=$articulo->costo;
					$kar->tipo=2; 
					$kar->user=$user;
					 $kar->save();   
						$cont=$cont+1;
					}
	//de la salida
		//de la entrada
			$idarticulo = $request -> get('idarticulop');
			$cantidad = $request -> get('cantidadp');

			$cont = 0;
            while($cont < count($idarticulo)){
				$articulo=Articulos::findOrFail($idarticulo[$cont]);
				$detalle=new ProduccionIn();
				$detalle->idproduccion=$ajuste->idproduccion;
				$detalle->idarticulo=$idarticulo[$cont];
				$detalle->cantidad=$cantidad[$cont];
				$detalle->costo=($cantidad[$cont]*$articulo->costo);
				$detalle->save();
				
				$articulo->stock=($articulo->stock+$cantidad[$cont]);
				$articulo->update();
				
					$kar=new Kardex;
					$kar->fecha=$mytime->toDateTimeString();
					$kar->documento="PROD-".$ajuste->idproduccion;
					$kar->idarticulo=$idarticulo[$cont];
					$kar->cantidad=$cantidad[$cont];
					$kar->costo=$articulo->costo;
					$kar->tipo=1; 
					$kar->user=$user;
					 $kar->save();   
						$cont=$cont+1;
					}
				DB::commit();
		}
		catch(\Exception $e)
		{
				DB::rollback();
		}
	return Redirect::to('produccion');
	} 	
	public function show(Request $request, $id){
		$rol=DB::table('roles')-> select('newproduccion','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')
		 ->join('sistema','sistema.idempresa','=','empresa.idempresa')
		 ->where('id','=',$rol->iduser)->first();
		 
		 
		$ajuste=DB::table('produccion as a')
            ->where ('a.idproduccion','=',$id)
            -> first();

            $detallesout=DB::table('produccion_out as da')
            -> join('articulos as a','da.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','da.cantidad','da.costo')
            -> where ('da.idproduccion','=',$id)
            ->get();
			
            $detallesin=DB::table('produccion_in as da')
            -> join('articulos as a','da.idarticulo','=','a.idarticulo')
            -> select('a.nombre as articulo','da.cantidad','da.costo')
            -> where ('da.idproduccion','=',$id)
            ->get();

		return view("produccion.produccion.show",["ajuste"=>$ajuste,"detallesout"=>$detallesout,"detallesin"=>$detallesin,"empresa"=>$empresa]);
	}	
		public function reporte(Request $request)
	{
		//dd($request);
	$rol=DB::table('roles')-> select('rproduccion','iduser')->where('iduser','=',$request->user()->id)->first();
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$corteHoy = date("Y-m-d");
            $query=trim($request->get('searchText'));
			$query2=trim($request->get('searchText2'));
			if (($query)==""){$query=$corteHoy; $query2=$corteHoy; }
             
           $query2 = date_create($query2);  
	
            date_add($query2, date_interval_create_from_date_string('1 day'));
           $query2=date_format($query2, 'Y-m-d');
		

		$produccion=DB::table('produccion as pro')
			 -> where ('pro.idempresa',$empresa->idempresa)
            -> whereBetween('pro.fecha', [$query, $query2])
			-> groupby('pro.idproduccion')
			-> orderby('pro.idproduccion',"asc")
            ->get();
		

			 $salida=DB::table('produccion as pro')
			->join('produccion_out as pout','pout.idproduccion','=','pro.idproduccion' )
			->join('articulos as art','art.idarticulo','=','pout.idarticulo' )
			->select('art.nombre',DB::raw('sum(pout.cantidad) as cntout'),DB::raw('sum(pout.costo) as costout'))
			 -> where ('pro.idempresa',$empresa->idempresa)
            -> whereBetween('pro.fecha', [$query, $query2])
			-> groupby('pout.idarticulo')
            ->get();

			$entrada=DB::table('produccion as pro')
			->join('produccion_in as pout','pout.idproduccion','=','pro.idproduccion' )
			->join('articulos as art','art.idarticulo','=','pout.idarticulo' )
			->select('art.nombre',DB::raw('sum(pout.cantidad) as cntout'),DB::raw('sum(pout.costo) as costout'))
			 -> where ('pro.idempresa',$empresa->idempresa)
            -> whereBetween('pro.fecha', [$query, $query2])
			-> groupby('pout.idarticulo')
            ->get();
			if ($rol->rproduccion==1){
        return view('produccion.reporte.index',["produccion"=>$produccion,"salida"=>$salida,"entrada"=>$entrada,"empresa"=>$empresa,"rol"=>$rol,"searchText"=>$query,"searchText2"=>$query2]);
			} else { 
	return view("reportes.mensajes.noautorizado")->with("empresa",$empresa);
	}
	}
}
