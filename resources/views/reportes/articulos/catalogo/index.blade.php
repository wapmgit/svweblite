@extends ('layouts.master')
<?php $mostrar=0; ?>
@section ('contenido')
<?php $mostrar=1; ?>
<div class="row">
		@include('reportes.articulos.catalogo.search')
</div>           
  <style> 
   .cabecera { background: linear-gradient(to bottom, #B3E5FC, #FAFAFA); padding: 2px;}
   .pie { background: linear-gradient(to bottom,  #FAFAFA, #B3E5FC); padding: 2px;}
.bordeimagen{
border:1px solid #0D47A1;
padding:5px;
}<
  </style> 
 <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
			  <div class="cabecera">
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
              <div class="row invoice-info" >
			@include('reportes.articulos.catalogo.empresa')
              </div>
			  </div>
              <!-- /.row -->
<hr size="2px" color="black" />
              <!-- Table row -->
              <div class="row">
			  @foreach($datos as $det)
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                    <div class="form-group" align="center">
						<label for="proveedor" align="center"><small><b>COD#{{$det->codigo}}</b></small></label> </br>
					    <label for="proveedor"><?php if (strlen($det->nombre)>20){echo $det->nombre; }else{ echo $det->nombre."</br>&nbsp;";}?></label></br>
					    <label for="proveedor"> <?php if ($det->imagen==""){?> <img src="{{ asset('/imagenes/articulos/ninguna.jpg')}}" alt="{{$det->nombre}}" height="100px" width="100px" class="img-circle sombra"><?php }else{ ?><img src="{{ asset('/img/articulos/'.$det->imagen)}}" alt="{{$det->nombre}}" height="250px" width="250px" class="img-circle bordeimagen"><?php } ?> </label></br>
						<label for="proveedor"> <u>{{$det->precio1}} $</u></label>
                    </div>
				</div>  
				@endforeach	
				</div>
        <hr size="2px" color="black" />
                     <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 pie">
					   <label>Usuario: </label>  {{ Auth::user()->name }}  
                    <div class="form-group" align="center">
                     <button type="button" id="imprimir" class="btn btn-primary btn-sm" data-dismiss="modal">Imprimir</button> 
                    </div>
                </div>
                   
<!-- /.box-body -->

</div><!-- /.box -->
             

@push ('scripts')
<script>
$(document).ready(function(){
    $('#imprimir').click(function(){
  document.getElementById('imprimir').style.display="none";
  window.print(); 
  window.location="{{route('catalogo')}}";
    });

});

</script>

@endpush
@endsection