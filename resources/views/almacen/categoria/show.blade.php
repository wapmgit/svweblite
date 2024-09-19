@extends ('layouts.master')
@section ('contenido')
		  <!-- Main content -->
	<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
              <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS">SysVent@s
                    <small class="float-right"></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
				{{$empresa->nombre}}
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
				</div>
                <!-- /.col -->
				<div class="col-sm-3 invoice-col">

				  <h4>Articulos en Grupo</h4>
              
				</div>
					<div class="col-sm-3 invoice-col" align="center">
				<img src="{{asset('dist/img/logoempresa.png')}}" width="50%" height="80%" title="NKS">
				</div>
              </div>
		<div class="row">
				@include('almacen.categoria.modal')
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Nombre</label>
                   <p>{{$categoria->nombre}}</p>
                    </div>
            </div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Descripcion</label>
                   <p>{{$categoria->descripcion}}</p>
                    </div>
            </div>
			   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor"></label>
                     <label><button id="repreciar"><a href="" data-target="#modal-calcular-{{$categoria->idcategoria}}" data-toggle="modal">Repreciar Grupo</a></button><label>
                    </div>
            </div>
		</div>
        <div class ="row">
                <div class="panel panel-primary">
                <div class="panel-body">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table id="detalles" width="100%">
                      <thead style="background-color: #E6E6E6">
                     
                          <th>Codigo</th>
                          <th>Nombre</th>
                          <th>Costo</th>
                          <th>Precio</th>
                          <th>Stock</th>
                          <th>Monto</th>
              </thead><?php $acumcosto=0; $cont=0; $acumprecio=0; $acum=0; $monto=0;?>
                      <tbody>
                        @foreach($articulos as $det) <?php $cont++; ?>
                        <tr > <?php $acumcosto=($acumcosto+($det->costo*$det->stock)); $acum=($acum+$det->stock);
						$acumprecio=($acumprecio+$det->precio1); $monto=($monto+($det->stock*$det->precio1)); ?>
                          <td>{{$det->codigo}}</td>
                          <td>{{$det->nombre}}</td>
                          <td>{{$det->costo}}</td>
                          <td>{{$det->precio1}}</td>
                          <td>{{$det->stock}}</td>
                          <td>{{$det->stock*$det->precio1}}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>   {{$articulos->render()}}
					  <tr style="background-color: #E6E6E6"><td colspan="2"><strong>Total: <?php echo $cont. " Articulos."; ?></strong></td><td><strong><?php echo number_format($acumcosto, 2,',','.');?></strong></td>
					  <td><strong><?php echo number_format($acumprecio, 2,',','.');?></strong></td>
					  <td><strong><?php echo number_format($acum, 2,',','.');?></strong></td>
					  <td><strong><?php echo number_format($monto, 2,',','.');?></strong></td></tr>
                  </table>
                 
                    </div>
                </div>   
				<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center"></br>
					 <button type="button" id="regresar" class="btn btn-danger btn-sm" data-dismiss="modal" title="Presione Alt+flecha izq. para regresar">Regresar</button>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div>                
                </div>
       </div>
</div>	
@endsection
@push ('scripts')
<script>

$(document).ready(function(){
		$('#imprimir').click(function(){
	  document.getElementById('imprimir').style.display="none";
		document.getElementById('repreciar').style.display="none";
		document.getElementById('regresar').style.display="none";
	  window.print(); 
	window.location="{{route('icategoria')}}";
		});
		$('#regresar').click(function(){
	window.location="{{route('icategoria')}}";
		});

});

</script>

@endpush