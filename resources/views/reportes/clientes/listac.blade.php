@extends ('layouts.master')
@section ('contenido')
<?php $acum=0;$tventasf=0;$cont=0;$nvnew=0;$newpendiente=0;$newvendido=0;$repre2=0; $posi2=0;
$cefe=0; $reg=0;?>
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

				  <h4>Lista de Clientes</h4>     
	</div>
              </div>
              <!-- /.row -->
              <!-- Table row -->
            <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="clientestable" width="100%">
				<thead>
					<th>Item</th>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Dias Credito</th>
					<th>Creado</th>
					<th>Ult. Venta</th>
				
				</thead>
               @foreach ($clientes as $cat)<?php $cont++;?>
				<tr>
					<td><small><?php echo $cont; ?></small></td>
					<td><small>{{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->cedula}}</small></td>
					<td><small>{{ $cat->telefono}}</small></td>
					<td><small><small> <?php echo substr( $cat->direccion, 0, 30 ); ?></small></small></td>
					<td><small>{{ $cat->diascredito}}</small></td>
					<td><small>{{ $cat->creado}}</small></td>
					<td><small>{{ $cat->lastfact}}</small></td>

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
	window.location="{{route('repclientes')}}";
    });
	$(function () {
    $("#clientestable").DataTable({
		"searching": false,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#clientestable_wrapper .col-md-6:eq(0)');

  });
});
</script>
	
@endpush
@endsection