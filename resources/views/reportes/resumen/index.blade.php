@extends ('layouts.master')
@section ('contenido')
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

				  <h4>Resumen Gerencial</h4>
              
				</div>
					<div class="col-sm-3 invoice-col" align="center">
<img src="{{asset('dist/img/logoempresa.png')}}" width="50%" height="80%" title="NKS">
	</div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-6 table-responsive">
    <div class="table-responsive">      
      <table width="100%">
	    <thead style="background-color: #E6E6E6"><th colspan="4" > <div align="center">Cuentas por Pagar</div></th></thead>
        <thead style="background-color: #E6E6E6">
					<th>Proveedor</th>
					<th>Telefono</th>
					<th>Monto</th>
					<th>Por Pagar</th>
				</thead><?php $count=0; $montoacum=0; $acumcompra=0;?>
               @foreach ($compras as $q)
				<tr> <?php $count++; 
					$montoacum=$montoacum+$q->saldo; $acumcompra=$acumcompra+$q->total;?> 
					<td><small><small>{{ $q->nombre}}</small></small></td>
					<td><small><small>{{ $q->telefono}}</small></small></td>
					<td><?php echo number_format($q->total, 2,',','.')." $"; ?></td>
					<td><?php echo number_format($q->saldo, 2,',','.')." $"; ?></td>	
				</tr>
				@endforeach
				@foreach ($gastos as $q)
				<tr> <?php  
					$montoacum=$montoacum+$q->saldo; $acumcompra=$acumcompra+$q->monto;?> 
					<td><small><small>{{ $q->nombre}} (Gto)</small></small></td>
					<td><small><small>{{ $q->telefono}}</small></small></td>
					<td><?php echo number_format( $q->monto, 2,',','.')." $"; ?></td>
					<td><?php echo number_format( $q->saldo, 2,',','.')." $"; ?></td>	
				</tr>
				@endforeach
				<tr style="background-color: #E6E6E6"><td colspan="2"><strong>Total</strong></td><td><strong><?php   echo "$ ".number_format($acumcompra, 2,',','.'); ?></strong></td><td><strong><?php   echo "$ ".number_format($montoacum, 2,',','.'); ?></strong></td></tr>
			</table>
		</div>
  
  </div>
  <div class="col-6 table-responsive">     
      <table width="100%">
	  	    <thead style="background-color: #E6E6E6"><th colspan="4" > <div align="center">Cuentas por Cobrar</div></th></thead>
        <thead style="background-color: #E6E6E6">
					<th>Cliente</th>
					<th>Telefono</th>
					<th>Monto</th>
					<th>Por Cobrar</th>
				</thead><?php $count=0;$mn=$cnt=0; $mpc=0; $montoventa=0; $montosaldo=0;  $cli=array();?>
               @foreach ($ventas as $q)
				<tr> <?php $count++;  $mn=$q->total_venta; $mpc=$q->saldo;
        $montosaldo=$montosaldo+$q->saldo; $montoventa=$montoventa+$q->total_venta; ?> 
					<td><small><small>{{ $q->nombre}}</small></small></td>
					<td><small><small>{{ $q->telefono}}</small></small></td>
					@foreach ($notas as $not) <?php if ($not->id_cliente==$q->id_cliente){ $cnt++;
						$cli[]=$not->id_cliente;
       $montosaldo=$montosaldo+$not->saldo; $montoventa=$montoventa+$not->monto;	$mn=$mn	+$not->monto;
	   $mpc=$mpc	+$not->saldo;
								}?>@endforeach
					<td><small><?php echo number_format($mn, 2,',','.')." $"; ?></small></td>
					<td><small><?php echo number_format($mpc, 2,',','.')." $"; ?></small></td>	
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
				<td><small><small>{{$not->nombre}}</small></small></td>
				<td></td>
				<td><small>{{$not->monto}} $</small></td>
				<td><small>{{$not->saldo}} $</small></td>
				</tr>
				 <?php 
				  $montoventa=$montoventa+$not->monto;
				  $montosaldo=$montosaldo+$not->saldo;
				 
				 
				 } }?>
				@endforeach
				<tr style="background-color: #E6E6E6"><td colspan="2"><strong>Total</strong></td><td><strong><?php   echo "$ ".number_format($montoventa, 2,',','.'); ?></strong></td><td><strong><?php   echo "$ ".number_format($montosaldo, 2,',','.'); ?></strong></td></tr>
			</table>
		</div>
		  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h5 class="mb-2">Datos de Interes</h5>
        <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
		 <i class="nav-icon fas fa-person"></i>
              <div class="info-box-content">
                <span class="info-box-text">Clientes</span>
                <span class="info-box-number">{{$clientes->clientes}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
			<i class="nav-icon fas fa-wrench"></i>
              <div class="info-box-content">
                <span class="info-box-text">Proveedores</span>
                <span class="info-box-number">{{$proveedores->proveedores}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
	 <i class="nav-icon fas fa-shopping-cart"></i>

              <div class="info-box-content">
                <span class="info-box-text">Articulos</span>
                <span class="info-box-number">{{$articulos->articulos}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
	 <i class="nav-icon fas fa-dollar"></i>

              <div class="info-box-content">
                <span class="info-box-text">Valorizacion</span>
                <span class="info-box-number"> <small>Costo: </small>{{$articulos->vcosto}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		  <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
	 <i class="nav-icon fas fa-dollar"></i>

              <div class="info-box-content">
                <span class="info-box-text">Valorizacion</span>
                            <span class="info-box-number"> <small>Precio: </small>{{$articulos->vprecio}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
		  		    <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
	 <i class="nav-icon fas fa-truck"></i>

              <div class="info-box-content">
                <span class="info-box-text">Vendedores</span>
                <span class="info-box-number">{{$vende->vendedor}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  
  </div>
  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
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
  window.location="{{route('resumen')}}";
    });

});

</script>

@endpush
         
@endsection