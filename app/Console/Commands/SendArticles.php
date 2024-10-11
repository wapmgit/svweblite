<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
          try {
			  $products=DB::table('articulos')->join('empresa','empresa.idempresa','=','articulos.idempresa')
			->select('codigo as barcode','nombre as name','stock','precio1 as price')
			->where('empresa.uuid','=','3e17fb7b-40ea-4787-0644-df3bb20a97f5')
			->where('stock','>=',0)
			->get();
            $message  = count($products) . ' registros cargados al servidor de Mercarapi.';

 
            $productsjs=json_encode($products);
	//dd($productsjs);		
            $response = Http::post('https://mercarapid.nks-sistemas.net/api/recibir-inventario', [
                'store' => '3e17fb7b-40ea-4787-0644-df3bb20a97f5',
                'productos' => ["data" => $products]
            ]);

            return ($response->ok())
                ? response()->json($response->body())
                : response()->json([$this->recordsNotFound]);

        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
