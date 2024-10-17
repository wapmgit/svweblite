<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Articulos;
use Exception;
use DB;
class SendArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendarticles';
private $recordsNotFound = ['status' => 400, 'message' => '0 registros encontrados.', 'data' => ''];
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send articles to api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		
		 
			$empresa="3e17fb7b-40ea-4787-0644-df3bb20a97f5";
			  $products=DB::table('articulos as art')->join('empresa','empresa.idempresa','=','art.idempresa')
			->select('art.codigo as barcode','art.nombre as name','art.stock','art.precio1 as price')
			->where('empresa.uuid','=',$empresa)
			->where('art.stock','>=',0)
			->get()->toArray();
			
		
      //$productsjs=json_decode($product);
		//dd($products);
          $response = Http::post('https://mercarapid.nks-sistemas.net/api/recibir-inventario', [
                'store' => $empresa,
                'productos' => ["data" => $products]
            ]);
			
			  /*  return ($response->ok())
                ? response()->json($response->body())
                : response()->json([$this->recordsNotFound]); */
		//dd($response->getBody());		
    }
}
