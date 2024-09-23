@extends ('layouts.master')
@section ('contenido')
<?php
 $fserver=date('Y-m-d');
$fechaini=$empresa->fechainicio;
$fecha_a=$empresa->fechavence;
$dato=$empresa->dato;

/*$fecha1= new DateTime($fechaini);
$fecha2= new DateTime($fserver);

$diff = $fecha1->diff($fecha2);
$intervalMeses=$diff->format("%m");
$intervaldias=$diff->format("%d");
*/
function dias_transcurridos($fecha_a,$fserver)
{
$dias = (strtotime($fecha_a)-strtotime($fserver))/86400;
//$dias = abs($dias); $dias = floor($dias);
return $dias;
}
$vencida=0;
$diaslicencia=dias_transcurridos($fserver,$fechaini);
$diasuso=($dato-$diaslicencia);
if (dias_transcurridos($fserver,$fechaini)>$dato){
  $vencida=1;
  echo "<div class='alert alert-danger'>
      <H2>LICENCIA DE USO DE SOFTWARE VENCIDA!!!</H2> Contacte su Tecnico de soporte.
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
				<span> <b>Modo Licencia:</b> </span> <?php 
				if($empresa->dato==31){echo "Mensual";}
				if($empresa->dato==93){echo "Trimestre";}
				if($empresa->dato==183){echo "Semestre";}
				if($empresa->dato==365){echo "Anual";} 			
				?> </br>
				<span> <b>fecha de inicio de Licencia:</b> </span>{{$empresa -> fechainicio}} </br>
				<span> <b>fecha de vencimiento:</b> </span>{{$empresa -> fechavence}} </br>
				<?php if($vencida==0){?>
				<span> <b>Dias para vencer:</b> </span><?php echo ($diasuso)." Dias "; ?></br>
				<?php }else{ ?>
				<span> <b>Dias de Vencimiento:</b> </span><?php echo ($diasuso)." Dias "; ?></br>
					<?php }?>
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