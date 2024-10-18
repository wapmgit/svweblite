<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Articulos;
use App\Models\Empresa;
use Carbon\Carbon;
use Exception;
use DB;

class SendArticlesRox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendarticlesrox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send articles to api rossana';

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
      			$empresa="3e17fb7b-40ea-4787-0645-df3bb20a97f5";
			  $products=DB::table('articulos as art')
				->join('empresa','empresa.idempresa','=','art.idempresa')
				->select('art.codigo as barcode','art.nombre as name','art.stock','art.precio1 as price')
				->where('empresa.uuid','=',$empresa)
				->where('art.stock','>=','0')
				->get()->toArray();

          $response = Http::post('http://mercarapid.nks-sistemas.net/api/recibir-inventario', [
                'store' => $empresa,
                'productos' => ["data" => $products]
            ]);
			
		//act last actualizacion en empresa
		$emp=Empresa::findOrFail(4);
        $mytime=Carbon::now('America/Caracas');
		$emp->lastact=$mytime->toDateTimeString();
		$emp->update();
    }
}
