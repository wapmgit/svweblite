@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>

<?php $acumdebe=0;$acumhaber=0;$efe=0;$deb=0;$che=0;$tra=0;
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
    <h3 align="center">REPORTE AGRUPADO DE CUENTAS DE CLASIFICACION -> {{ $datosbanco->nombre }} </h3>
<label ></label>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>CUENTA DE CLASIFICACION</th>      
          <th>DEBE</th>  
          <th>HABER</th> 
		<th>SALDO</th>		  
       
        </thead>
        <?php $ctra= 0; $cche=0; $cdeb=0; $credito=0; $contado=0; $count=0; $tcompras=0; $acumdebe=$acumdebedolar=$acumhaber=$acumhaberdolar=0;?>

               @foreach ($datos as $q)
        <tr >
          <td>{{ $q->descrip }}</td> 
		         <td>	  
		<?php 
		 if ($q->tipo_mov == "PAG"){  $acumhaber=$acumhaber+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); } 
         if ($q->tipo_mov == "RET") {  $acumhaber=$acumhaber+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
         if ($q->tipo_mov == "N/D")  {  $acumhaber=$acumhaber+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
         if ($q->tipo_mov == "PPR") {  $acumhaber=$acumhaber+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
 ?></td> 

		  <td><?php 
		     if ($q->tipo_mov == "DEP"){  $acumdebe=$acumdebe+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
             if ($q->tipo_mov == "N/C"){ $acumdebe=$acumdebe+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.');}	  
		 ?> </td>

   
          <td><?php $credito=( $acumdebe - $acumhaber);
echo number_format($credito, 2,',','.');
		  ?></td>

        </tr>
 
        @endforeach
   <tr><td></td><td>Total:<strong><?php echo number_format($acumhaber, 2,',','.');?></strong></td> 
   <td>Total: <strong> <?php echo number_format($acumdebe, 2,',','.');?></strong></td>
  <td><?php echo "<strong>".number_format($credito, 2,',','.')."</strong>"; ?> </td></tr>  
      </table>

  </div>


	          <label>Usuario: {{ Auth::user()->name }}</label>       

                  
        
             
				       <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                          <a ><button class="btn btn-primary btn-sm  pull-right" id="imprimir">Imprimir</button></a>
          <a href="{{route('showbanco',['id'=>$datosbanco->idbanco])}}" id="regresar"><button class="btn btn-danger btn-sm   pull-left" >Regresar</button></a> 

                    </div>
                </div>
      
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  document.getElementById('imprimir').style.display="none";
    document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('showbanco',['id'=>$datosbanco->idbanco])}}";
    });

});

</script>

@endpush
@endsection