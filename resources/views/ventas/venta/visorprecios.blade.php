@extends ('layouts.master')
@section ('contenido')
<?php
$fserver=date('Y-m-d');
$fechaini=$empresa->fechainicio;
$fecha_a=$empresa->fechavence;
$dato=$empresa->dato;
$nivel=Auth::user()->nivel;

function dias_transcurridos($fecha_a,$fserver)
{
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
//$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$vencida=$cntvend=$cntcli=0;
$diaslicencia=dias_transcurridos($fserver,$fechaini);
$diasuso=($dato-$diaslicencia);
if (dias_transcurridos($fserver,$fechaini)>$dato){
  $vencida=1;
  echo "<div class='alert alert-danger'>
      <H2 align='center'>LICENCIA DE USO DE SOFTWARE VENCIDA!!!</H2> Contacte su Tecnico de soporte.
      </div>";
}if (($diasuso>0) and ($diasuso<10)){
	  echo "<H5 align='center'><FONT color='red'>".$diasuso." Dias para Vencer Licencia de Uso del Software.</FONT> </H5>";
};
$ceros=5;
function add_ceros($numero,$ceros) {
  $numero=$numero+1;
$digitos=strlen($numero);
  $recibo=" ";
  for ($i=0;$i<8-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
$idv=0;

?>    
	<style> 
/* Estilo para el input de visor de precios */
.input-precio-visor {
  font-family: 'Courier New', Courier, monospace; /* Números alineados */
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  background-color: #f4f4f4; /* Fondo sutil */
  border: 2px solid #ddd;
  border-radius: 8px;
  padding: 10px 15px;
  text-align: center; /* Alineado a la derecha para precios */
  width: 100%;
  box-sizing: border-box; /* Manejo correcto del padding */
  transition: all 0.3s ease;
}

/* Efecto al pasar el mouse o enfocar */
.input-precio-visor:focus {
  outline: none;
  border-color: #007bff;
  background-color: #fff;
  box-shadow: 0 0 5px rgba(0,123,255,0.5);
}

/* Estilo para cuando el input está deshabilitado (solo lectura) */
.input-precio-visor:disabled {
  background-color: #e9ecef;
  color: #6c757d;
  cursor: not-allowed;
  border-color: #ced4da;
}
  </style> 	
	<div class="row" style="background-color:#f3f4f4"> 	<hr>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"  align="right">	
				<h1>{{$empresa->nombre}}</h1>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">	
				<img src="{{ asset('dist/img/'.$empresa->logo)}}"  class="img-circle" width="20%" height="55%" align="left">
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="{{route('guardarventa')}}" method="POST" id="formvisor" enctype="multipart/form-data" >         
        {{csrf_field()}}
	
				<input type="text" id="barcode" name="codigo" class="input-precio-visor" placeholder="Codigo de Barra">	
				<input type="hidden" value="{{$empresa->tc}}" id="valortasa" name="tc"></input>
				<input type="hidden" value="{{$empresa->peso}}" id="valortasap" name="peso"></input>	
				</form> 
			</div>		
	</div>

	<div class ="row" id="optventa">
		<hr>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 align="center" id="nameart">Esperando Codigo...</h1>
			</div>
		<hr>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-green">
				<label>Bolivares</label>
				<div class="inner">
				   <h1 id="muestramontobs" align="center"><sup style="font-size: 25px"><?php ?>$   0.00</sup></h1>
					</div>
					 
					</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-blue">
				<label>Dolares</label>
				<div class="inner">
				   <h1 id="muestramonto" align="center"><sup style="font-size: 25px"><?php ?>Bs   0.00</sup></h1>
					</div>
					 
					</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="small-box bg-yellow">
			<label>Pesos</label>
			<div class="inner">
			   <h1 id="muestramontops" align="center"><sup style="font-size: 25px"><?php ?>Ps   0.00</sup></h1>
				</div>
				 
				</div>
		</div>
				
	</div>
@push ('scripts')
<script>
$(document).ready(function(){	

let barcodeTimer;
const barcodeInput = document.getElementById('barcode'); // Cambia por tu ID
var 	bs= $("#valortasa").val();
var  	ps= $("#valortasap").val();
barcodeInput.addEventListener('input', function(e) {
    // Limpiamos el temporizador cada vez que entra un nuevo carácter
    clearTimeout(barcodeTimer);

    // Esperamos 300ms de "silencio" (cuando el escáner termina de escribir)
    barcodeTimer = setTimeout(() => {
        const codigo = e.target.value.trim();
        
        if (codigo.length > 0) {
               var form2= $('#formvisor');
        var url2 = '{{route("validart")}}';
        var data2 = form2.serialize();
    $.post(url2,data2,function(result2){  
      var resultado2=result2;
	     existemp=resultado2[0].length;
      if (existemp > 0){
            var nombre=resultado2[0][0].nombre;
          var price=resultado2[0][0].precio1;  
		   $("#nameart").html(nombre); 
		   $("#muestramonto").html(price); 
		   $("#muestramontobs").html(price*bs); 
		   $("#muestramontops").html(price*ps); 
		   
           $("#barcode").val("");
           $("#barcode").focus();
		}    
          });
        }
    }, 300); // 300ms es el estándar ideal para escáneres
});
document.addEventListener('click', () => {
    setTimeout(() => {
        if (document.activeElement.tagName !== 'INPUT') {
            barcodeInput.focus();
        }
    }, 2000);
});
});
</script>
@endpush
@endsection
