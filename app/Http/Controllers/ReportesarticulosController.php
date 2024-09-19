<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;

class ReportesarticulosController extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth');
	}
     public function articulos(Request $request)
    {   
	
		$rol=DB::table('roles')-> select('rarti','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();		
		if ($rol->rarti==1){
		
			$lista=DB::table('articulos')
			->where('articulos.idempresa',$empresa->idempresa) 
			->OrderBy('articulos.nombre')
			->get();
			return view('reportes.articulos.inventario.index',["lista"=>$lista,"empresa"=>$empresa]);          
		} else { 
			return view("reportes.mensajes.noautorizado");
		}
	}
	public function valorizado(Request $request)
    {
		$rol=DB::table('roles')-> select('rlvalorizado')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->rlvalorizado==1){
		$year= $request->get('ano');	
        $corteHoy = date("Y-m");      
		$pd=$corteHoy."-01";
        $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		$tc=$empresa->tc; 
		if($request->get('tasa')){$tc=$request->get('tasa');}
        $query=trim($request->get('mes'));
        $mes=trim($request->get('mes'));

		
             if (($query)==""){$query=$corteHoy;  $mes=date("m");}else{			
			 $query=$year."-".$mes;
			 $aux=$year."-".$mes."-01";
		$pd=date("Y-m-d",strtotime($aux."- 1 days"));}
		//	dd($pd);
			$articulo=DB::table('articulos')->where('estado','=',"Activo")->get();
			$anteriorin=DB::table('kardex as dv')            
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo')   
            -> select(DB::raw('sum(dv.cantidad) as cantidad'),DB::raw('AVG(dv.costo) as costop'),'a.idarticulo','dv.tipo')
            ->where('dv.fecha','<=',$pd)
			->where('dv.tipo','=',1)
            ->groupby('dv.idarticulo','dv.tipo')
            ->get();
			$anteriorout=DB::table('kardex as dv')            
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo')   
            -> select(DB::raw('sum(dv.cantidad) as cantidad'),DB::raw('AVG(dv.costo) as costop'),'a.idarticulo','dv.tipo')
            ->where('dv.fecha','<=',$pd)
			->where('dv.tipo','=',2)
          
			->groupby('dv.idarticulo','dv.tipo')
            ->get();
			//Sdd($query);		
            $entrada=DB::table('kardex as dv')            
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo')  
			-> select(DB::raw('sum(dv.cantidad) as cantidad'),DB::raw('AVG(dv.costo) as costop'),'a.idarticulo','dv.tipo')
			->where('dv.tipo','=',1)
			->where('dv.fecha','LIKE','%'.$query.'%')
			->groupby('dv.idarticulo','dv.tipo')
            ->get();
			//dd($entrada);
  //     
			$salida=DB::table('kardex as dv')            
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo')      
            -> select(DB::raw('sum(dv.cantidad) as cantidad'),DB::raw('AVG(dv.costo) as costop'),'a.idarticulo','dv.tipo')
            ->where('dv.tipo','=',2)
			->where('dv.fecha','LIKE','%'.$query.'%')
            ->groupby('dv.idarticulo','dv.tipo')
            ->get();
		//dd($salida);	
        return view('reportes.articulos.valorizado.index',["year"=>$year,"tasa"=>$tc,"anteriorout"=>$anteriorout,"anteriorin"=>$anteriorin,"articulo"=>$articulo,"entrada"=>$entrada,"salida"=>$salida,"empresa"=>$empresa,"searchText"=>$mes]);
            
		} else { 
			return view("reportes.mensajes.noautorizado");
		}
    }
	public function listaprecio(Request $request)
    {  
		$rol=DB::table('roles')-> select('rlistap','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();		
		if ($rol->rlistap==1){				
			if($request->order){
			$lista=DB::table('articulos')
			->where('articulos.idempresa',$empresa->idempresa) 
				->where('stock','>',0)
				->where('estado','=',"Activo")
				->OrderBy('articulos.nombre')
				->get();
			$grupos=DB::table('categoria')->where('categoria.idempresa',$empresa->idempresa)->where ('condicion','=','1')->get();
			return view('reportes.articulos.inventario.listapreciogrupo',["grupos"=>$grupos,"lista"=>$lista,"empresa"=>$empresa]);
		}else{     
        $lista=DB::table('articulos')
		->where('articulos.idempresa',$empresa->idempresa) 
		->where('stock','>',0)
		->where('estado','=',"Activo")
		->OrderBy('articulos.nombre')
        ->get();
		return view('reportes.articulos.inventario.listaprecio',["lista"=>$lista,"empresa"=>$empresa]); }         

		} else { 
			return view("reportes.mensajes.noautorizado");
		}
	}
	public function cero(Request $request)
    {   
        $rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();		
        $lista=DB::table('articulos')
		->where('articulos.idempresa',$empresa->idempresa) 
		->where('stock','<=',0)
		->OrderBy('articulos.nombre')
        ->get();
        return view('reportes.articulos.inventario.cero',["lista"=>$lista,"empresa"=>$empresa]);
            
    }
	public function catalogo(Request $request)
    {
		$rol=DB::table('roles')-> select('iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();		
             $query=trim($request->get('grupo'));
             if (($query)==""){			
            $datos=DB::table('articulos')                
            -> select('codigo','nombre','precio1','imagen')
			->where('articulos.idempresa',$empresa->idempresa) 
            ->where('imagen','<>',"ninguna.jpg")
			->OrderBy('nombre')
            ->get(); 
			 }else {							
            $datos=DB::table('articulos')                
            -> select('codigo','nombre','precio1','imagen')
			->where('articulos.idempresa',$empresa->idempresa) 
			-> where('idcategoria','=',$query)
            ->where('imagen','<>',"ninguna.jpg")
			->OrderBy('nombre')
            ->get(); 	 
			 }
			 $grupo=DB::table('categoria')->where('idempresa',$empresa->idempresa) ->get();
        return view('reportes.articulos.catalogo.index',["datos"=>$datos,"empresa"=>$empresa,"grupo"=>$grupo,"searchText"=>$query]);
            
    }
	public function resumen(Request $request)
    {
		$rol=DB::table('roles')-> select('rgerencial')->where('iduser','=',$request->user()->id)->first();	
		if ($rol->rgerencial==1){
           $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		    $compras=DB::table('compras as c')
            ->join ('proveedores as p', 'c.idproveedor','=','p.idproveedor')
			->select (DB::raw('sum(c.total) as total'),DB::raw('sum(c.saldo) as saldo'),'p.nombre','p.telefono')
			->where('c.saldo','>',0)
		   ->groupby('c.idproveedor')
		    ->get();
		  $gastos=DB::table('gastos as g')
            ->join ('proveedores as p', 'g.idpersona','=','p.idproveedor')
			->select (DB::raw('sum(g.monto) as monto'),DB::raw('sum(g.saldo) as saldo'),'p.nombre','p.telefono')
          ->where('g.saldo','>',0)
          ->where('g.estatus','=',0)
            ->groupby('g.idpersona')
            ->get();
			$ventas=DB::table('venta as v')
            ->join ('clientes as c', 'c.id_cliente','=','v.idcliente')
			->select (DB::raw('sum(v.total_venta) as total_venta'),DB::raw('sum(v.saldo) as saldo'),'c.id_cliente','c.nombre','c.telefono')
          ->where('v.saldo','>',0)
            ->groupby('v.idcliente')
            ->get();
			$q2=DB::table('notasadm as n')
			->join('clientes as c','c.id_cliente','=','n.idcliente')
			->select(DB::raw('sum(n.pendiente) as saldo'),DB::raw('sum(n.monto) as monto'),'c.id_cliente','c.nombre')
			->where('n.tipo','=',1)->where('n.pendiente','>',0)
			->groupby('n.idcliente')
			->get();
			  $clientes=DB::table('clientes')->select(DB::raw('count(id_cliente) as clientes'))->first(); 
			  $vende=DB::table('vendedores')->select(DB::raw('count(id_vendedor) as vendedor'))->first();
			  $proveedores=DB::table('proveedores')->select(DB::raw('count(idproveedor) as proveedores'))->first();
			  $articulos=DB::table('articulos')->select(DB::raw('sum(costo*stock) as vcosto'),DB::raw('sum(precio1*stock) as vprecio'),DB::raw('count(idarticulo) as articulos'))->first();
        return view('reportes.resumen.index',["vende"=>$vende,"articulos"=>$articulos,"clientes"=>$clientes,"proveedores"=>$proveedores,"notas"=>$q2,"ventas"=>$ventas,"compras"=>$compras,"gastos"=>$gastos,"empresa"=>$empresa]);    
	} else { 
			return view("reportes.mensajes.noautorizado");
		}    
  }
   
}
