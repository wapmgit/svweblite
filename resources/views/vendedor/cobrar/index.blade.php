@extends ('layouts.master')
@section ('contenido')
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

				  <h4>Cuentas por Cobrar de Vendedores</h4>
                
	</div>
              </div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
				
					<th>Vendedor</th>
					<th>Cedula</th>
					<th>Telefono</th>
					<th>Monto</th>
					
				</thead>
				<?php $total=0; ?>
               @foreach ($ventas as $cat)
			   		<?php $saldor=0;?>
				<tr>
				
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->cedula}}</td>
					<td>{{ $cat->telefono}}</td>
					@foreach($notasnd as $n)
					<?php if($n->vendedor==$cat->idvendedor){ $saldor=$n->tnotas;}?>
								@endforeach
					<td><?php $total=$total+ ($cat->acumulado+$saldor); echo number_format( ($cat->acumulado+$saldor), 2,',','.')." $"; ?></td>				
					@endforeach		
				</tr>
			
				<tr ><td colspan="5"><button type="button" class="btn bg-olive btn-flat margin"><strong><?php echo "Cuentas por Cobrar: ".number_format( $total, 2,',','.')." $";?></strong></button></td></tr>
			</table>
		</div>
		{{$ventas->render()}}
	<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div>
	</div>
	 
</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="/vendedor/cobrar";
    });

});

</script>

@endpush
@endsection