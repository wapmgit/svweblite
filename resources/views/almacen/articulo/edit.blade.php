@extends ('layouts.master')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar articulo: {{ $articulo->nombre}}</h3>
						@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> @if (($articulo->imagen)!="")
                      <img src="{{asset('img/articulos/'.$articulo->imagen)}}" width="100" height="80">
                  @endif </div>
	</div>
	        <form action="{{route('updatearticulo')}}" id="formulario" method="POST" enctype="multipart/form-data" >       
        {{csrf_field()}}
 <div class="row">
            	<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            		 <div class="form-group">
            			<label for="nombre">Nombre</label>
            			<input type="text" name="nombre" onchange="conMayusculas(this)"  required value="{{$articulo->nombre}}" class="form-control" placeholder="Nombre...">
            		<input type="hidden" name="id"  value="{{$articulo->idarticulo}}" class="form-control">
					</div>
            	</div>
           <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            	 <div class="form-group">
            			<label >Categoria</label>
            			<select name="idcategoria" id="idcategoria" class="form-control selectpicker" data-live-search="true">
            				@foreach ($categorias as $cat)
            				@if ($cat->idcategoria == $articulo->idcategoria)
            				<option value="{{$cat->idcategoria}}_{{$cat->licor}}" selected >{{$cat->nombre}}</option>
            				@else
            				<option value="{{$cat->idcategoria}}_{{$cat->licor}}">{{$cat->nombre}}</option>
            				@endif
            				@endforeach
            			</select>
            			
            		</div>
            </div>
          <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			
            	 <div class="form-group">
            			<label for="codigo">Codigo</label>
            			<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control" placeholder="Codigo...">
            		</div>
            </div>
 			
			 				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
   	 <div class="form-group">
            			<label for="stock">Unidad </label>                  			
						<select name="unidad" class="form-control">          			            			
            				<option <?php if($articulo->unid=="UND"){ echo "selected"; } ?> value="UND">Unidad</option>
            				<option <?php if($articulo->unid=="BTO"){ echo "selected"; } ?> value="BTO">Bulto</option>
            				<option <?php if($articulo->unid=="SCO"){ echo "Selected"; } ?> value="SCO">Saco</option>
            				<option <?php if($articulo->unid=="CJA"){ echo "Selected"; } ?> value="CJA">Caja</option>
            				<option <?php if($articulo->unid=="KG"){ echo "selected"; } ?>  value="kG">Kg</option>
            				<option <?php if($articulo->unid=="DISP"){ echo "selected"; } ?> value="DISP">Display</option>
            				<option <?php if($articulo->unid=="PR"){ echo "selected"; } ?> value="PR">Par</option>
            				<option <?php if($articulo->unid=="LTR"){ echo "selected"; } ?>  value="LTR">Litros</option>		
            				<option <?php if($articulo->unid=="MTR"){ echo "selected"; } ?>  value="MTR">Metro</option>		
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
                              <input type="number"  name="costo"  class="form-control" id="costo" value="{{$articulo->costo}}" placeholder="costo">
                 </div>         </div>
                       <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                 <div class="form-group">
                              <label for="impuesto">Impuesto</label>
                              <input type="text" value="{{$articulo->iva}}" placeholder="impuesto" name="impuesto" id="impuesto"  class="form-control">
                 </div>         </div>
                 
                            <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                   <div class="form-group">
                              <label for="utilidad">Utilidad</label>
                              <input type="number" name="utilidad" id="utilidad" class="form-control" step="0.01" value="{{$articulo->utilidad}}" placeholder="% utilidad">
                        </div>
                        </div>
                  <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
                        <div class="form-group">
                              <label for="precio1">Precio</label>
                              <input type="text" name="precio1" id="precio1" step="0.01"   class="form-control" value="{{$articulo->precio1}}" placeholder=" precio $">
                 </div> 
                 </div>
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" align="center">
            	 <div class="form-group">
            		<button class="btn btn-primary btn-sm" type="button" id="btnguardar">Guardar</button>
            	       <button class="btn btn-danger btn-sm" type="reset" id="btncancelar">Cancelar</button>
					   <div style="display: none" id="loading">  <img src="{{asset('img/sistema/loading30.gif')}}"></div>
            		</div>
            </div>
           
            	</form>
            </div>
          

            
       @push('scripts')
      <script>
$(document).ready(function(){

$("#costo").change(calculo); 
$("#costo").change(calculo2); 
$("#utilidad").change(calculo); 
$("#impuesto").change(calculo); 
$("#util2").change(calculo2); 
$("#precio1").change(reverso); 
$("#precio2").change(reverso2); 
		 $('#btnguardar').click(function(){   
		document.getElementById('loading').style.display=""; 
		document.getElementById('btnguardar').style.display="none"; 
		document.getElementById('btncancelar').style.display="none"; 
		document.getElementById('formulario').submit(); 
		});
		$("#idcategoria").on("change",function(){	
	var dato=document.getElementById('idcategoria').value.split('_');	//alert(dato[1]);
	if(dato[1]==1){
		$("#volumen").removeAttr("disabled");  
		$("#grados").removeAttr("disabled"); 
	} else{
			$("#volumen").val(0);
			$("#grados").val(0);
		$("#volumen").attr("disabled","true");	
		$("#grados").attr("disabled","true");  
	}		
	});
})
	 $('#btncancelar').click(function(){  
	   window.location="{{route('articulos')}}";
	 })

function trunc (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)
}
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
		pt=trunc(pt,2);
      $("#precio1").val(pt);
 
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
		pt=trunc(pt,2);
      $("#precio2").val(pt);
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
      $("#utilidad").val(parseFloat(nv));
      }
        function reverso2(){
        var  p302 =0;  
       p302= $("#precio2").val();
      var costo= $("#costo").val();
      var utilidad= $("#impuesto").val();       
    var    p312=parseFloat((utilidad/100));  
    var    p322=parseFloat(costo) + parseFloat(p312*costo);     
        iva=(p302/p322);
        var util2=((iva-1)*100);
        pt2=(parseFloat(util2));
        var nv2=(new Intl.NumberFormat("de-DE", {style:  "decimal", decimal: "2"}).format(pt2));
  //      alert(nv);
  nv=trunc(nv,2)
      $("#util2").val(parseFloat(nv2));
      }
	function conMayusculas(field) {
            field.value = field.value.toUpperCase()
	}
    </script>
      @endpush
@endsection