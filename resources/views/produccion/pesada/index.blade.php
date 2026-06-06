@extends ('layouts.master')
@section ('contenido')

 <!-- Main content -->

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
	<div class ="row">   

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#8CF5B0">
			<table width="100%">
			<tr><td colspan="2" align="center"><b>PESAJE</b></td></tr>
			<tr><td>
							
			<div class="small-box bg-green">
				<div class="inner">
					<h1 id="muestraitem" align="center"><sup style="font-size: 25px"><?php ?>Unds   0.00</sup></h1>
				</div>            
            </div>
					</td>
					<td>
					
			<div class="small-box bg-blue">
				<div class="inner">
					<h1 id="muestrakg" align="center"><sup style="font-size: 25px"><?php ?>Kg  0.00</sup></h1>
				</div>            
           
		</div>
				</td></tr>
			</table>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles_out"  width="100%">
                      <tbody>
					  <tr>
					  <tD>	<div class="form-group">
				<div class="input-group">
					<input type="number" class="form-control" id="cnt"  value="" placeholder="0">
				</div>
				</div></tD>
				<td><span class="input-group-btn">
						<button type="button" id="agg" class="btn btn-primary btn-sm">Agregar</button>
					</span></tD>
					  </tr></tbody>
            </table>
			</div>
		</div>
		</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="background-color:#C8F8EC" >
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
			<table id="detalles_in"  width="100%">
                      <thead style="background-color: #A9D0F5">
                          <th>Supr</th>
                          <th>Item</th>
                          <th>Peso</th>
                      </thead>
                      <tfoot> 
                      <th>Total</th>
                          <th></th>
                       
                          <th colspan="2" align="right"><h6 id="totalp">Kg 0.00</h6></th>
                          </tfoot>
                      <tbody></tbody>
            </table>
			</div>
		</div>
		</div>
    </div>
   </form>
       </div>                     	          	
@push ('scripts')
<script>
$(document).ready(function(){
	document.getElementById('cnt').addEventListener('keypress',function(e){ validarenter(e); });	
$("#cnt").focus();
   $('#agg').click(function(){  
		agregar();	
    });
});
var cont=0;
var total=0;
subtotal=[];
	function validarenter(e){
		let tecla = (document.all) ? e.keyCode : e.which;
		if(tecla==13) { 
		agregar();
	event.preventDefault();
	} }
	function agregar(){
        cantidad= $("#cnt").val();
        if (cantidad != ""  && cantidad > 0  ){
			subtotal[cont]=cantidad;
            total=parseFloat(total)+parseFloat(subtotal[cont]);
            
            var fila='<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-warning btn-xs" onclick="eliminar('+cont+');"><small>x</small></button></td><td>'+(cont+1)+'</td><td>'+cantidad+'</td></tr>';
            cont++;
            limpiar();
			auxtotal=(total*1).toFixed(2);
            $("#muestraitem").html("Unds : " + cont);
            $("#muestrakg").html("Kg : " + total);
            $("#totalp").html("Kg " + total);
            $('#detalles_in').append(fila);
        }
        else{
            alert("debe indicar Cantidad")
		 limpiar();
        }
    }
	function limpiar(){
        $("#cnt").val("");
		$("#cnt").focus();
      
    }
	 function eliminar(index){
        total=parseFloat(total)-parseFloat(subtotal[index]);
		cont--;
        $("#muestraitem").html("Unds : " + cont);
		$("#muestrakg").html("Kg : " + total);
		$("#totalp").html("Kg " + total);
        $("#fila" + index).remove();
        limpiar();

    }
</script>

@endpush
@endsection