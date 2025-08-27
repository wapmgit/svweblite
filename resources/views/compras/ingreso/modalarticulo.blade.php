<div class="modal fade modal-slide-in-right"  aria-hidden="true"
role="dialog" tabindex="-1" id="modalarticuloid">
<?php
$ceros=5;
function add_ceros($numero,$ceros) {
  $numero=$numero+1;
$digitos=strlen($numero);
  $recibo="";
  for ($i=0;$i<5-$digitos;$i++){
    $recibo=$recibo."0";
  }
return $insertar_ceros = $recibo.$numero;
};
$idv=0;

?>  
        <form action="{{route('almacenaarticulo')}}" id="formarticulo" method="POST" enctype="multipart/form-data" >         
        {{csrf_field()}}
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-primary">
		<div class="modal-primary">
			    <div class="modal-header ">
                     <h5 class="modal-title">Registrar Nuevo Articulo</h5>
					 <input type="hidden" name="cnt" id="cnt" value="<?php if($cnt<>NULL){ echo add_ceros($cnt->idarticulo,$ceros);}else{echo add_ceros(1,$ceros); } ?>"></input>
				     <button type="button" class="close" data-dismiss="modal" 
			        	aria-label="Close">
                     <span aria-hidden="true">×</span>
                      </button>
                 
			    </div>
	    	</div>
			<div class="modal-body">

        <div class="row">
            	<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nombre</label>
            			<input type="text" name="nombre" id="nombre" onchange="conMayusculas(this)" required value="" class="form-control" placeholder="Nombre...">
            		</div>
            	</div>
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
            	 <div class="form-group">
            			<label >Categoria</label>
            			<select name="idcategoria" id="idcategoria" class="form-control">
            				@foreach ($categorias as $cat)
            				<option value="{{$cat->idcategoria}}_{{$cat->licor}}">{{$cat->nombre}}</option>
            				@endforeach
            			</select>
            		</div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label for="codigo">Codigo</label><i class="fa fa-fw fa-exchange" title="Generar Codigo" id="generar"></i>
            			<input type="text" name="codigo" id="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo...">
            		</div>
            </div>
 			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label for="stock">Stock</label>
            			<input type="text" name="stock" required value="0"  class="form-control" disabled >
            		</div>
            </div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label for="stock">Unidad </label>                           
            		<select name="unidad" class="form-control">          			            			
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

                 <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                 <div class="form-group">
                              <label for="costo">Costo</label>
                              <input type="text" value="" name="costo"  class="form-control" id="costo" placeholder="Costo">
                 </div>         </div>
                  <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                 <div class="form-group">
                              <label for="impuesto">Impuesto</label>
                              <input type="text" value="" placeholder="impuesto" name="impuesto" id="impuesto"  class="form-control">
                 </div>         </div>
                 
                    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                   <div class="form-group">
                              <label for="utilidad">Utilidad 1</label>
                              <input type="text" name="utilidad" id="utilidad"  class="form-control" value="" placeholder="% Utilidad">
                        </div>
                        </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6">
                        <div class="form-group">
                              <label for="precio1">Precio 1</label>
                              <input type="text" name="precio1" id="precio1"  class="form-control" value="" placeholder=" precio">
                              <input type="hidden" name="idempresa"  class="form-control" value="{{$empresa->idempresa}}">
                 </div> 
                 </div>
                        
            </div> 

	
			</div>

			<div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-outline-light"  id="Nenviar">Confirmar</button>
            </div>
			</div>
			
		</div>
	
</form>
</div>
   @push('scripts')
      <script>
$(document).ready(function(){
	
document.getElementById('Nenviar').style.display="none";
$("#costo").change(calculo); 
$("#costo").change(calculo2); 
$("#utilidad").change(calculo); 
$("#impuesto").change(calculo); 
$("#util2").change(calculo2); 
$("#precio1").change(reverso); 
$("#nombre").change(revisar); 
//$("#codigo").change(activar); 
      $("#codigo").on("change",function(){
		  var nuevo=$("#codigo").val();
			var pin2=nuevo.replace('-','/');
			$("#codigo").val(pin2);
         var form2= $('#formarticulo');
        var url2 = '{{route("validarcodigo")}}';
        var data2 = form2.serialize();
    $.post(url2,data2,function(result2){  
      var resultado2=result2;
         console.log(resultado2); 
         rows=resultado2.length; 
      if (rows > 0){
            var nombre=resultado2[0].nombre;
          var codigo=resultado2[0].codigo; 
          var descripcion=resultado2[0].descripcion;   
          alert ('Codigo ya existe!!, Nombre: '+nombre+' Codigo: '+codigo);   
           $("#codigo").val("");
           $("#codigo").focus();
}    else {
	 document.getElementById('Nenviar').style.display="";
}

          });
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
var cntregistro=0;

      function calculo(){ 
//        alert('so');
       $("#precio1").val("");
      var  p1 =0;
      var costo= $("#costo").val();
      var impuesto= $("#impuesto").val();
      var utilidad= $("#utilidad").val();
        p1=parseFloat((utilidad/100));
        p2=parseFloat(costo) + parseFloat(p1*costo);
        iva=p2*(impuesto/100);
        pt=(parseFloat(p2)+parseFloat(iva));
      $("#precio1").val(pt);
if (costo!="" && impuesto != "" && utilidad!=""){
	 document.getElementById('Nenviar').style.display="";
}
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
      $("#precio2").val(pt);
if (costo!="" && impuesto != "" && utilidad!=""){
	 document.getElementById('Nenviar').style.display="";
}
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
	$("#generar").on("click",function(){
		var dato=document.getElementById('idcategoria').value.split('_');
			if(cntregistro==0){
			idc=dato[0];
			cat=$("#cnt").val();
			$("#codigo").val('00'+idc+'00'+cat);
			cntregistro++;}
			else{
			idc=dato[0]; 		
			cat=$("#cnt").val(); 
			ncod=(parseFloat(cat)+parseFloat(cntregistro));
			var str = ncod.toString();
			var cad1 = str.padStart(5, "0");
			$("#codigo").val('00'+idc+'00'+cad1);
			cntregistro++;
			}
	});

	    function conMayusculas(field) {
            field.value = field.value.toUpperCase()
}
    </script>
      @endpush


      
  
