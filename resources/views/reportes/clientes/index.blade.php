@extends ('layouts.master')
@section ('contenido')
<div class="row">
		@include('reportes.clientes.search')
</div>
<?php $acum=0;$tventasf=0;$deb=0;$nvnew=0;$newpendiente=0;$newvendido=0;$repre2=0; $posi2=0;
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
			@include('reportes.clientes.empresa')
              </div>
              <!-- /.row -->
              <!-- Table row -->
            <div class="row">
				<div class="col-6 table-responsive">
					<table width="100%">
						<thead style="background-color: #E6E6E6"> <th colspan="7">Estadisticas por Ventas</th></thead>
						<thead style="background-color: #E6E6E6">
						  <th>Cliente</th>
						  <th>Ventas</th>
						  <th>Promedio</th>
						  <th>Total</th> 
						  <th>Pagado</th>		
						  <th>Saldo</th>		
						  <th>% V.</th>	
						@foreach ($datos as $m)
						<?php $reg++; $tventasf=$tventasf+$m->vendido; ?>
						@endforeach		  
						</thead><?php $count=0; $deuda=0; $acump=0; $tmonto=0; $tdeuda=0;$tpendiente=$tventas=$tmiva=0; ?>
						@foreach ($datos as $q)
						<tr> <?php $count++; $tmonto=$tmonto+$q->vendido; $tdeuda=$tdeuda+($q->vendido-$q->pendiente);
							$tpendiente=$tpendiente+$q->pendiente; $tventas=$tventas+$q->nventas;
							if($datosm[0]->nombre==$q->nombre){ $posi2=$count; $repre2=$q->vendido;}
									?> 
							<td>{{ $q->nombre}}</td>
							<td>{{ $q->nventas}}</td>
							<td><?php echo number_format( $q->vpromedio,2,',','.'); ?></td>
							<td><?php echo number_format( $q->vendido,2,',','.'); ?></td>
							<td><?php echo number_format( ($q->vendido-$q->pendiente),2,',','.'); ?></td>
							<td><?php  echo number_format($q->pendiente, 2,',','.'); ?></td>	
							<td><?php  echo number_format((($q->vendido*100)/$tventasf), 2,',','.'); ?></td>				
						</tr>
						@endforeach
							<tr><td colspan="3"><strong>Total:<?php echo $count; ?></strong></td>
							<td><strong><?php echo number_format( $tmonto, 2,',','.'); ?></strong></td>
							<td><strong><?php echo number_format( $tdeuda, 2,',','.'); ?></strong></td>
							<td><strong><?php echo number_format( $tpendiente, 2,',','.'); ?></strong></td>	<td></td></tr>
					</table>
				</div>
				<div class="col-6 table-responsive">
					<table width="100%">
						<thead style="background-color: #E6E6E6"> <th colspan="6">Estadisticas por Monto Facturado</th></thead>
						<thead style="background-color: #E6E6E6">
						<th>Cliente</th>
						<th>Ventas</th>
						<th>Promedio</th>
						<th>Total</th> 
						<th>Pagado</th>		
						<th>Pendiente</th>		
						</thead><?php $count=0; $deuda=0; $acump=0; $tmonto=0; $tdeuda=0;$tpendiente=$repre=$posi=0; ?>
						@foreach ($datosm as $q)
						<tr> <?php $count++; $tmonto=$tmonto+$q->vendido; $tdeuda=$tdeuda+($q->vendido-$q->pendiente);
						$tpendiente=$tpendiente+$q->pendiente;
						if($datos[0]->nombre==$q->nombre){ $posi=$count; $repre=$q->vendido;}
						?> 
						<td>{{ $q->nombre}}</td>
						<td>{{ $q->nventas}}</td>
						<td><?php echo number_format( $q->vpromedio,2,',','.'); ?></td>
						<td><?php echo number_format( $q->vendido,2,',','.'); ?></td>
						<td><?php echo number_format( ($q->vendido-$q->pendiente),2,',','.'); ?></td>
						<td><?php  echo number_format($q->pendiente, 2,',','.'); ?></td>	
						</tr>
						@endforeach
						<tr><td colspan="3"><strong>Total:<?php echo $count; ?></strong></td>
						<td><strong><?php echo number_format( $tmonto, 2,',','.'); ?></strong></td>
						<td><strong><?php echo number_format( $tdeuda, 2,',','.'); ?></strong></td>
						<td><strong><?php echo number_format( $tpendiente, 2,',','.'); ?></strong></td></tr>
					</table>
				</div>
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php if($reg>0) {?>
		<div class="table-responsive">
			<p> Total clientes registrados {{$nclientes}}, las ventas estan representadas por <?php echo $count; ?> clientes, esto equivale el 
			<?php echo number_format( ((100*$count)/$nclientes), 2,',','.')."%"; ?> de la poblacion de clientes, para un total de <?php echo $tventas; ?> ventas,
			 <?php echo $datos[0]->nombre; ?> es el cliente con mas ventas registradas y el <?php echo $posi; ?>° en cuanto a monto facturado lo que representa el
			<?php echo number_format( ((100*$repre)/$tventasf), 2,',','.')."%"; ?> del total facturado en este periodo. </p>
			<p>Basado en el Monto facturado,  <?php echo $datosm[0]->nombre; ?> es el cliente con mayor facturacion, sus Compras equivalen al
			<?php echo number_format( ((100*$datosm[0]->vendido)/$tventasf), 2,',','.')."%"; ?>, para un total de <?php echo number_format($datosm[0]->vendido, 2,',','.'); ?> $,
			posee un saldo pendiente de <?php echo number_format( (($datosm[0]->pendiente)), 2,',','.')."$"; ?> es el
			<?php echo $posi2; ?>° cliente en cuanto a cantidad de facturas emitidas. </br>El porcentaje de pagos por el total de facturas emitidas del <?php echo date("d-m-Y",strtotime($searchText)); ?> al <?php echo date("d-m-Y",strtotime($searchText2)); ?> es de
			<?php echo number_format( (($tdeuda*100/$tventasf)), 2,',','.')."%"; ?> </p>
			@foreach ($vclientes as $m)
			<?php $nvnew=$nvnew+$m->nventas; $newvendido=$newvendido+$m->vendido; $newpendiente=$newpendiente+$m->pendiente;?>
			@endforeach	
			<p> En este periodo se registraron <?php echo $newclientes; ?> clientes nuevos, lo que genero un total de <?php echo $nvnew; ?> ventas por un monto de <?php echo number_format($newvendido, 2,',','.')." $"; ?>, de las cuales se encuentra pendiente por cancelar <?php echo number_format($newpendiente, 2,',','.'); ?>
			. Los nuevos clientes registraron el <?php echo number_format( (($newvendido*100)/($tventasf)), 2,',','.')."%";  ?> de las ventas del periodo.
			(Clientes Nuevos: 
			@foreach ($clientes2 as $m)
			<?php echo $m->nombre.", ";?>
			@endforeach	)</p>
	   </div><?php } ?>
  </div>
  <div>
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
		              <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Ventas/Clientes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
</div>
          <div class="col-md-6">
            <!-- DONUT CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ventas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
     
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  </div>
            
	<label>Usuario: {{ Auth::user()->name }}</label>   
                  
	</div><!-- /.row -->
                  
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Impimir</button>
            <!-- <a href="/reportes/compras/excel/"><button class="btn btn-warning">TXT</button></a> -->
                    </div>
                </div>


         @push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  //  alert ('si');
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('aclientes')}}";
    });

});
</script>
  <?php if($reg>=5){?>
<script>
  $(function () {

    // Get context with jQuery - using jQuery's .get() method.
   // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels: [<?php echo "'".$datosm[0]->nombre."','".$datosm[1]->nombre."','".$datosm[2]->nombre."','".$datosm[3]->nombre."','".$datosm[4]->nombre."'";
		?> ],
      datasets: [
        {
          label: "Ventas",
          fillColor: "rgba(23, 125, 204, 1)",
          strokeColor: "rgba(23, 125, 204, 1)",
          pointColor: "rgba(23, 125, 204, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [
		<?php echo $datosm[0]->vendido.",".$datosm[1]->vendido.",".$datosm[2]->vendido.",".$datosm[3]->vendido.",".$datosm[4]->vendido;
		?>  ]
        },
        {
          label: "Pendiente",
           backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
  data: [
		<?php echo $datosm[0]->pendiente.",".$datosm[1]->pendiente.",".$datosm[2]->pendiente.",".$datosm[3]->pendiente.",".$datosm[4]->pendiente;
		?>  ]
        }
      ]
    }

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Ventas',
          'Cobros',
          'Credito',

      ],
      datasets: [
        {
          data: [<?php echo $tventasf; ?>,<?php echo $tdeuda; ?>,<?php echo $tpendiente; ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


  })
</script>
	  <?php } ?>
@endpush
@endsection