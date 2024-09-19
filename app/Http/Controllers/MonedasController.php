<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Models\Monedas;
use App\Models\Empresa;
use DB;
use Auth;

class MonedasController extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request){	
		if ($request){
			$rol=DB::table('roles')-> select('newmoneda','editmoneda','iduser')->where('iduser','=',$request->user()->id)->first();	
            $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
			$query=trim($request->get('searchText'));
            $monedas=DB::table('monedas')->where('nombre','LIKE','%'.$query.'%')
			->where('idempresa',$empresa->idempresa)           
		   ->orderBy('idmoneda','asc')
            ->paginate(20);
            return view('sistema.monedas.index',["rol"=>$rol,"monedas"=>$monedas,"searchText"=>$query]);
		}
		
	}
		public function create(){
		return view('sistema.monedas.create');
	}
	    public function store (Request $request)
    {
		     $this->validate($request,[
            'nombre' => 'required',
            'simbolo' => 'required',
            'valor' => 'required'
        ]);
		$rol=DB::table('roles')-> select('newmoneda','iduser')->where('iduser','=',$request->user()->id)->first();	
         $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        if ($rol->newmoneda==1){
		$mone=new Monedas;
        $mone->idempresa=$empresa->idempresa;
        $mone->nombre=$request->get('nombre');
        $mone->simbolo=$request->get('simbolo');
        $mone->tipo=$request->get('tipo');
        $mone->valor=$request->get('valor');
        $mone->reftasa=$request->get('referencia');
        $mone->idbanco=0;
        $mone->save();
		if($mone->reftasa==1){
			$empresa=Empresa::findOrFail($empresa->idempresa);
					$empresa->tc=$request->get('valor');
					$empresa->update();
		}
		if($mone->reftasa==2){
			$empresa=Empresa::findOrFail($empresa->idempresa);
					$empresa->peso=$request->get('valor');
					$empresa->update();
		}
		
       return Redirect::to('monedas');
	   } else { 
	return view("reportes.mensajes.noautorizado");
	}

    }
	    public function edit(Request $request, $id)
    {
			$rol=DB::table('roles')-> select('editmoneda','iduser')->where('iduser','=',$request->user()->id)->first();	
            $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        if ($rol->editmoneda==1){
		$mone=Monedas::find($id);
			return view('sistema.monedas.edit')
			->with('mone',$mone);
		} else { 
	return view("reportes.mensajes.noautorizado");
	}
    }
		public function update(Request $request)
    {
		     $this->validate($request,[
            'nombre' => 'required',
            'simbolo' => 'required',
            'valor' => 'required'
        ]);
		$rol=DB::table('roles')-> select('editmoneda','iduser')->where('iduser','=',$request->user()->id)->first();	
            $empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
        if ($rol->editmoneda==1){
		$data=Monedas::findOrFail($request->id);
        $data->nombre=$request->get('nombre');
        $data->simbolo=$request->get('simbolo');
        $data->tipo=$request->get('tipo');
        $data->valor=$request->get('valor');
		$data->reftasa=$request->get('referencia');		
        $data->update();
		
			if($data->reftasa==1){
			$empresa=Empresa::findOrFail($empresa->idempresa);
					$empresa->tc=$request->get('valor');
					$empresa->update();
		}
		if($data->reftasa==2){
			$empresa=Empresa::findOrFail($empresa->idempresa);
					$empresa->peso=$request->get('valor');
					$empresa->update();
		}
		
       return Redirect::to('monedas');
	   	} else { 
	return view("reportes.mensajes.noautorizado");
	}
    }
}
