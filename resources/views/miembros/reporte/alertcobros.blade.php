@extends ('layouts.master')
@section ('contenido')
<?php $acum=0;$tventasf=0;$cont=0;$nvnew=0;$newpendiente=0;$newvendido=0;$repre2=0; $posi2=0;
$cefe=0; $reg=0; $diascre=0;?>
    <?php
// fecha 1
$fecha_dada= "1985/08/28";
// fecha actual
$fecha_actual= date("Y/m/d");

function dias_pasados($fecha_inicial,$fecha_final)
{
$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
$dias = abs($dias); $dias = floor($dias);
return $dias;
}
?>
 <!-- Main content -->
	<div class="invoice p-3 mb-3">
              <!-- title row -->
		<div class="row">
			<div class="col-12">
				<h4>
				<img src="{{asset('dist/img/iconosistema.png')}}" title="NKS"> SysVent@s
                    <small class="float-right"></small>
                  </h4>
			</div>
                <!-- /.col -->
		</div>
              <!-- info row -->
			<div class="row invoice-info">
		<div class="col-sm-8 invoice-col">
				{{$empresa->nombre}}
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
	</div>
                <!-- /.col -->
	<div class="col-sm-4 invoice-col">

				  <h4>Clientes Vencidos y Por Vencer</h4>     
	</div>
              </div>
              <!-- /.row -->
              <!-- Table row -->
            <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table width="100%">
				<thead>
					<th>Item</th>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Ult. Pago</th>
					<th>Dias</th>
				
				</thead>
               @foreach ($clientes as $cat)<?php $cont++;
			
				$cel=trim($cat->telefono);
				$cel =str_replace('-', '', $cel);
				$cel =str_replace('(', '', $cel);
				$cel =str_replace(')', '', $cel);
				$cel =str_replace(' ', '', $cel);
			
				?>
			   
			   ?>
				<tr>
					<td><small><?php echo $cont; ?></small></td>
					<td><small>{{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->cedula}}</small></td>
					<td><small>{{ $cat->telefono}}</small>
					
					
					</td>
					<td><small><small> <?php echo substr( $cat->direccion, 0, 30 ); ?></small></small></td>
					<td><small><?php echo date("d-m-Y",strtotime($cat->ult_pago)); ?></small></td>
					<td><small>			   <?php 
							$diascre=((int)dias_pasados($fecha_actual,$cat->ult_pago));
								if($diascre <= 3){ ?>  <font style="color:#0000FF";><?php echo $diascre." Por Vencer";?> </font> 
								 <a href="https://api.whatsapp.com/send/?phone=<?php echo $cat->codpais.$cel; ?>&text=Hola%20,<?php echo $empresa->nombre ?>,%20te%20recuerda
									%20que%20estas%20a%20<?php echo $diascre; ?>%20para%20Vencer%20suscripcion%20.%20Contactanos%20para%20mas%20detalles.%20" target="_blank">
									<i class="fa-brands fa-whatsapp"></i>
									   </a>
								<?php 
								}else { echo "<font style='color:#FF0000';>".$diascre." Vencido </font>"; ?>
								<a href="https://api.whatsapp.com/send/?phone=<?php echo $cat->codpais.$cel; ?>&text=Hola%20,<?php echo $empresa->nombre ?>,%20te%20recuerda
									%20que%20tienes%20<?php echo $diascre; ?>%20.%20de%20Vencimiento%20de%20Suscription%20Contactanos%20para%20mas%20detalles.%20" target="_blank">
									<i class="fa-brands fa-whatsapp"></i>
									   </a>
					<?php			}

								?></small>
								
								</td>
				</tr>
				
				@endforeach
			</table>
		</div>

	</div>
  <div>

    <!-- /.content -->

  </div>
  </div>
            
	<label>Usuario: {{ Auth::user()->name }}</label>   
                  
	</div><!-- /.row -->
                  
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Impimir</button>

                    </div>
                </div>


         @push ('scripts')
<script>

$(document).ready(function(){ 
    $('#imprimir').click(function(){
	document.getElementById('imprimir').style.display="none";
	window.print(); 
	window.location="{{route('reportealtcobro')}}";
    });

});
</script>
	
@endpush
@endsection