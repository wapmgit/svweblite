@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>

<?php $acum=0;$efe=0;$deb=0;$che=0;$tra=0;
$cefe=0;?>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

				
                <?php echo date("d-m-Y",strtotime($searchText)); ?> al <?php echo date("d-m-Y",strtotime($searchText2)); ?>
	</div>
    <h3 align="center">REPORTE DETALLADO DE CUENTAS DE CLASIFICACION -> {{ $datosbanco->nombre }}  </h3>
<label ></label>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>Concepto</th>
		      <th>Numero</th> 		  
          <th>Tipo</th> 
          <th>Beneficiario</th>
          <th>Fecha</th>	 
          <th>Monto</th>
          <th>Usuario</th>
       
        </thead>
        <?php $ctra= 0; $cche=0; $cdeb=0; $credito=0; $contado=0; $count=0; $tcompras=0;?>

               @foreach ($datos as $q)
        <tr >
          <td>{{ $q->concepto }}</td> 
		      <td> {{$q->numero }}</td>
          <td>{{ $q->tipo_mov }}</td> 
          <td>{{ $q->cliente }}</td>
          <td><?php  echo $fecha=date_format(date_create($q->fecha_mov),'d-m-Y h:i:s');?></td>
		    
          <td><?php $acum=$acum+ $q->monto;  echo number_format($q->monto, 2,',','.'); ?></td> 
          <td>{{ $q->user }}</td>
        </tr>
       
        @endforeach
	
         <tr>
        <td colspan="4"> <strong>TOTAL:</strong></td>
          <td colspan="3" align="center"><strong><strong><?php echo number_format($acum, 2,',','.'); ?></strong></strong></td>
   
        
        </tr>

      </table>

  </div>


	          <label>Usuario: {{ Auth::user()->name }}</label>       

                  
                  		</div>
             
      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                          <a ><button class="btn  pull-right" id="imprimir">Imprimir</button></a>
          <a href="{{route('showbanco',['id'=>$datosbanco->idbanco])}}" id="regresar"><button class="btn  pull-left" >Regresar</button></a> 

                    </div>
                </div>
      
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('showbanco',['id'=>$datosbanco->idbanco])}}";
    });

});

</script>

@endpush
@endsection