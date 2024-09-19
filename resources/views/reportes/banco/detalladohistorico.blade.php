@extends ('layouts.master')
@section ('contenido')
<?php  $ban=0; $nombrebanco=$banco->nombre; $ban=$banco->idbanco;?> 

 <?php  $ctra= 0; $cche=0; $cdeb=0; $credito=0; $contado=0; $count=0;  $tcompras=0;$mingreso=$megreso=0;?>
<div class="row"> 
@include('reportes.banco.search')
              </div>

<?php $acumdebe=0;$acumhaber=0;$efe=0;$deb=0;$che=0;$tra=0;$banco=0;
$cefe=0;
?>                 <div class="invoice p-3 mb-3">
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
	</div>
              </div> 

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3 align="center">REPORTE DETALLADO <?php echo $nombrebanco; ?>  </h3>
	@foreach ($saldo as $mov)
                               <?php 
                                 if ($mov->tipo_mov == "DEP") $mingreso=$mingreso+$mov->tmonto;   
                                  if ($mov->tipo_mov == "N/C") $mingreso=$mingreso+$mov->tmonto;   
                                 if ($mov->tipo_mov == "PAG") $megreso=$megreso+$mov->tmonto; 
                                  if ($mov->tipo_mov == "TRA") $megreso=$megreso+$mov->tmonto;
                                  if ($mov->tipo_mov == "N/D") $megreso=$megreso+$mov->tmonto; 
                                    if ($mov->tipo_mov == "PPR") $megreso=$megreso+$mov->tmonto;?>
                              @endforeach 
<label ></label>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>FECHA</th>      
          <th>CUENTA DE CLASIFICACION</th>     
          <th>DESCRIPCION</th>  
          <th>DEBE</th>  
          <th>HABER</th>
		      <th>SALDO</th>		         
        </thead>
		        <?php $ctra= 0; $cche=0; $cdeb=0;$i=0; $saldoanterior=0; $credito=0; $contado=0; $count=0; $tcompras=0;?>
		<tr><td></td><td></td><td></td><td></td><td></td><td><?php $saldoanterior=($mingreso-$megreso);  echo number_format( ($mingreso-$megreso), 2,',','.'); ?></td></tr>
               @foreach ($movimiento as $q) 
        <?php $newdate=date("d-m-Y h:i:s a",strtotime($q->fecha_mov)); ?>
		<tr >@include('reportes.banco.modal')
          <td><small><?php echo $newdate; ?></small></td> 
        <td><small>{{ $q->descrip }}</small></td>
        <td>{{ $q->concepto }}-> <a href="{{route('showrecibo',['id'=>$q->id_mov])}}"> <strong>{{ $q->numero}}</strong></a></td>  
          <td>	  
		<?php 
		 if ($q->tipo_mov == "PAG"){  $acumdebe=$acumdebe+ $q->monto; echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.');} 
         if ($q->tipo_mov == "TRA") {  $acumdebe=$acumdebe+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
         if ($q->tipo_mov == "N/D")  { $acumdebe=$acumdebe+ $q->monto;  echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.');  ?>@if($rol->anularopbanco==1) <a href="" data-target="#modal-{{$q->id_mov}}" data-toggle="modal"><i class="fa-solid fa-trash" style="color:red"></i></a>@endif<?php }
         if ($q->tipo_mov == "PPR") {  $acumdebe=$acumdebe+ $q->monto;   echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); ?> @if($rol->anularopbanco==1)<a href="" data-target="#modal-{{$q->id_mov}}" data-toggle="modal"><i class="fa-solid fa-trash" style="color:red"></i></a>@endif <?php  }
 ?></td> 
 		  <td><?php 
		     if ($q->tipo_mov == "DEP"){ $acumhaber=$acumhaber+ $q->monto;   echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); }
             if ($q->tipo_mov == "N/C"){ $acumhaber=$acumhaber+ $q->monto;   echo $q->tipo_mov."  ->  ".number_format($q->monto, 2,',','.'); ?>@if($rol->anularopbanco==1)<a href="" data-target="#modal-{{$q->id_mov}}" data-toggle="modal"><i class="fa-solid fa-trash" style="color:red"></i></a>@endif<?php }	  
		 ?> </td>
          <td><?php $credito=(($acumhaber+$saldoanterior) - $acumdebe);
echo number_format($credito, 2,',','.');
		  ?></td>

        </tr>
  
        @endforeach
   <tr><td></td><td></td><td></td><td>Total: <strong> <?php echo number_format($acumdebe, 2,',','.');?></strong></td>
  <td>Total:<strong><?php echo number_format($acumhaber, 2,',','.');?></strong></td> <td><?php echo "<strong>".number_format($credito, 2,',','.')."</strong>"; ?> </td></tr>  
      </table>

  </div>


	          <label>Usuario: {{ Auth::user()->name }}</label>       

                  
                  		</div>
             
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
                          <a ><button class="btn btn-primary btn-sm  pull-right" id="imprimir">Imprimir</button></a>
          <a href="{{route('showbanco',['id'=>$ban])}}" id="regresar"><button class="btn btn-danger btn-sm  pull-left" >Regresar</button></a> 

                    </div>
                </div>
                </div>
      
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
    document.getElementById('regresar').style.display="none";
  window.print(); 
  window.location="{{route('showbanco',['id'=>$ban])}}";
    });

});

</script>

@endpush
@endsection