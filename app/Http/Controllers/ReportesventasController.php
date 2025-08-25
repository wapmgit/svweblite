<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;

class ReportesventasController extends Controller
{
  public function __construct()
	{
		$this->middleware('auth');
	}
    public function ventas(Request $request)
    {
		$rol=DB::table('roles')-> select('rventas','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->rventas==1){
        if ($request)
        {
			$vendedores=DB::table('vendedores')->where('idempresa','=',$empresa->idempresa)->get();    
			$corteHoy = date("Y-m-d");
           
            $query=trim($request->get('searchText'));
			if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
            $query2 = date_create($query2);  
	
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
         //datos venta
	
         if($request->get('vendedor')==0){
            $datos=DB::table('venta as v')
			-> join('clientes as c','v.idcliente','=','c.id_cliente')
			-> join ('vendedores as ven','ven.id_vendedor','=','c.vendedor')
			->select('v.idventa','c.nombre','v.tipo_comprobante','v.num_comprobante','v.estado','v.total_venta','v.fecha_hora','v.fecha_emi','v.saldo','v.devolu','ven.nombre as vendedor','v.user')
			->where('v.idempresa','=',$empresa->idempresa)
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> groupby('v.idventa')
            ->get();
				
			// pagos
			$pagos=DB::table('recibos as re')
			->join('venta as v','v.idventa','=','re.idventa')
			->join('monedas as mo','mo.idmoneda','=','re.idpago')
			-> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
			 ->where('v.idempresa','=',$empresa->idempresa)
			->where('re.monto','>',0)
			->where('v.devolu','=',0)
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idpago','re.idbanco')
            ->get();
			//datos devolucion     
             $devolucion=DB::table('venta as d')
            -> select(DB::raw('sum(d.total_venta) as totaldev'))
			->where('d.idempresa','=',$empresa->idempresa)
			->where('d.devolu','=',1)
            ->whereBetween('d.fecha_hora', [$query, $query2])
            ->get();
		 //dd($devolucion);   
		 }else{
			$datos=DB::table('venta as v')
			-> join('clientes as c','v.idcliente','=','c.id_cliente')
			-> join ('vendedores as ven','ven.id_vendedor','=','c.vendedor')
			->select('v.idventa','c.nombre','v.tipo_comprobante','v.num_comprobante','v.estado','v.total_venta','v.fecha_hora','v.fecha_emi','v.saldo','v.devolu','ven.nombre as vendedor','v.user')
			 ->where('v.idempresa','=',$empresa->idempresa)
			-> where('ven.id_vendedor','=',$request->get('vendedor'))
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> groupby('v.idventa')
            ->get(); 
		
			$pagos=DB::table('recibos as re')
			->join('venta as v','v.idventa','=','re.idventa')
			->join('clientes as cli','cli.id_cliente','=','v.idcliente')
			->join('vendedores as ve','ve.id_vendedor','=','cli.vendedor')
			-> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
		   ->where('v.idempresa','=',$empresa->idempresa)
			-> where('ve.id_vendedor','=',$request->get('vendedor'))
			->where('re.monto','>',0)
			->where('v.devolu','=',0)
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idpago','re.idbanco')
            ->get(); 		
		//dd($pagos);	
			$devolucion=DB::table('venta as d')
			->join('vendedores as ve','ve.id_vendedor','=','d.idvendedor')
            -> select(DB::raw('sum(d.total_venta) as totaldev'))
			 ->where('d.idempresa','=',$empresa->idempresa)
			->where('d.devolu','=',1)
			-> where('d.idvendedor','=',$request->get('vendedor'))
            ->whereBetween('d.fecha_hora', [$query, $query2])
            ->get();
		 }
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.ventas.ventas.index',["datos"=>$datos,"devolucion"=>$devolucion,"empresa"=>$empresa,"pagos"=>$pagos,"vendedores"=>$vendedores,"searchText"=>$query,"searchText2"=>$query2]);
       
		} 
		}
		else { 
	return view("reportes.mensajes.noautorizado");
	}
		
	}
	public function corte(Request $request)
    {   
	//dd($request);
	$rol=DB::table('roles')-> select('ccaja','iduser')->where('iduser','=',$request->user()->id)->first();	
	$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->ccaja==1){
		$usuario=DB::table('users')->where('idempresa',$empresa->idempresa)->get();
		if ($request)
        {
			$corteHoy = date("Y-m-d");
            
            $query=trim($request->get('searchText'));
			if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
           $query2 = date_create($query2);  	
            date_add($query2, date_interval_create_from_date_string('1 day'));
           $query2=date_format($query2, 'Y-m-d');
		  $user=$request->get('usuario');
		 // dd($user);
		 //datos v
		    if($request->get('usuario') == NULL){
			$filtro="Todas las Cajas";
            $datos=DB::table('venta as v')										
			->where('v.idempresa','=',$empresa->idempresa)
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> groupby('v.idventa')
            ->get();
				//dd($datos);     
				//ventas impuestos
			$impuestos=DB::table('detalle_venta as dv')
			-> join('venta as ve','ve.idventa','=','dv.idventa')
			-> join('articulos as art','art.idarticulo','=','dv.idarticulo')
			-> select(DB::raw(('sum(((dv.precio_venta*dv.cantidad)/((art.iva/100)+1))) as gravado')),'art.iva',DB::raw('sum(dv.precio_venta*dv.cantidad) as montoventa'))
			->where('ve.idempresa','=',$empresa->idempresa)
			-> whereBetween('dv.fecha', [$query, $query2])
			->where('ve.devolu','=',0)
			-> groupby('art.iva')
			->get();
		//dd($impuestos);
        //datos devolucion     
             $devolucion=DB::table('devolucion as d')
			 -> join('venta as ve','ve.idventa','=','d.idventa')		 
            -> select(DB::raw('sum(ve.total_venta ) as totaldev'))
			->where('ve.idempresa','=',$empresa->idempresa)
            ->whereBetween('ve.fecha_emi', [$query, $query2])
            ->get();
			//dd($devolucion);
			//cobros directos
			$pagos=DB::table('recibos as re')
			-> join('venta as v','v.idventa','=','re.idventa')
			-> select('re.idpago','re.idbanco',DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'))
            ->where('v.idempresa','=',$empresa->idempresa)
			-> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"P")
			->where('v.devolu','=',0)
			-> groupby('re.idpago','idbanco')
            ->get();
			//  
			$cobranza=DB::table('recibos as re')
			-> join('venta as v','v.idventa','=','re.idventa')
			-> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco')
			->where('v.idempresa','=',$empresa->idempresa)           
			-> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"A")
			-> groupby('re.idpago','re.idbanco')
            ->get();
		
			$ingresos=DB::table('recibos as re')
			-> join('venta as v','v.idventa','=','re.idventa')
			 -> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco')
			->where('v.idempresa','=',$empresa->idempresa)            
		   -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idpago','re.idbanco')
            ->get();	
			//	dd($cobranza); 
			$comisiones=DB::table('reciboscomision as re')
			-> select(DB::raw('sum(re.monto) as monto'))
            -> whereBetween('re.fecha', [$query, $query2])
            ->first();
			//dd($comisiones);
			
			$ingresosnd=DB::table('mov_notas as n')
			->join('venta','venta.idventa','=','n.iddoc')
            -> select(DB::raw('sum(n.monto) as recibido'))
            -> whereBetween('n.fecha', [$query, $query2])
			-> groupby('n.tipodoc')
            ->first();
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
				  } else {
			$filtro=$request->get('usuario');
		    $datos=DB::table('venta as v')
			->where('v.idempresa','=',$empresa->idempresa) 
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> where ('user','=',$user)
			-> groupby('v.idventa')
            ->get();
			//dd($datos);
			//ventas impuestos
			$impuestos=DB::table('detalle_venta as dv')
			-> join('articulos as art','dv.idarticulo','=','art.idarticulo')
			-> join('venta as v','dv.idventa','=','v.idventa')
			-> select(DB::raw(('sum(((dv.precio_venta*dv.cantidad)/((art.iva/100)+1))) as gravado')),'art.iva',DB::raw('sum(dv.precio_venta*dv.cantidad) as montoventa'))
			->where('v.idempresa','=',$empresa->idempresa) 
			-> where ('v.user','=',$user)
			->where('v.devolu','=',0)
			-> whereBetween('dv.fecha', [$query, $query2])
			-> groupby('art.iva')
			->get();
			//
			//datos devolucion     
			   $devolucion=DB::table('devolucion as d')
			 -> join('venta as ve','ve.idventa','=','d.idventa')		 
            -> select(DB::raw('sum(ve.total_venta ) as totaldev'))
			->where('ve.idempresa','=',$empresa->idempresa)
			 -> where ('ve.user','=',$user)
            ->whereBetween('ve.fecha_emi', [$query, $query2])
            ->get();
			//dd($devolucion);
			//cobros directos
			$pagos=DB::table('recibos as re')
			-> join('venta as v','v.idventa','=','re.idventa')
            -> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
			-> where ('v.user','=',$user)
			->where('v.idempresa','=',$empresa->idempresa)            
		   -> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"P")
			-> groupby('re.idpago','re.idbanco')
            ->get();
      // dd($query);   
			$cobranza=DB::table('recibos as re')
				-> join('venta as v','v.idventa','=','re.idventa')
            -> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
			-> where ('re.usuario','=',$user)
			->where('v.idempresa','=',$empresa->idempresa) 
            -> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"A")
			-> groupby('re.idpago','re.idbanco')
            ->get();
		    $ingresos=DB::table('recibos as re')	
			-> join('venta as v','v.idventa','=','re.idventa')			
            -> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
			-> where ('re.usuario','=',$user)
			->where('v.idempresa','=',$empresa->idempresa) 
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idpago','re.idbanco')
            ->get();

			$comisiones=DB::table('reciboscomision as re')
			-> select(DB::raw('sum(re.monto) as monto'))
			-> where ('re.user','=',$user)
            -> whereBetween('re.fecha', [$query, $query2])
            ->first();
			$ingresosnd=DB::table('mov_notas as n')
            -> select(DB::raw('sum(n.monto) as recibido'))
			->where('n.tipodoc','=',"FAC")
			-> where ('n.user','=',$user)
            -> whereBetween('n.fecha', [$query, $query2])
			-> groupby('n.tipodoc')
            ->first();
			//dd($ingresosnd);
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));			  
				  }
		} }else { 
	return view("reportes.mensajes.noautorizado");
	}

        return view('reportes.ventas.corte.index',["filtro"=>$filtro,"datos"=>$datos,"devolucion"=>$devolucion,"impuestos"=>$impuestos,"comision"=>$comisiones,"empresa"=>$empresa,"ingresos"=>$ingresos,"cobranza"=>$cobranza,"pagos"=>$pagos,"searchText"=>$query,"searchText2"=>$query2,"usuario"=>$usuario,"ingresosnd"=>$ingresosnd]);    
  }
  	public function cobranza(Request $request)
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
		   $vendedores=DB::table('vendedores')-> where('idempresa','=',$empresa->idempresa)->get();         
		   if($request->get('vendedor')==0){
			$cobranza=DB::table('recibos as re')
			->join('venta','venta.idventa','=','re.idventa' )
			->join('clientes','clientes.id_cliente','=','venta.idcliente')
			->join('vendedores as vende','vende.id_vendedor','=','clientes.vendedor')
			-> select('clientes.nombre','re.referencia','re.tiporecibo','venta.tipo_comprobante','venta.num_comprobante','re.idbanco','re.idpago','re.idrecibo','re.monto','re.recibido','re.fecha','vende.nombre as vendedor')    
			-> where('venta.idempresa','=',$empresa->idempresa)
			-> where('venta.devolu','=',0)
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idrecibo','re.idbanco')
            ->get();
		
            $comprobante=DB::table('recibos')
			->join('venta','venta.idventa','=','recibos.idventa' )
            -> select(DB::raw('sum(recibido) as mrecibido'),DB::raw('sum(monto) as mmonto'),'idbanco','tiporecibo')        
            -> where('venta.idempresa','=',$empresa->idempresa)
            -> where('venta.devolu','=',0)
			-> whereBetween('fecha', [$query, $query2])
            ->groupby('idpago','idbanco','tiporecibo')
            ->get();
		   	//
			$ingresosnd=DB::table('recibos as re')
			-> join('notasadm as n','n.idnota','=','re.idnota')
			->join('clientes','clientes.id_cliente','=','n.idcliente')
            -> select('clientes.nombre','re.referencia','re.tiporecibo','n.idnota as tipo_comprobante','n.idnota as num_comprobante','re.idbanco','re.idrecibo','re.idpago','re.monto','re.recibido','re.fecha','n.usuario as vendedor')
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idrecibo')
            ->get();
			$recibonc=DB::table('mov_notas as mov')-> whereBetween('mov.fecha', [$query, $query2])
            ->get();
			   }else{
				   $cobranza=DB::table('recibos as re')
				->join('venta','venta.idventa','=','re.idventa' )
				->join('clientes','clientes.id_cliente','=','venta.idcliente')
				->join('vendedores as vende','vende.id_vendedor','=','clientes.vendedor')
			 -> select('clientes.nombre','re.referencia','re.tiporecibo','venta.tipo_comprobante','venta.num_comprobante','re.idbanco','re.idrecibo','re.idpago','re.monto','re.recibido','re.fecha','vende.nombre as vendedor')
				->where('clientes.vendedor','=',$request->get('vendedor'))  
				-> where('venta.idempresa','=',$empresa->idempresa)
				-> where('venta.devolu','=',0)
				-> whereBetween('re.fecha', [$query, $query2])
				-> groupby('re.idrecibo')
				->get();
				$comprobante=DB::table('recibos as re')
				->join('venta','venta.idventa','=','re.idventa' )
				->join('clientes','clientes.id_cliente','=','venta.idcliente')
				->join('vendedores as vende','vende.id_vendedor','=','clientes.vendedor')
				-> select(DB::raw('sum(recibido) as mrecibido'),DB::raw('sum(monto) as mmonto'),'idbanco','tiporecibo')
				->where('clientes.vendedor','=',$request->get('vendedor'))   
				-> where('venta.idempresa','=',$empresa->idempresa)				
				-> where('venta.devolu','=',0)				
				-> whereBetween('re.fecha', [$query, $query2])
				->groupby('re.idpago','idbanco','tiporecibo')
				->get();
				$ingresosnd=DB::table('recibos as re')
				-> join('notasadm as n','n.idnota','=','re.idnota')
				->join('clientes','clientes.id_cliente','=','n.idcliente')
				-> select('clientes.nombre','re.referencia','re.tiporecibo','n.idnota as tipo_comprobante','n.idnota as num_comprobante','re.idbanco','re.idrecibo','re.idpago','re.monto','re.recibido','re.fecha','n.usuario as vendedor')
				-> whereBetween('re.fecha', [$query, $query2])
				-> groupby('re.idrecibo')
				->get();
				$recibonc=DB::table('mov_notas as mov')-> whereBetween('mov.fecha', [$query, $query2])
				->get();
			   }
		   $query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.ventas.cobranza.index',["comprobante"=>$comprobante,"vendedores"=>$vendedores,"empresa"=>$empresa,"cobranza"=>$cobranza,"searchText"=>$query,"searchText2"=>$query2,"ingresosnd"=>$ingresosnd,"recibonc"=>$recibonc]);
			   } else { 
			return view("reportes.mensajes.noautorizado");
			}
		}
			
	}
	public function cuentascobrar(Request $request)	
	{
		
			$rol=DB::table('roles')-> select('rcxc','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->rcxc==1){
		//$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();		
		$vendedores=DB::table('vendedores')->where('idempresa','=',$empresa->idempresa)->get();  
			if($request->get('vendedor')==NULL){
			$clientes=DB::table('venta as v')
			->join('clientes as c','c.id_cliente','=','v.idcliente')
			->join('vendedores as ve','ve.id_vendedor','=','v.idvendedor')
			->select(DB::raw('sum(v.saldo) as acumulado'),'c.nombre','c.cedula','c.telefono','c.id_cliente')
			->where('c.idempresa','=',$empresa->idempresa)
			->where('v.saldo','>',0)
			->where('v.devolu','=',0)
			->groupby('c.id_cliente')
			->orderby('c.nombre','ASC')
			->get(); 
	
			$q2=DB::table('notasadm as n')
			->join('clientes as c','c.id_cliente','=','n.idcliente')
			->select(DB::raw('sum(n.pendiente) as acumulado'),'c.nombre','c.cedula','c.telefono','c.id_cliente')
			->where('n.tipo','=',1)->where('n.pendiente','>',0)
			->groupby('n.idcliente')
			->get(); 
			
			$vendedor="";
			}else{
				$clientes=DB::table('venta as v')
			->join('clientes as c','c.id_cliente','=','v.idcliente')
			->join('vendedores as ve','ve.id_vendedor','=','v.idvendedor')
			->select(DB::raw('sum(v.saldo) as acumulado'),'c.nombre','c.cedula','c.telefono','c.id_cliente')
			->where('v.idvendedor','=',$request->get('vendedor'))
			->where('c.idempresa','=',$empresa->idempresa)
			->where('v.saldo','>',0)
			->where('v.devolu','=',0)
			->groupby('c.id_cliente')
			->orderby('c.nombre','ASC')	
			->get();
					
		$q2=DB::table('notasadm as n')
			->join('clientes as c','c.id_cliente','=','n.idcliente')
			->select(DB::raw('sum(n.pendiente) as acumulado'),'c.nombre','c.cedula','c.telefono','c.id_cliente')
			->where('c.vendedor','=',$request->get('vendedor'))
			->where('n.tipo','=',1)->where('n.pendiente','>',0)
			->groupby('n.idcliente')
			->get(); 
			//dd($clientes);
			$vendedor=DB::table('vendedores')->where('id_vendedor','=',$request->get('vendedor'))->select('nombre')->first();
			}
			
			return view('reportes.ventas.cobrar.index',["vendedor"=>$vendedor,"notas"=>$q2,"pacientes"=>$clientes,"vendedores"=>$vendedores,"empresa"=>$empresa]);
			   } else { 
			return view("reportes.mensajes.noautorizado");
			}
	}
	
		public function cuentascobrarv()
		{
		
			$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
			$ventas=DB::table('venta as v')
			->join('vendedores as ve','ve.id_vendedor','=','v.idvendedor')
			->select(DB::raw('SUM(v.saldo) as acumulado'),'v.idvendedor','ve.nombre','ve.cedula','ve.telefono')
			->groupby('v.idvendedor','ve.nombre','ve.cedula','ve.telefono')
			->where('v.saldo','>',0)
			->where('v.devolu','=',0)
			->paginate(10);
			$notasnd=DB::table('notasadm as not')
			->join('clientes as c','c.id_cliente','=','not.idcliente')
			->select(DB::raw('SUM(not.pendiente) as tnotas'),'not.tipo','c.vendedor')
			->where('not.tipo','=',1)
			->where('not.pendiente','>',0)		
			->groupby('c.vendedor','not.tipo')
			->get();
			//dd($ventas);
			return view('vendedor.cobrar.index',["notasnd"=>$notasnd,"ventas"=>$ventas,"empresa"=>$empresa]);	
		}
	public function utilidad(Request $request)
    {   
		$rol=DB::table('roles')-> select('rutilventa','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->rutilventa==1){
			if ($request)
			{
			$corteHoy = date("Y-m-d");
            $query=trim($request->get('searchText'));
             $query2=trim($request->get('searchText2'));
            $query2 = date_create($query2);
			if (($query)==""){$query=$corteHoy; }
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
			//datos venta
		    $resumen=($request->get('check'));    
				if ($resumen=="on"){    
				$datos=DB::table('venta as v')
				-> join('detalle_venta as dv','v.idventa','=','dv.idventa')
				-> join('articulos as a','dv.idarticulo','=','a.idarticulo')
				-> select('v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.total_venta','v.fecha_hora','a.idarticulo',DB::raw('dv.cantidad*0 as cantidad'),DB::raw('a.costo*0 as costo'),'a.iva',DB::raw('dv.precio_venta*0 as precio_venta'),DB::raw('sum(dv.cantidad * dv.costoarticulo) as costoneto'),DB::raw('sum(dv.cantidad*dv.precio_venta)as ventaneta'))
				->where('v.idempresa',$empresa->idempresa)
				-> whereBetween('v.fecha_hora', [$query, $query2])
				-> Groupby('dv.idventa')      
				->get();
				}else{
				$datos=DB::table('venta as v')
				-> join('detalle_venta as dv','v.idventa','=','dv.idventa')
				-> join('articulos as a','dv.idarticulo','=','a.idarticulo')
				-> select('v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.total_venta','v.fecha_hora','a.idarticulo','dv.cantidad as cantidad','a.costo','a.iva','dv.precio_venta',DB::raw('(dv.cantidad * dv.costoarticulo) as costoneto'),DB::raw('(dv.cantidad*dv.precio_venta)as ventaneta'))  
				->where('v.idempresa',$empresa->idempresa)
				-> whereBetween('v.fecha_hora', [$query, $query2])
				->get();
				}
             $devolucion=DB::table('devolucion as d')
            -> join('recibos as r','r.idventa','=','d.idventa')
			->where('d.idempresa',$empresa->idempresa)
            -> select(DB::raw('sum(r.aux) as totaldev'))
            ->whereBetween('d.fecha_hora', [$query, $query2])
            ->get();
			//dd($devolucion);   
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.ventas.utilidad.index',["datos"=>$datos,"devolucion"=>$devolucion,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);  
		}   
		}
		else { 
	return view("reportes.mensajes.noautorizado");
	}		
    }
	public function ventasarticulo(Request $request)
    {
		$rol=DB::table('roles')-> select('rventasarti','iduser')->where('iduser','=',$request->user()->id)->first();	
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->rventasarti==1){
		$vendedores=DB::table('vendedores')->where('idempresa','=',$empresa->idempresa)->get();  
		$clientes=DB::table('clientes')->where('idempresa','=',$empresa->idempresa)->get();  
        $corteHoy = date("Y-m-d");
        //$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
             $query=trim($request->get('searchText'));
             $query2=trim($request->get('searchText2'));
             if (($query)==""){$query=$corteHoy; }
			$query2 = date_create($query2);
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
            $datos=DB::table('detalle_venta as dv')            
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo') 
             ->join ('categoria as ca','ca.idcategoria','=','a.idcategoria')      
            -> select(DB::raw('avg(dv.precio_venta) as vpromedio'),DB::raw('sum(dv.cantidad) as vendido'),'a.nombre','a.precio1 as pventa','a.idarticulo','ca.nombre as grupo')
            ->whereBetween('dv.fecha', [$query, $query2])
			->where('a.idempresa','=',$empresa->idempresa)
            ->groupby('dv.idarticulo','a.nombre')
			->OrderBy('a.nombre')
            ->get();
			$nvendedor="";
		if($request->get('opcion')>0){	
			if($request->get('opcion')==1){		
			$vende=DB::table('vendedores')->where('id_vendedor','=',$request->get('vendedor'))
			->where('idempresa','=',$empresa->idempresa)->first();  
			$nvendedor=$vende->nombre;
			$datos=DB::table('detalle_venta as dv')            
             ->join ('venta as ve', 've.idventa','=','dv.idventa') 
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo') 
             ->join ('categoria as ca','ca.idcategoria','=','a.idcategoria')      
            -> select(DB::raw('avg(dv.precio_venta) as vpromedio'),DB::raw('sum(dv.cantidad) as vendido'),'a.nombre','a.precio1 as pventa','a.idarticulo','ca.nombre as grupo')
			->where('ve.idvendedor','=',$request->get('vendedor'))
			->where('ve.devolu','=',0)
            ->whereBetween('dv.fecha', [$query, $query2])
			->where('a.idempresa','=',$empresa->idempresa)
            ->groupby('dv.idarticulo','a.nombre')
			->OrderBy('a.nombre')
            ->get();	
			}
		if($request->get('opcion')==2){
				$cli=DB::table('clientes')->where('id_cliente','=',$request->get('cliente'))
				->where('idempresa','=',$empresa->idempresa)->first();
				$nvendedor=$cli->nombre;
			$datos=DB::table('detalle_venta as dv')            
             ->join ('venta as ve', 've.idventa','=','dv.idventa') 
             ->join ('articulos as a', 'a.idarticulo','=','dv.idarticulo') 
             ->join ('categoria as ca','ca.idcategoria','=','a.idcategoria')      
            -> select(DB::raw('avg(dv.precio_venta) as vpromedio'),DB::raw('sum(dv.cantidad) as vendido'),'a.nombre','a.precio1 as pventa','a.idarticulo','ca.nombre as grupo')
			->where('ve.idcliente','=',$request->get('cliente'))
			->where('ve.devolu','=',0)
            ->whereBetween('dv.fecha', [$query, $query2])
			->where('a.idempresa','=',$empresa->idempresa)
            ->groupby('dv.idarticulo','a.nombre')
			->OrderBy('a.nombre')
            ->get();	
			}
			   }
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.ventas.ventasarticulo.index',["clientes"=>$clientes,"persona"=>$nvendedor,"vendedores"=>$vendedores,"datos"=>$datos,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2,"opc"=>$request->get('opcion')]);
       	}
		else { 
	return view("reportes.mensajes.noautorizado");
	}     
    }
	public function cajaventas(Request $request)
	{
		//dd($request);
		$user=Auth::user()->name;
		$rol=DB::table('roles')-> select('ccaja')->where('iduser','=',$request->user()->id)->first();
        if ($rol->ccaja==1){
		$empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
      if ($request)
        {
			$corteHoy = date("Y-m-d");
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
			if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
           $query2 = date_create($query2);  
	
            date_add($query2, date_interval_create_from_date_string('1 day'));
           $query2=date_format($query2, 'Y-m-d');
         //datos venta
            $datos=DB::table('venta as v')
			->where('v.user','=',$user)
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> groupby('v.idventa')
            ->get();
			//dd($datos);
			//ventas impuestos
			$impuestos=DB::table('detalle_venta as dv')
			-> join('articulos as art','dv.idarticulo','=','art.idarticulo')
			-> join('venta as v','dv.idventa','=','v.idventa')
			-> select(DB::raw(('sum(((dv.precio_venta*dv.cantidad)/((art.iva/100)+1))) as gravado')),DB::raw('sum(dv.precio_venta*dv.cantidad) as montoventa'),'art.iva')
			->where('v.user','=',$user)
			-> whereBetween('v.fecha_hora', [$query, $query2])
			-> groupby('art.iva')
			->get();
		//
        //datos devolucion     
             $devolucion=DB::table('devolucion as d')
            -> join('recibos as r','r.idventa','=','d.idventa')
            -> select(DB::raw('sum(r.monto) as totaldev'))
			->where('d.user','=',$user)
            ->whereBetween('d.fecha_hora', [$query, $query2])
            ->get();
			//dd($devolucion);
			//cobros directos
			$pagos=DB::table('recibos as re')
			->join('venta','venta.idventa','=','re.idventa')
			-> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')	 
		 	->where('venta.user','=',$user)
			->where('venta.devolu','=',0)
            -> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"P")
			-> groupby('re.idpago','re.idbanco')
            ->get();
      // dd($query);   
			$cobranza=DB::table('recibos as re')
			->join('venta','venta.idventa','=','re.idventa')
			-> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
		 	->where('venta.user','=',$user)
            -> whereBetween('re.fecha', [$query, $query2])
			-> where ('re.tiporecibo','=',"A")
			-> groupby('re.idpago','re.idbanco')
            ->get();
		$ingresos=DB::table('recibos as re')
			->join('venta','venta.idventa','=','re.idventa')
         -> select(DB::raw('sum(re.monto) as monto'),DB::raw('sum(re.recibido) as recibido'),'re.idbanco','re.idpago')
		 	->where('venta.user','=',$user)
			->where('venta.devolu','=',0)
            -> whereBetween('re.fecha', [$query, $query2])
			-> groupby('re.idpago','re.idbanco')
            ->get();
			$comisiones=DB::table('reciboscomision as re')
			-> select(DB::raw('sum(re.monto) as monto'))
            -> whereBetween('re.fecha', [$query, $query2])
            ->first();
			//dd($comisiones);
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
        return view('reportes.ventas.corte.cortecaja',["datos"=>$datos,"devolucion"=>$devolucion,"impuestos"=>$impuestos,"empresa"=>$empresa,"ingresos"=>$ingresos,"cobranza"=>$cobranza,"pagos"=>$pagos,"searchText"=>$query,"searchText2"=>$query2]);
       
		} }else { 
	return view("reportes.mensajes.noautorizado");
	}

            
    }
	public function ventacaja(Request $request)
    {
        if ($request)
        {
			$rol=DB::table('roles')-> select('crearventa','anularventa','iduser')->where('iduser','=',$request->user()->id)->first();
			   $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$corteHoy = date("Y-m-d");
			$user=Auth::user()->name;
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            -> join ('clientes as p','v.idcliente','=','p.id_cliente')
            -> join ('detalle_venta as dv','v.idventa','=','dv.idventa')
            -> select ('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.devolu','v.estado','v.total_venta')		
			->where('v.user','=',$user)
			-> where ('v.idempresa',$empresa->idempresa)
			 ->where('v.fecha_emi','like',$corteHoy)
            -> where ('p.nombre','LIKE','%'.$query.'%')
            -> orderBy('v.idventa','desc')
            -> groupBy('v.idventa')
                ->paginate(50);
     return view ('ventas.venta.ventacaja',["rol"=>$rol,"ventas"=>$ventas,"searchText"=>$query,"empresa"=>$empresa]);
        }
    } 
		public function librov(Request $request)
    {
			$rol=DB::table('roles')-> select('rlventas')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->rlventas==1){
        $corteHoy = date("Y-m-d");
        $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
             $query=trim($request->get('searchText'));
             $query2=trim($request->get('searchText2'));
             if (($query)==""){$query=$corteHoy; }
			$query2 = date_create($query2);
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
            $datos=DB::table('venta as v')  
			->join('formalibre as fl','fl.idventa','=','v.idventa')			
             ->join ('clientes as cl', 'cl.id_cliente','=','v.idcliente')      
            -> select('fl.anulado','v.devolu','v.fecha_emi as fecha','v.tasa','v.texe','v.base','fl.idforma','fl.nrocontrol','v.tipo_comprobante as tipo','cl.rif','cl.nombre','v.serie_comprobante as serie','v.num_comprobante as factura','v.control','v.total_venta','v.total_iva')
            ->whereBetween('v.fecha_emi', [$query, $query2])
			->OrderBy('v.idventa','asc')
            ->get();
			$retenc=DB::table('retencionventas as rt')
			->join('clientes as cli','rt.idcliente','=','cli.id_cliente')			
            ->whereBetween('rt.fecha', [$query, $query2])
			->OrderBy('rt.fecha','asc')
			->groupBy('rt.idret')
            ->get();
			//dd($retenc);
			$query2=date("Y-m-d",strtotime($query2."- 1 days"));
			return view('reportes.ventas.librov.index',["retenc"=>$retenc,"datos"=>$datos,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);
                  } else { 
	return view("reportes.mensajes.noautorizado");
	}
    }
		    public function correlativo(Request $request)
    {
        if ($request)
        {
			$rol=DB::table('roles')-> select('rcorrelativo')->where('iduser','=',$request->user()->id)->first();	
			if ($rol->rcorrelativo==1){
			//dd($request);
			$corteHoy = date("Y-m-d");
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
            $query=trim($request->get('searchText'));
			if (($query)==""){$query=$corteHoy; }
             $query2=trim($request->get('searchText2'));
            $query2 = date_create($query2);  
	
            date_add($query2, date_interval_create_from_date_string('1 day'));
            $query2=date_format($query2, 'Y-m-d');
         //datos venta	

            $datos=DB::table('venta as v')
			->join('formalibre as fl','fl.idventa','=','v.idventa')
			-> join('clientes as c','v.idcliente','=','c.id_cliente')
			-> join ('vendedores as ven','ven.id_vendedor','=','c.vendedor')
			->select('v.idventa','c.direccion','c.telefono','c.nombre','v.tipo_comprobante','v.num_comprobante','v.estado','v.total_venta','v.tasa','v.fecha_emi as fecha_hora','v.fecha_emi','v.saldo','v.devolu','v.user','fl.nrocontrol','fl.anulado','fl.idForma','v.base','v.texe','v.total_iva')
			-> whereBetween('v.fecha_emi', [$query, $query2])
			//-> groupby('fl.nrocontrol')
            ->get(); 
	  $query2=date("Y-m-d",strtotime($query2."- 1 days"));
        return view('reportes..ventas.ventasf.index',["datos"=>$datos,"empresa"=>$empresa,"searchText"=>$query,"searchText2"=>$query2]);
               } else { 
	return view("reportes.mensajes.noautorizado");
	}
  }
  
}
}
