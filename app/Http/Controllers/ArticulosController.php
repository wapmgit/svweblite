<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Articulos;
use Carbon\Carbon;
use DB;
use Auth;


class ArticulosController extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth');
	}
    public function index(Request $request)
    {
        if ($request)
        {
			$rol=DB::table('roles')-> select('newarticulo','editarticulo','web','iduser')->where('iduser','=',$request->user()->id)->first();
          $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
            $query=trim($request->get('searchText'));
			
            $articulos=DB::table('articulos as a')
			-> join('categoria as c','a.idcategoria','=','c.idcategoria')
			-> select ('a.idarticulo','a.nombre','a.precio1','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
             ->where('a.idempresa','=',$empresa->idempresa)
			->where('a.nombre','LIKE','%'.$query.'%')
            //->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->where('a.estado','=','Activo')           
            ->orderBy('a.idarticulo','desc')
            ->paginate(25);
			//dd($articulos);
            return view('almacen.articulo.index',["rol"=>$rol,"articulos"=>$articulos,"empresa"=>$empresa,"searchText"=>$query]);
        }
    }
	public function create(Request $request)
    {
		$rol=DB::table('roles')-> select('newarticulo')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->newarticulo==1){
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();	
			$contador=DB::table('articulos')->select('idarticulo')->where('idempresa',$empresa->idempresa)->limit('1')->orderby('idarticulo','desc')->first();		
			$categorias=DB::table('categoria')->where('idempresa',$empresa->idempresa)->where('condicion','=','1')->get();
//dd($contador);
			return view("almacen.articulo.create",["categorias"=>$categorias,"cnt"=>$contador,"idempresa"=>$empresa->idempresa]);
		} else { 
		return view("reportes.mensajes.noautorizado");
		}
    }
	public function store (Request $request)
    {
		//dd($request);
		$this->validate($request,[
            'nombre' => 'required',
            'codigo' => 'required',
            'utilidad' => 'required',
            'costo' => 'required',
            'impuesto' => 'required|numeric',
            'precio1' => 'required|numeric'
        ]);
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();	
			$cat=explode("_",$request->get('idcategoria'));
		$articulo=new Articulos;
        $articulo->idempresa=$empresa->idempresa;
        $articulo->idcategoria=$cat[0];
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=0;
        $articulo->estado='Activo';
        $articulo->unidad=$request->get('unidad');
        $articulo->utilidad=$request->get('utilidad');
        $articulo->precio1=$request->get('precio1');
        $articulo->costo=$request->get('costo');
        //validar iva vacio
        $articulo->iva=$request->get('impuesto');
		if($request->get('serial')=="on"){$articulo->serial=1;}		
			if(!empty($request->file('imagen'))){
			$file = $request->file('imagen');
			$img = $file->getClientOriginalName();		
        	\Storage::disk('local')->put($img, \File::get($file));
			$articulo->imagen=$img;
			}
		$mytime=Carbon::now('America/Caracas');
			$articulo->created_at=$mytime->toDateTimeString();
        $articulo->save();
       return Redirect::to('articulos');

    }
	public function edit(Request $request, $id)
    {
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();	
			 $articulos=Articulos::find($id);
			 $categorias=DB::table('categoria')->where('idempresa',$empresa->idempresa)->where('condicion','=','1')->get();
			return view('almacen.articulo.edit')
			->with(["articulo"=>$articulos,"categorias"=>$categorias]);

    }
	public function update(Request $request)
    {
		//dd($request);
		$this->validate($request,[
            'nombre' => 'required',
            'codigo' => 'required',
            'utilidad' => 'required',
            'costo' => 'required',
            'impuesto' => 'required|numeric',
            'precio1' => 'required'
        ]);
		$cat=explode("_",$request->get('idcategoria'));
        $articulo=Articulos::findOrFail($request->get('id'));
        $articulo->idcategoria=$cat[0];
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->estado='Activo';
		$articulo->unidad=$request->get('unidad');
        $articulo->precio1=$request->get('precio1');
        $articulo->costo=$request->get('costo');
        $articulo->iva=$request->get('impuesto');
		if(!empty($request->file('imagen'))){
			$file = $request->file('imagen');
			$img = $file->getClientOriginalName();		
        	\Storage::disk('local')->put($img, \File::get($file));
			$articulo->imagen=$img;
			}
			$mytime=Carbon::now('America/Caracas');
			$articulo->updated_at=$mytime->toDateTimeString();
        $articulo->update();

       return Redirect::to('articulos');
    }
	public function destroy(Request $request)
    {
        $articulo=Articulos::findOrFail($request->get('id'));
        $articulo->estado='Inactivo';
        $articulo->update();
     return Redirect::to('articulos');
    }
	public function kardex($id)
   {	
		//	dd($id);	
	 	 $articulo=Articulos::findOrFail($id);		 
		$datos=DB::table('kardex as k')
		->where('k.idarticulo','=',$id)
		->get();
	       return view("almacen.articulo.kardex",["datos"=>$datos,"articulo"=>$articulo]);
    }
	    public function show($id)
    {
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		//compra
		$ultcompra=DB::table('detalle_compras as di')
		->join('compras as in','in.idcompra','=','di.idcompra')
		->join('proveedores as p','p.idproveedor','=','in.idproveedor')
		->select('p.nombre','in.num_comprobante','in.fecha_hora','di.cantidad','di.precio_compra')->where('di.idarticulo','=',$id)
		->orderby('di.iddetalle_compra','desc')->first();
		//venta
		$ultventa=DB::table('detalle_venta as dv')
		->join('venta as v','v.idventa','=','dv.idventa')
		->join('clientes as c','c.id_cliente','=','v.idcliente')
		->select('c.nombre','v.tipo_comprobante','v.num_comprobante','v.fecha_emi','dv.cantidad','dv.precio_venta')->where('dv.idarticulo','=',$id)
		->orderby('dv.iddetalle_venta','desc')->first();
		//dd($ultventa);
		//ajustes
		$ajustes=DB::table('detalle_ajustes')->select(DB::raw('sum(cantidad) as cantidad'),'tipo_ajuste')
		->where('idarticulo','=',$id)
		->groupBy('tipo_ajuste')->get();
			$hoy = date("Y-m-d");  
		  $analisis=date("Y-m-d",strtotime($hoy."- 30 days"));
		  $analisisventa=DB::table('detalle_venta')->select(DB::raw('sum(cantidad) as cantidad'))
		  ->whereBetween('fecha_emi', [$analisis, $hoy])
		  ->where('idarticulo','=',$id)
			->first();
		   $analisiscompra=DB::table('detalle_compras')->join('compras','compras.idcompra','=','detalle_compras.idcompra')->select(DB::raw('sum(detalle_compras.cantidad) as cantidad'))
		  ->whereBetween('compras.fecha_hora', [$analisis, $hoy])
		  ->where('detalle_compras.idarticulo','=',$id)
			->first();
			$compras=DB::table('detalle_compras')->select(DB::raw('sum(cantidad) as cantidad'),DB::raw('sum(precio_compra) as precio'),DB::raw('count(idcompra) as compra'))->where('idarticulo','=',$id)->first();
			$ventas=DB::table('detalle_venta')->select(DB::raw('sum(cantidad) as cantidad'),DB::raw('sum(precio_venta) as precio'),DB::raw('count(idventa) as venta'))->where('idarticulo','=',$id)->first();
			$devcompras=DB::table('detalle_devolucioncompras')->select(DB::raw('sum(cantidad) as devocompras'))->where('codarticulo','=',$id)->first();
			$deventas=DB::table('detalle_devolucion')->select(DB::raw('sum(cantidad) as devoventas'))->where('idarticulo','=',$id)->first();
			$util=DB::table('detalle_venta')->select(DB::raw('sum(costoarticulo*cantidad) as costo'),DB::raw('sum(precio_venta*cantidad) as precio'))->where('idarticulo','=',$id)->first();
		  return view("almacen.articulo.show",["articulo"=>Articulos::findOrFail($id),"ultcompra"=>$ultcompra,"ultventa"=>$ultventa,"ajustes"=>$ajustes,"analisisventa"=>$analisisventa,"analisiscompra"=>$analisiscompra,"compras"=>$compras,"ventas"=>$ventas,"devcompras"=>$devcompras,"deventas"=>$deventas,"util"=>$util,"empresa"=>$empresa]);

    }
	    public function validar (Request $request){
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$request->user()->id)->first();	
            if($request->ajax()){
        $result=DB::table('articulos')
		->where('codigo','=',$request->get('codigo'))
		->where('idempresa','=',$empresa->idempresa)
		->get();
		$articulo=DB::table('articulos')
		->where('codigo','=',$request->get('codigo'))
		->get();
         return response()->json([$result,$articulo]);
     }
      
      }
}
