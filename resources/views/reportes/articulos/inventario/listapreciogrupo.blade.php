@extends ('layouts.master')
@section ('contenido')
		  <!-- Main content -->
	<div class="invoice p-3 mb-3">
		  <style> 
   .cabecera { background: linear-gradient(to bottom, #B3E5FC, #FAFAFA); padding: 2px;}
   .pie { background: linear-gradient(to bottom,  #FAFAFA, #B3E5FC); padding: 2px;}
  </style> 
  <div class="cabecera">
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
				<b>{{$empresa->nombre}}</b>
                  <address>
                    <strong>{{$empresa->rif}}</strong><br>
                   {{$empresa->direccion}}<br>
                     Tel: {{$empresa->telefono}}<br>
                  </address>
				</div>
                <!-- /.col -->
				<div class="col-sm-3 invoice-col">

				  <h4>Lista de Precios Agrupado</h4>
              
				</div>
					<div class="col-sm-3 invoice-col" align="center">
<img src="{{ asset('dist/img/'.$empresa->logo)}}" width="50%" height="80%" title="NKS">
	</div>
	</div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
					<table width="100%" id="tablap">
						<thead style="background-color: #A9CCE3 !important">
						<th>Nombre</th>
						<th>Unidad</th>
						<th id="p3">Existencia  <i class="fa fa-fw fa-eye" title="Ocultar" id="ocultarst"></i></th>
						<th id="pd">Precio <i class="fa fa-fw fa-eye" title="Ocultar" id="ocultarpd">1</i></th>  
						<th id="p2">Precio <i class="fa fa-fw fa-eye" title="Ocultar" id="ocultarp2">2</i></</th>
						</thead><?php $count=0; $i=0;$costo=0;$costoacum=0; $precioacum=0; $order=1;?>
						@foreach ($grupos as $g)<?php $i; ?>	<tr><td><strong>Grupo: {{$g->nombre}}</strong></td> 
							@foreach ($lista as $q)
							   <?php if($q->idcategoria==$g->idcategoria){?>
							<tr <?php $i++; if (($i%2)==0){ echo "style='background-color: #D4E6F1 !important'";}?>> <?php $count++; 
								$costoacum=$q->stock+$costoacum;
								$costo=$costo+($q->costo*$q->stock);
								$precioacum=$q->stock*$q->precio1+$precioacum;
								?> 
								<td>{{ $q->nombre}} <?php if($q->iva>0){ /*echo "(G)"; }else { echo "(E)"; */} ?></td>
								<td>{{ $q->unidad}}</td>
								<td class="filap3">{{ $q->stock}}</td>
								<td class="filap1"><?php echo number_format( $q->precio1, 2,',','.'); ?></td>	
								<td class="filap2"><?php echo number_format( $q->precio2, 2,',','.'); ?></td>  
							   </tr><?php } ?>
							@endforeach
							</tr>@endforeach
							<tr style="background-color: #A9CCE3" >
								<td colspan="2"><?php echo "<strong>Articulos: ".$count."</strong>"; ?></td>
								<td class="filap3"><?php echo "<strong>Existencias : ".$costoacum."</strong>"; ?></td>
								<td class="filap2"></td>
								<td class="filap1"></td>
							</tr>
					</table>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 csol-sm-6 col-xs-12 pie" id="botones">
                    <div class="form-group" align="center"></br>
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button>
					 <a href="{{route('listaprecios')}}"><button class="btn btn-success btn-sm"> Ordenar por Nombre</button></a>
				  </div>
			</div>
  </div>
@push ('scripts')
<script>
$(document).ready(function(){
	$('#ocultarpd').click(function(){
		document.getElementById('pd').style.display="none";
		document.getElementById('ocultarp2').style.display="none";
		$(".filap1").remove();
    });
	$('#ocultarp2').click(function(){
		document.getElementById('p2').style.display="none";
		document.getElementById('ocultarpd').style.display="none";
		$(".filap2").remove();
    });
		$('#ocultarst').click(function(){
		document.getElementById('p3').style.display="none";
		document.getElementById('ocultarst').style.display="none";
		$(".filap3").remove();
    });
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('botones').style.display="none";
  document.getElementById('ocultarp2').style.display="none";
  document.getElementById('ocultarpd').style.display="none";
  document.getElementById('ocultarst').style.display="none";
  window.print(); 
  window.location="{{route('listaprecios')}}";
    });

});

</script>
@endpush
@endsection