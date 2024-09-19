@extends ('layouts.master')
<?php $mostrar=0; ?>

@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
		@include('reportes.ventas.cobrar.search')
</div>


<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;
$cefe=0;?>
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
			@include('reportes.ventas.cobrar.empresa')
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
			   <div class="col-12 table-responsive">
				<table width="100%">
					<thead style="background-color: #E6E6E6">
						<th>Cliente</th>
						<th>Cedula</th>
						<th>Telefono</th>
						<th>Monto</th>								
					</thead>
						<?php $total=0; $count=0; $mon=0; $cli=array();?>
							@foreach ($pacientes as $cat)
							<?php $mon=$cat->acumulado;?>
							<tr>
								<td><small>{{ $cat->nombre}}</small></td>
								<td>{{ $cat->cedula}}</td>
								<td>{{ $cat->telefono}}</td>
								<td>
								@foreach ($notas as $not) <?php if ($not->id_cliente==$cat->id_cliente){
									$cli[]=$not->id_cliente;
									$total=$total+$not->acumulado; $mon=$mon+$not->acumulado;
								}?>@endforeach
								<?php $count++; $total=$total+$cat->acumulado; echo number_format( $mon, 2,',','.')." $"; ?></td>
							</tr>
							@endforeach
	<?php 
  $long=count($cli);
  for($k=0;$k<$long;$k++){
   $arraynidcliente[]=$cli[$k];} 
   $longitud = count($notas);
			$array = array();
			foreach($notas as $t){
			$arrayidcliente[] = $t->id_cliente;
			}			
			for ($i=0;$i<$longitud;$i++){
				for($j=0;$j<$long;$j++){
				if ($arrayidcliente[$i]==$arraynidcliente[$j]){
					 $arrayidcliente[$i]=0;
				};
				}
			}	
			?>
				 @foreach ($notas as $not)
				 <?php for ($i=0;$i<$longitud;$i++){
						if ($not->id_cliente==$arrayidcliente[$i]){?>
				<tr>
				<td>{{$not->nombre}}</td>
				<td></td>
				<td></td>
				<td><?php echo number_format( ($not->acumulado), 2,',','.')." $"; ?></td>
				</tr>
				 <?php 
			
				  $total=$total+$not->acumulado;
				 
				 
				 } }?>@endforeach
							<tr><td>Documentos: <?php echo $count; ?></td><td></td>
							<td><strong>Total:</strong></td>
							<td><strong><?php echo number_format( $total, 2,',','.')." $"; ?></strong></td>
							</tr>
				</table>
			</div>
			</div>		       
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<label>Usuario: </label>  {{ Auth::user()->name }}  
				<div class="form-group" align="center">
				<button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
				</div>
			</div>
                   
		</div><!-- /.box-body -->
	
            	
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('reportecxc')}}";
    });

});

</script>

@endpush
@endsection