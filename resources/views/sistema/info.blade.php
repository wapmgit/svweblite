@extends ('layouts.master')
@section ('contenido')
<?php
 $fserver=date('Y-m-d');
$fecha_a=$empresa -> fechavence;
function dias_transcurridos($fecha_a,$fserver)
{
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
//$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$vencida=0;
if (dias_transcurridos($fecha_a,$fserver) < 0){
  $vencida=1;
  echo "<div class='alert alert-danger'>
      <H2>LICENCIA DE USO DE SOFTWARE VENCIDA!!!</H2> contacte su Tecnico de soporte.
      </div>";
};
?>
<div class="invoice p-3 mb-3">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<p>
				<b>SysVent@s</b> es un sistema desarrollado por la empresa <b>CORPORACION DE SISTEMAS NKS</b>, con el fin de brindar una 
				herramienta de ayuda </br>para el control de entrada y salida de inventario en tu negocio.
				<span></br><b>Empresa:</b>{{$empresa->rif}} - {{$empresa->nombre}}</span>
				<span></br><b>Telefono:</b> {{$empresa->telefono}}<span>

			</p>
			<p>
				<span> <b>fecha de inicio de servicio:</b> </span>{{$empresa -> inicio}} </br>
				<span> <b>fecha de vencimiento:</b> </span>{{$empresa -> fechavence}} </br>
				<span> <b>Dias para vencer:</b> </span><?php echo dias_transcurridos($fecha_a,$fserver); ?></br>
			<span></br><b>Contacto Soporte:</b> 04169067104- 04247163726<span>
		</p>
		
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<p align="center">
		<img src="{{asset('dist/img/nks.jpg')}}"  width="350" height="200" alt="User Image">
		</p>
		</div>
	</div>
	</div>
@endsection