<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Banco;
use App\Models\Ctascon;
use App\Models\Monedas;
use App\Models\MovBancos;
use Carbon\Carbon;
use DB;
use Auth;

class CtasconController extends Controller
{
 	  public function index(Request $request)
    {
        if ($request)
        { 	$query=trim($request->get('searchText'));
            $empresa=DB::table('empresa')-> where('idempresa','=','1')->first();
		         
            $ctas=DB::table('ctascon')->where('descrip','LIKE','%'.$query.'%')
            ->orderBy('idcod','asc')
            ->paginate(20);
        //  dd($empresa);  
		return view('bancos.cuentasclasificacion.index',["ctas"=>$ctas,"empresa"=>$empresa,"searchText"=>$query]);
           
        }
    }
		public function create(){
		return view('bancos.cuentasclasificacion.create');
	}
	    public function store (Request $request)
    {
		     $this->validate($request,[
            'nombre' => 'required',
            'codigo' => 'required'
        ]);
	//	dd($request);
        $cta=new Ctascon;
        $cta->codigo=$request->get('codigo');
        $cta->descrip=$request->get('nombre');
        $cta->tipo=$request->get('tipo');
        $cta->save();
       return Redirect::to('ctascon');

    }
	    public function edit($id)
    {
		$cta=Ctascon::find($id);
			return view('bancos.cuentasclasificacion.editar')
			->with('cta',$cta);

    }
		public function update(Request $request)
    {
				     $this->validate($request,[
            'nombre' => 'required',
            'codigo' => 'required'
        ]);
		//dd($request);
        $categoria=Ctascon::findOrFail($request->id);
        $categoria->descrip=$request->get('nombre');
        $categoria->codigo=$request->get('codigo');
		$categoria->tipo=$request->get('tipo');
		if($request->get('estatus')=="on"){$categoria->inactiva=0;}else{$categoria->inactiva=1;}	
        $categoria->update();
       return Redirect::to('ctascon');
    }
}
