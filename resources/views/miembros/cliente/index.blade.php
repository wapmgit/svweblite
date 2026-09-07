@extends ('layouts.master')
@section ('contenido')
@include('clientes.cliente.empresa')
<?php $fserver=date('Y-m-d'); ?>
<div class="row" id="principal">
    <!-- Se usará col-6 para celulares y col-lg-6 para pantallas grandes -->
    <div class="col-6 col-lg-6">
        <h3>Miembros  
            @if($rol->newcliente==1)
                <a href="{{route('newregistro')}}">
                    <button class="btn btn-primary btn-sm"> Nuevo</button>
                </a>
            @endif
        </h3>
    </div>
    
    <div class="col-6 col-lg-6 text-right">
	<a href="" data-target="#modaldebito" data-toggle="modal"><button class="btn btn-success btn-xs">Eventual</button></a>
    </div>
    @include('miembros.cliente.modaldebito')
    <div class="col-12">
        @include('miembros.cliente.search')
    </div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="clientestable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<th>Ultimo Pago</th>
					<th>Opciones</th>
				</thead>
               @foreach ($pacientes as $cat)
				<tr>
					<td><small> {{ $cat->cedula}} {{ $cat->nombre}}</small></td>
					<td><small>{{ $cat->codpais}}{{ $cat->telefono}}</small></td>
					<td><small><small> <?php echo substr( $cat->direccion, 0, 20 ); ?></small></small></td>
					<td><?php if($cat->ult_pago==NULL){ echo "Sin Registro"; }else{  echo date("d-m-Y",strtotime($cat->ult_pago));} ?></td>
					<td>
					<a href="{{route('editmiembro',['id'=>$cat->id_cliente])}}"><button class="btn btn-warning btn-xs">Editar</button></a>
					
				<a href="{{route('edomienbro',['id'=>$cat->idmiembro])}}"><button class="btn btn-success btn-xs">Cuenta</button></a>	
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$pacientes->render()}}
	</div>
</div>
@push ('scripts')
<script>
$(document).ready(function(){
		document.getElementById('bt_pago').style.display="none";
		document.getElementById('procesa').style.display="none";
			$("#pidpago").change(mediopago);
	const cuerpoDelDocumento = document.body;
	cuerpoDelDocumento.onload = miFuncion;
	function miFuncion() {
		// alert('La página terminó de cargar');
  	document.getElementById('imgcarga').style.display="none"; 
	document.getElementById('principal').style.display=""; 
	} 

	$("#btn").click(function(){
		document.getElementById('imgcarga').style.display=""; 
		document.getElementById('principal').style.display="none"; 
	})
	
	$(function () {
    $("#clientestable").DataTable({
		"searching": true,
		"bPaginate": false,
		"bInfo":false,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#clientestable_wrapper .col-md-6:eq(0)');

  });
  	$('#bt_pago').click(function(){
			agregarpago();
			});   
  $('#hrs').change(function(){
			calcular();
			});
 $('#mnt').change(function(){
			calcular();
			}); 		
	$('#pasapago').click(function(){
			datosbanco=$("#pidpago").val();
			if(datosbanco==100){
			alert('¡Debe seleccionar un tipo de Pago!');}
			else{ $("#pmonto").val($("#resta").val());
			document.getElementById('bt_pago').style.display=""; 
			$("#preferencia").focus();}
		})	
		$('#btnregresar').click(function(){	
			pagototal=0;	 
			$("#resta").val(1); $("#divtotal").val(1);
			$("#total_abono").text("0.0");
			$("#tdeuda").val(0);
			$("#total").val(0);
			$("#totala").val(0);
				for(var i=0;i<10;i++){
				$("#filapago" + i).remove(); acumpago[i]=0; }
		})		
});
	function calcular(){
        var hr=$("#hrs").val();
        var mt=$("#mnt").val();
		var   tcobro=(parseFloat(hr)*parseFloat(mt));
		$("#resta").val(tcobro);  
		$("#divtotal").val(tcobro);
	
    }
	// calculo pago
	function mediopago(){
	    document.getElementById('bt_pago').style.display="";		
	   var pesoresta =$("#resta").val();  
       var pesototal =$("#divtotal").val();
	   var tabono=$("#totala").val();
	   var debe=(pesototal-tabono);
	     moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		  tipom=tm[1];
		  valort=tm[2];
		   //alert(tipom);
		   	if (tipom==0){   
				$("#resta").val((pesototal-tabono).toFixed(2));  
				}  
			if (tipom==1){ 
				$("#resta").val((debe*valort).toFixed(2)); 
				$("#preferencia").val('Tc: '+valort);  				
			}
			if (tipom==2){   
				$("#resta").val((debe/valort).toFixed(2));  
				$("#preferencia").val('Tc: '+valort);  
				}  				
		t_pago=$("#pidpago").val();
		 $("#hrs").attr("readonly",true);
       $("#mnt").attr("readonly",true);
    }
		acumpago=[];var contp=0; var tresta=0; var pagototal=0;
	function agregarpago(){ 	
        vresta=$("#resta").val();    
		idpago=$("#pidpago").val();
        tpago= $("#pidpago option:selected").text();
        pmonto= $("#pmonto").val();
        pref= $("#preferencia").val();
	
			moneda= $("#pidpago").val();
		 tm=moneda.split('_');
		  tipom=tm[1];
		  valort=tm[2];
		  	idpago=tm[0];
 
		if(parseFloat(pmonto)<=parseFloat(vresta)){
			  var tdoc=$("#tipodoc").val();
		var denomina=pmonto;
			acumpago[contp]=(pmonto);
			if (tipom==1){ 
			    var pesoresta =$("#resta").val();   
					$("#total_abono").text(pagototal/valort);
				    denomina=parseFloat(pmonto).toFixed(2);
					pmonto=(parseFloat(pmonto)/parseFloat(valort));		
					acumpago[contp]=(pmonto.toFixed(2)); 
			}  
				if (tipom==2){ 
			    var pesoresta =$("#resta").val();   
				$("#resta").val(pesoresta*valort);  
				$("#total_abono").text(pagototal*valort);
				    denomina=parseFloat(pmonto).toFixed(2);
					pmonto=(parseFloat(pmonto)*parseFloat(valort));		
					acumpago[contp]=(pmonto.toFixed(2)); 
			} 
        pagototal=parseFloat(pagototal)+parseFloat(acumpago[contp]); 
		//salert(pagototal);
        tventa=$("#divtotal").val();
        tresta=(parseFloat(tventa)-parseFloat(pagototal));
            $("#resta").val(tresta.toFixed(2));
            $("#tdeuda").val(tresta.toFixed(2));	
            var fila='<tr  id="filapago'+contp+'"><td align="center"><span onclick="eliminarpago('+contp+');"><i class="fa fa-fw fa-eraser"></i></span></td><td><input type="hidden" name="tidpago[]" value="'+idpago+'"><input type="hidden" name="tidbanco[]" value="'+tpago+'">'+tpago+'</td><td><input type="hidden" name="denominacion[]" value="'+denomina+'">'+denomina+'</td><td><input type="hidden" name="tmonto[]" value="'+pmonto+'">'+pmonto.toLocaleString('de-DE', { style: 'decimal',  decimal: '2' })+'</td><td><input type="hidden" name="tref[]" value="'+pref+'">'+pref+'</td></tr>';
            contp++;
            document.getElementById('bt_pago').style.display="none";
			document.getElementById('procesa').style.display="";
			$("#pidpago").val('100');
			$("#total_abono").text(pagototal.toFixed(2));
			$("#totala").val(pagototal.toFixed(2));
			limpiarpago();		 
             $('#det_pago').append(fila);
			
		}else{ alert('¡El monto indicado no debe se mayor al saldo pendiente!');
		limpiarpago();		}
	}
	function limpiarpago(){
        $("#pmonto").val("");
        $("#preferencia").val("");
    }
	function eliminarpago(index){
		$("#pidpago").val('100');
        total=acumpago[index];
		tventa=$("#divtotal").val();
        var1=$("#total_abono").text();
		resta=parseFloat(tventa)-parseFloat(var1);
		//alert(var1);
        nv=(parseFloat(resta)+parseFloat(total));
        nc=(parseFloat(var1)-parseFloat(total));
        $("#resta").val(nv.toFixed(2));   
        $("#tdeuda").val(nv.toFixed(2));  
        $("#totala").val(nc.toFixed(2));
		pagototal=(parseFloat(pagototal)-parseFloat(total));
        $("#filapago" + index).remove();
        $("#total_abono").text(nc.toFixed(2));
			limpiarpago();
			if(nc==0){
			document.getElementById('procesa').style.display="none";	
			}
    }
</script>
@endpush
@endsection