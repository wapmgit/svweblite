<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Empresa;
use App\Models\Sistema;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;

class EmpresasController extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request){
		$rol=DB::table('roles')-> select('newempresa','iduser')->where('iduser','=',$request->user()->id)->first();
		$empresa=DB::table('users')->join('empresa','empresa.idempresa','=','users.idempresa')-> where('id','=',$rol->iduser)->first();
		if ($rol->newempresa==1){
		if ($request){
            $query=trim($request->get('searchText'));
            $empresas=DB::table('empresa')->where('nombre','LIKE','%'.$query.'%')
			->join('sistema','sistema.idempresa','empresa.idempresa')
            ->orderBy('empresa.idempresa','asc')
            ->paginate(20);
            return view('empresas.empresa.index',["empresas"=>$empresas,"searchText"=>$query]);
		}
		 } else { 
	return view("reportes.mensajes.noautorizado");
	}
		
	}	
	public function create(){
		return view('empresas.empresa.create');
	}
	    public function store (Request $request)
    {
		     $this->validate($request,[
            'nombre' => 'required',
            'rif' => 'required',
            'uuid' => 'required'
        ]);
        $data=new Empresa;
        $data->nombre=$request->get('nombre');
        $data->uuid=$request->get('uuid');
        $data->rif=$request->get('rif');
        $data->telefono=$request->get('telefono');
        $data->direccion=$request->get('direccion');
        $data->fechasistema=$request->get('fechainicio');
        $data->inicio=$request->get('fechainicio');
        $data->serie="A";
        $data->tc=10;
        $data->peso=10;
        $data->save();
		
             $query2=trim($request->get('fechainicio'));
            $query2 = date_create($query2);
            date_add($query2, date_interval_create_from_date_string('365 day'));
            $query2=date_format($query2, 'Y-m-d');
			
			$newsistema=new Sistema;
        $newsistema->idempresa=$data->idempresa;
		$newsistema->fechainicio=$request->get('fechainicio');
		$newsistema->fechavence=$query2;
		$newsistema->save();
				
		 $user=$request->get('nusuario');		 
		 $mail=$request->get('mail');		 
		 $pass=$request->get('pass');		 
           $contp=0;
              while($contp < count($user)){
				User::create([
					'name' => $user[$contp],
					'email' => $mail[$contp],
					'password' => Hash::make($pass[$contp]),
					'idempresa' => $data->idempresa,
				]);
				$iduser=DB::table('users')->select('id')->where('idempresa',$data->idempresa)->orderby('id','DESC')->first();
				$dat=new Roles;
				$dat->iduser=$iduser->id;
				$dat->save();
				
				$actuser=User::findOrFail($iduser->id);
				$actuser->nivel="A";
				$actuser->update();
				
				$contp++;
			  }
       return Redirect::to('iempresas');

    }
		public function update(Request $request)
    {
		//dd($request);
        $categoria=Categoria::findOrFail($request->id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
       return Redirect::to('icategoria');
    }
}
