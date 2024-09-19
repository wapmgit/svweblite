@extends ('layouts.master')
@section ('contenido')
<?php $acum=0; $acump=0;$cont=0;?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Detalles de Comisiones por Pagar</h3>
	</div>
</div>

<div class="row">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color: #A9D0F5">
					<th>#comision</th>
					<th>Vendedor</th>
					<th>Telefono</th>
					<th>monto Faturado</th>
					<th>Monto Comision</th>
					<th>Por Pagar</th>
					<th>Fecha cierre</th>
					<th>usuario</th>
					<th>Opcion</th>

									
				</thead>
               @foreach ($vendedor as $cat)
               <?php $cont++;
			   $link="A";
			       $acum=$acum+$cat->montocomision; 
				   $acump=$acump+$cat->pendiente; 
               ?>			   
				<tr>   
					<td>{{$cat->id_comision}}</td>
						<td>{{$cat->nombre}}</td>
							<td>{{$cat->telefono}}</td>
					<td><?php echo number_format($cat->montoventas, 3,',','.')." $"; ?> </td>
					<td><?php echo number_format($cat->montocomision, 3,',','.')." $"; ?> </td>
					<td><?php echo number_format($cat->pendiente, 3,',','.')." $"; ?> </td>
					<td><?php echo date("d-m-Y",strtotime($cat->fecha)); ?></td>
					<td>{{ $cat->usuario}}</td>
					<td>
	<a href="javascript:abrirespecialpago({{$cat->id_comision}},{{$cat->pendiente}},'{{$cat->nombre}}');"><button  id="abono" class="btn btn-warning btn-xs">Pagar</button></a>
	<?php if($cat->pendiente<$cat->montocomision){ ?>
	<a href="{{route('listarecibos',['id'=>$cat->id_comision.'_'.$link])}}"><button  id="" class="btn btn-info btn-xs">Ver Recibos</button></a>
	<?php
	}?>
	</td>		
				</tr>
				@endforeach
				<tr>
				<td><?php echo $cont." Comisiones"; ?></td><td colspan="2"></td><td><strong>TOTAL:</strong></td><td style="background-color: #A9D0F5"><?php echo number_format($acum, 3,',','.')." $"; ?></td><td style="background-color: #A9D0F5"><?php echo number_format($acump, 3,',','.')." $"; ?></td><td colspan="3"> </td>
				</tr>

			</table>

		</div>
		
	</div>
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="form-group" align="center">
					 <a href="{{route('comisiones')}}"><button  class="btn btn-danger btn-sm" type="button">Regresar</button></a>
                    </div>
                </div>

</div>	<form action="{{route('pagarcomision')}}" method="POST" id="otro" enctype="multipart/form-data" >         
        {{csrf_field()}}
 <div class ="row" id="divdesglose" style="display: none"> 	

				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3 align="center">ABONO/PAGO DE COMISIONES</h3>
                    </div>
      
				  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Vendedor</label>
                   <p><input type="text" name="nombre" readonly id="nombre" class="form-control" value=""></p>
                    </div>
            </div>
				  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Documento</label>
                   <p><input type="text" name="comision"  readonly  id="comision" class="form-control" value=""></p>
                    </div>
            </div>
				  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                 <div class="form-group">
                      <label for="proveedor">Monto Comision</label>
                   <p><input type="number" name="monto" id="monto" readonly   class="form-control" value=""></p>
                   <p><input type="hidden" name="montoreal" id="montoreal"   class="form-control" value=""></p>
                   <p><input type="hidden" name="banco" id="banco"   class="form-control" value=""></p>
                   <p><input type="hidden" name="total_abono" id="total_abono"   class="form-control" value=""></p>
                    </div>
            </div>  
										 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group">
					    <label for="proveedor">Moneda</label>
					<select name="pidpago" id="pidpago" class="form-control">
					<option value="100" selected="selected">Selecione...</option>
					@foreach ($monedas as $m)
					 <option value="{{$m-> idmoneda}}_{{$m->tipo}}_{{$m->valor}}">{{$m -> nombre}}</option> 
					@endforeach
					</select>
					</div>
				</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
                      <label for="proveedor">Observacion</label>
                   <p><input type="text" name="observacion" id="referencia" class="form-control" value=""></p>
                    </div>
			</div>
			  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="form-group">
                      <label for="proveedor">Monto a Cancelar</label>
                   <p><input type="number" step='0.01' name="pagado" id="pagado"  requered  min="0.01"  class="form-control" value=""></p>
                    </div>
                    </div>
		
					 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div align="center">
        <button type="button" class="btn btn-danger btn-sm" id="regresar" data-dismiss="modal">Cancelar</button>
        <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
	
        <button type="button" id="procesa" class="btn btn-primary btn-sm" style="display: none">Procesar</button>
      </div>
        </div>

 </div></form>
@endsection

@push ('scripts')

<script>
 $(document).ready(function(){

     $('#regresar').click(function(){
		 $("#pagado").val(0);
		$('#divdesglose').fadeOut("fast");
    });  
	   $("#pagado").on("change",function(){
			var mc=$("#monto").val();
		   var pg=$("#pagado").val();
		   if(pg>mc){
			   alert('El monto indicado es mayor al monto de la comision.');
			   $("#pagado").val("");
			   $("#pagado").focus();
		   }else{	 
		 
			moneda= $("#pidpago").val();
			tm=moneda.split('_');
			tipom=tm[1];
			valort=tm[2];
			idpago=tm[0];
			
			$("#banco").val(idpago);
			if(tipom==0){
					$("#total_abono").val(pg);
			}
		   	if (tipom==1){ 		
		  		
				$("#total_abono").val(pg/valort);					
			}  
				if (tipom==2){   
				$("#total_abono").val(pg*valort);
			}  
		   $('#procesa').fadeIn("fast"); 
		   }
    }); 
		   $("#monto").on("click",function(){
  $('#pagado').val($('#monto').val());
    $('#procesa').fadeIn("fast");
    }); 
		$("#pidpago").change(mediopago);
   });
 
function abrirespecialpago(idregistro,saldo,nombre){
		 //
   $('#divdesglose').fadeIn("fast");
   $('#nombre').val(nombre);
   $('#monto').val(saldo);
   $('#montoreal').val(saldo);
   $('#comision').val(idregistro);   
};
   $('#procesa').on("click",function(){
   
         var tv= $("#monto").val();
         var t1=$("#pagado").val();
		
		 if (t1==""){ alert ('Monto a pagar no pude ser vacio.'); return true;} 
		 if (t1==0){ alert ('Monto a pagar no pude ser 0.');return true; }		
       if (tv>t1){ alert ('Abono  Procesado con exito.');
		document.getElementById('otro').submit();
	   }
          if (tv==t1){ alert ('Pago Procesado con Exito.'); 
		  	document.getElementById('otro').submit();
		}
      });
	   function mediopago(){
		$("#monto").val($("#montoreal").val());     
		//   alert();	
var mcomip= $("#monto").val();  
	     moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		 var idmoneda=tipom=tm[0];
		  tipom=tm[1];
		  valort=tm[2];
		   moneda= $("#pidpago option:selected").text();
		   //alert(tipom);
		   	if (tipom==0){   
 				
				}  
			if (tipom==1){ 
				$("#monto").val((mcomip*valort).toFixed(2));  
				$("#referencia").val('Tc: '+valort);
			}
			if (tipom==2){   
				$("#monto").val((mcomip/valort).toFixed(2));  
				$("#referencia").val('Tc: '+valort); 
				}  
			//alert(mcomip);
		t_pago=$("#pidpago").val();	   
    }
</script>
@endpush