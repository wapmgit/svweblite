<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Articulos;
use Exception;
use Illuminate\Support\Facades\Redirect;
use DB;

class ArticulosApiController extends Controller
{
	private $errorServer = ['status' => 500, 'message' => 'Error de comunicación con el servidor de la base de datos.', 'data' => ''];
	private $recordsNotFound = ['status' => 400, 'message' => '0 registros encontrados.', 'data' => ''];

	public function sendData()
    {
			
			//dd($empresa->codigo);
       try {
		  
			$article = DB::table('articulos')->join('categoria as cat','cat.idcategoria','=','articulos.idcategoria')
			->select ('articulos.idarticulo','articulos.codigo','articulos.nombre','articulos.costo','articulos.precio1','articulos.precio2','articulos.stock')
			//->where('articulos.stock','>',0)
			->get(); 
			$articlejs=json_encode($article);
		$empresa=DB::table('empresa')->first();
		//	dd($article);
            $response = Http::post('http://pedidos.nks-sistemas.net/api/recibir-articulos', [
                'empresa' => $empresa->codigo,
                'articulos' => $articlejs,
            ]);

       } catch (Exception $e) {
		   
             return Redirect::to('sininternet');
        }
		 return Redirect::to('articulos');
    }

}
