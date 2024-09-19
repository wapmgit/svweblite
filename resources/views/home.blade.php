@extends('layouts.master')
@section('contenido')
<div class="row">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo count($articulos); ?></h3>

                <p>Articulos</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{route('articulos')}}" class="small-box-footer">
                ver <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($proveedor); ?></h3>

                <p>Proveedores</p>
              </div>
              <div class="icon">
                <i class="fas fa-line-chart"></i>
              </div>
              <a href="{{route('proveedores')}}" class="small-box-footer">
                ver <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo count($clientes); ?></h3>

                <p>Clientes</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{route('clientes')}}" class="small-box-footer">
                ver <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count($vendedores); ?></h3>

                <p>Vendedores</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck"></i>
              </div>
              <a href="{{route('vendedores')}}" class="small-box-footer">
                Ver <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col (LEFT) -->
          <div class="col-md-12">
 
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Compras/Ventas</h3>

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

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col (LEFT) -->
          <div class="col-md-12">
 
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Resumen</h3>

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
			      <table width="100%">
        <thead >
          <th>Item</th>
          <th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
        </thead>    
		<tbody>
		<tr>
          <td style="background-color: #2b92da" align="center"><strong>Compras</strong></td>
          <td><?php   echo number_format($cene->total, 2,',','.'); ?></td>
          <td><?php echo number_format($cfeb->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($cmar->total, 2,',','.'); ?></td>
		  <td><?php   echo number_format($cabr->total, 2,',','.'); ?></td>
          <td><?php echo number_format($cmay->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($cjun->total, 2,',','.'); ?></td> 
		  <td><?php   echo number_format($cjul->total, 2,',','.'); ?></td>
          <td><?php echo number_format($cago->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($csep->total, 2,',','.'); ?></td>
		  <td><?php   echo number_format($coct->total, 2,',','.'); ?></td>
          <td><?php echo number_format($cnov->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($cdic->total, 2,',','.'); ?></td>     		  
        </tr>
			<tr>
          <td style="background-color: #269309" align="center"><strong>Ventas</strong></td>
          <td><?php   echo number_format($vene->total, 2,',','.'); ?></td>
          <td><?php echo number_format($vfeb->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($vmar->total, 2,',','.'); ?></td>
		  <td><?php   echo number_format($vabr->total, 2,',','.'); ?></td>
          <td><?php echo number_format($vmay->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($vjun->total, 2,',','.'); ?></td> 
		  <td><?php   echo number_format($vjul->total, 2,',','.'); ?></td>
          <td><?php echo number_format($vago->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($vsep->total, 2,',','.'); ?></td>
		  <td><?php   echo number_format($voct->total, 2,',','.'); ?></td>
          <td><?php echo number_format($vnov->total, 2,',','.'); ?></td>  
		  <td><?php echo number_format($vdic->total, 2,',','.'); ?></td>     		  
        </tr>
		</tbody>
      </table>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@push('scripts')

<script>
$(document).ready(function(){
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
  

    var areaChartData = {
      labels: ["Enero","Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
      datasets: [
        {
          label               : 'Compras',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
		  data: [
		<?php echo $cene->total.",".$cfeb->total.",".$cmar->total.",".$cabr->total.",".$cmay->total.",".$cjun->total.",".$cjul->total.",".$cago->total.",".$csep->total.",".$coct->total.",".$cnov->total.",".$cdic->total;
		?>  ]
        },
        {
          label               : 'Ventas',
          backgroundColor     : 'rgba(38, 147, 9, 1)',
          borderColor         : 'rgba(38, 147, 9, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(38, 147, 9, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(38, 147, 9,1)',
		  data: [
		<?php echo $vene->total.",".$vfeb->total.",".$vmar->total.",".$vabr->total.",".$vmay->total.",".$vjun->total.",".$vjul->total.",".$vago->total.",".$vsep->total.",".$voct->total.",".$vnov->total.",".$vdic->total;
		?>  ]
        },
      ]
    }
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
    })
</script>
@endpush
@endsection
