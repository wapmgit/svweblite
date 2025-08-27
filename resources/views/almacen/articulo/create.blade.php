@extends ('layouts.master')
@section ('contenido')
<?php
$ceros=5; $cntcat=0;
function add_ceros($numero,$ceros) {
	$numero=$numero+1;
	$digitos=strlen($numero);
	$recibo="";
		for ($i=0;$i<5-$digitos;$i++){
			$recibo=$recibo."0";
		}
return $insertar_ceros = $recibo.$numero;
};
$cntcat=count($categorias);
$idv=0;
?>  
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Articulo</h3><?php if(count($categorias)==0){ echo "<P class='text-danger'><span class='text-danger'>¡ Debe Registrar Grupo de inventario !</span></p>";} ?>
			<input type="hidden" name="cnt" id="cnt" value="<?php if($cnt<>NULL){ echo add_ceros($cnt->idarticulo,$ceros);}else{echo add_ceros(0,$ceros); } ?>"></input>
			<input type="hidden" name="idempresa" id="idempresa" value="{{$idempresa}}"></input>
		</div>
	</div>
     <form action="{{route('guardararticulo')}}" method="POST" id="formulario" enctype="multipart/form-data" >         
        {{csrf_field()}}
        <div class="row">
            	<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nombre</label>
            			<input type="text" name="nombre" id="nombre" required value="{{old('nombre')}}" onchange="conMayusculas(this)" class="form-control" placeholder="Nombre...">
						@if($errors->first('nombre'))<P class='text-danger'>{{$errors->first('nombre')}}</p>@endif
					</div>
            	</div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label >Categoria</label><?php if ($cntcat=0){?><span class='text-danger'> <a href="{{route('newcategoria')}}">Debe Registrar Categoria¡¡ </a></span> <?php } ?>
            			<select name="idcategoria" id="idcategoria" class="form-control">
            				@foreach ($categorias as $cat)
            				<option value="{{$cat->idcategoria}}_{{$cat->licor}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>
            	       				
            		</div>
            </div>   
	   <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label for="codigo">Codigo</label> <i class="fa fa-fw fa-exchange" title="Generar Codigo" id="generar"></i>
            			<input type="text" name="codigo" id="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo...">
						@if($errors->first('codigo'))<P class='text-danger'>{{$errors->first('codigo')}}</p>@endif
					</div>
            </div>
			 				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            	 <div class="form-group">
            			<label for="stock">Unidad </label>                           
            		<select name="unidad" id="unidad" class="form-control">          			            			
            				<option value="UND">Unidad</option>
            				<option value="BTO">Bulto</option>
            				<option value="SCO">Saco</option>
            				<option value="CJA">Caja</option>
            				<option value="kg">Kg</option>
            				<option value="DISP">Display</option>
            				<option value="PR">Par</option>
            				<option value="LTR">Litros</option>           				
            			</select>
					</div>
            </div>

              <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            	 <div class="form-group">
            			<label for="imagen">Imagen</label>
            			<input type="file" name="imagen"  class="form-control">
            		</div>
            </div>
                 <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                 <div class="form-group">
                              <label for="costo">Costo</label>
                              <input type="number" min="0.01" step="0.01"  name="costo"   value="{{old('costo')}}" class="form-control" id="costo" placeholder="Costo">
						@if($errors->first('costo'))<P class='text-danger'>{{$errors->first('costo')}}</p>@endif
				</div>         </div>
               <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                 <div class="form-group">
                              <label for="impuesto">Impuesto</label>
                              <input type="text" value="{{old('impuesto')}}" placeholder="Impuesto" name="impuesto" id="impuesto"  class="form-control">
							@if($errors->first('impuesto'))<P class='text-danger'>{{$errors->first('impuesto')}}</p>@endif
						</div>         </div>
                 
                      <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                   <div class="form-group">
                              <label for="utilidad">Utilidad</label>
                              <input type="text" name="utilidad" id="utilidad" onchange="calculo();" class="form-control" value="{{old('utilidad')}}" placeholder="% Utilidad">
                        @if($errors->first('utilidad'))<P class='text-danger'>{{$errors->first('utilidad')}}</p>@endif
						</div>
                        </div>
             <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                        <div class="form-group">
                              <label for="precio1">Precio</label>
                              <input type="text" name="precio1" id="precio1"  class="form-control" value="{{old('precio1')}}" placeholder="Precio">
								@if($errors->first('precio1'))<P class='text-danger'>{{$errors->first('precio1')}}</p>@endif
						</div> 
                 </div>
                        
            </div> 
                   
          
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="center" <?php if ($cntcat=0){?>  style="display: none" <?php } ?>>
            	 <div class="form-group">
					<button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
				<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
			    <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>	
            		</div>
       

        
            </div>
            
            </form>	 	
            @push('scripts')
			<script>
$(document).ready(function(){
      $("#codigo").on("change",function(){
		  	var nuevo=$("#codigo").val();
			var pin2=nuevo.replace('-','/');
			//alert(pin2);
			$("#codigo").val(pin2);
         var form2= $('#formulario');
        var url2 = '{{route("validart")}}';
        var data2 = form2.serialize();
    $.post(url2,data2,function(result2){  
      var resultado2=result2;
	     existemp=resultado2[0].length;
         existe=resultado2[1].length;
         console.log(resultado2); 
      if (existemp > 0){
            var nombre=resultado2[0][0].nombre;
          var codigo=resultado2[0][0].codigo;   
          alert ('Codigo ya existe!!, Nombre: '+nombre+' Codigo: '+codigo);   
           $("#codigo").val("");
           $("#codigo").focus();
		}    
      if (existe > 0){
            var nombre=resultado2[1][0].nombre;
          var impuesto=resultado2[1][0].iva; 
          var unidad=resultado2[1][0].unidad; 
          var costo=resultado2[1][0].costo; 
          var util=resultado2[1][0].utilidad; 
          var precio=resultado2[1][0].precio1; 
			
           $("#nombre").val(nombre);
           $("#unidad").val(unidad);
           $("#impuesto").val(impuesto);
           $("#costo").val(costo);
		   $("#utilidad").val(util);
			$("#precio1").val(precio); 
		} 
          });
     });
      	 $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
		})
	$("#generar").on("click",function(){
		  dato=document.getElementById('idcategoria').value.split('_');
		idc=dato[0];
		cat=$("#cnt").val();
		emp=$("#idempresa").val();
		
		$("#codigo").val(emp+'0'+idc+'00'+cat);		
	});
		$("#idcategoria").on("change",function(){
		
	var dato=document.getElementById('idcategoria').value.split('_');	//alert(dato[1]);
	if(dato[1]==1){
		$("#volumen").removeAttr("disabled");  
		$("#grados").removeAttr("disabled"); 
	} else{
			$("#volumen").val(0);
			$("#grados").val(0);
		$("#volumen").attr("disabled","true"); ;  
		$("#grados").attr("disabled","true");  
	}		
	});
})
$("#utilidad").change(calculo);
$("#util2").change(calculo2);
$("#precio1").change(reverso); 
$("#nombre").change(revisar); 
$("#costo").change(actprecio); 
$("#impuesto").change(actprecio); 

		function actprecio(){
			var costo= $("#costo").val();
			var iva= $("#impuesto").val();   
			var util= $("#utilidad").val();   
			if (costo!="" && iva != "" && util!=""){
			    var putil=parseFloat((util/100));					
				var piva=(iva/100);							
				pneto=parseFloat(costo) + parseFloat(putil*costo);
				pf=parseFloat(pneto) + parseFloat(piva*pneto);			
				$("#precio1").val(pf.toFixed(2));
			}
		}
      function calculo(){
      $("#precio1").val("");
    	var  p1 =0;
    	var costo= $("#costo").val();
    	var impuesto= $("#impuesto").val();
    	var utilidad= $("#utilidad").val();
        p1=parseFloat((utilidad/100));
        p2=parseFloat(costo) + parseFloat(p1*costo);
        iva=p2*(impuesto/100);
        pt=(parseFloat(p2)+parseFloat(iva));
    	$("#precio1").val(pt.toFixed(2));
      }
      function calculo2(){
      $("#precio2").val("");
      var  p1 =0;
      var costo= $("#costo").val();
      var impuesto= $("#impuesto").val();
      var utilidad= $("#util2").val();
        p1=parseFloat((utilidad/100));
        p2=parseFloat(costo) + parseFloat(p1*costo);
        iva=p2*(impuesto/100);
        pt=(parseFloat(p2)+parseFloat(iva));
      $("#precio2").val(pt.toFixed(2));
      }	
        function reverso(){
        var  p30 =0;  
       p30= $("#precio1").val();
      var costo= $("#costo").val();
      var utilidad= $("#impuesto").val();       
    var    p31=parseFloat((utilidad/100));  
    var    p32=parseFloat(costo) + parseFloat(p31*costo);     
        iva=(p30/p32);
        var util=((iva-1)*100);
        pt=(parseFloat(util));
        var nv=(new Intl.NumberFormat("de-DE", {style:  "decimal", decimal: "2"}).format(pt));
  //      alert(nv);
      $("#utilidad").val(parseFloat(nv));
      }
	  function revisar(){
	var nuevo=$("#nombre").val();
	 var pin2=nuevo.replace('-','/');
	$("#nombre").val(pin2);
	  }
  function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}


 		</script>
			@endpush  
@endsection