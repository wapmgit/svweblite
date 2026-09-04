@extends ('layouts.master')
@section ('contenido')
<?php 
$acum = 0; 
$ceros = 5; 
$acumnc = 0;

function add_ceros($numero, $ceros) {
    $digitos = strlen($numero);
    $recibo = "";
    for ($i = 0; $i < 8 - $digitos; $i++) {
        $recibo .= "0";
    }
    return $recibo . $numero;
}
$cntser = 0;
?>

<style type="text/css">
    hr {
        height: 1px;
        background-color: black;
        margin: 2px auto;
    }

    .separador-corte {
        border-top: 1px dashed #000;
        margin: 4px 0;
        text-align: center;
        position: relative;
    }

    .separador-corte span {
        background: #fff;
        padding: 0 5px;
        position: relative;
        top: -8px;
        font-size: 9px;
    }

    /* ESTILOS EXCLUSIVOS PARA IMPRESIÓN */
    @media print {
        @page {
            size: letter portrait; /* Forzar tamaño Carta en vertical */
            margin: 0.3cm;         /* Margen exterior mínimo */
        }

        /* Ocultar elementos de la interfaz */
        .no-print, .main-footer, .main-header, .main-sidebar, .btn, .navbar, nav {
            display: none !important;
        }

        html, body {
            height: 100% !important;
            max-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
            font-size: 9.5px !important;
            overflow: hidden !important;
        }

        /* Contenedor principal rígido */
        #area-impresion {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            height: 98vh !important; /* Llena casi la totalidad de la hoja */
            max-height: 98vh !important;
            box-sizing: border-box !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        /* Cada una de las 2 copias */
        .copia-recibo {
            height: 48% !important; /* Ocupa exactamente la mitad disponible */
            max-height: 48% !important;
            overflow: hidden !important; /* Evita desbordamiento que cree pag 2 */
            box-sizing: border-box !important;
            padding: 2px 5px !important;
        }

        /* Compactar encabezados y márgenes internos */
        .copia-recibo h4, .copia-recibo h6 {
            font-size: 11px !important;
            margin-bottom: 2px !important;
        }

        .copia-recibo p {
            margin-bottom: 2px !important;
        }

        /* Compactar tablas */
        .copia-recibo table {
            font-size: 9px !important;
            width: 100% !important;
        }

        .copia-recibo th, .copia-recibo td {
            padding: 1px 3px !important; /* Muy compacto para ahorrar espacio vertical */
            line-height: 1.1 !important;
        }

        .separador-corte {
            display: block !important;
            margin: 2px 0 !important;
        }
    }
</style>
</style>

<div class="invoice p-3 mb-3" id="area-impresion">
    
    {{-- BUCLE DE 2 VUELTAS: ORIGINAL Y COPIA --}}
    @for ($copia = 1; $copia <= $empresa->ncopias; $copia++)
    <div class="copia-recibo">
        
        <!-- Identificador de copia -->
        <div class="row">
            <div class="col-12">
                <small class="float-right"><b>{{ $copia == 1 ? 'ORIGINAL' : 'COPIA' }}</b></small>
                <h4>
                    <img src="{{asset('dist/img/iconosistema.png')}}" title="NKS" width="24"> SysVent@s
                </h4>
            </div>
        </div>

        <!-- Info empresa -->
        <div class="row invoice-info">
            @include('ventas.venta.empresa')
        </div>

        <!-- Info cliente -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<table width="100%" border="1"  style="line-height:90%">
	<tr><td><small><b>DOCUMENTO:</small></b>{{$venta->tipo_comprobante}} {{$venta->serie_comprobante}} <?php  $idv=$venta->num_comprobante;; echo add_ceros($idv,$ceros); ?></td><td><td><small><b>FECHA DE EMISION: </small></b><?php echo date("d-m-Y",strtotime($venta->fecha_hora)); ?></td><td><small><b>CONDICION: </small></b>{{$venta->estado}}@if($venta->estado == "Credito") {{$venta->diascredito}}Dias  @endif</td></tr>
	<tr><td colspan="4"><small><b>NOMBRE Y APELLIDO O RAZON SOCIAL: </b> </small> {{$venta->rif}} -> {{$venta->nombre}} <b>TELF: </b> {{$venta->telefono}}</td></tr>
	<tr><td colspan="4"  width="50%"><small><b>DOMICILIO FISCAL: </b> {{$venta->direccion}} </small><b>VENDEDOR: </b> {{$venta->vendedor}}@if($venta->obs != NULL)<b>Obs.:</b> {{$venta->obs}}   @endif</td></tr>
	</table>
            </div>
        </div>

        <!-- Detalles de la venta -->
        <div class="row">
            <div class="col-md-12">
                <table id="detalles" width="100%"  style="line-height:93%">
                    <thead style="background-color: #A9D0F5"> 
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        @foreach($detalles as $det)
                            @if ($det->cantidad > 0)
                            <tr>
                                <td>{{$det->articulo}}</td>
                                <td>{{$det->cantidad}}</td>
                                <td>{{$det->unidad}}</td>
                                <td><?php echo number_format($det->precio_venta, 2, ',', '.'); ?></td>
                                <td><?php echo number_format(($det->cantidad * $det->precio_venta), 2, ',', '.'); ?></td>
                            </tr>
                            @endif
                        @endforeach

                        @if($venta->descuento > 0)
                            <tr>
                                <td colspan="3"></td>
                                <td>Descto.</td>
                                <td>-{{$venta->descuento}}</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot> 
                        <tr>
                            <th colspan="4" class="text-right">TOTAL:</th>
                            <th><b><font size="3"><?php echo " $ " . number_format($venta->total_venta, 2, ',', '.'); ?></font></b></th>
                        </tr>
                    </tfoot> 
                </table>
                <hr>
            </div> 

            <!-- Desglose de Pago -->
            @if(count($recibos) > 0)
            <div class="col-6">
                <h6 align="center">Desglose de pago</h6>
                <table width="100%"  style="line-height:80%">
                    <thead style="background-color: #A9D0F5"> 
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Tasa</th>
                        <th>Monto$</th>
                        <th>Ref.</th> 
                    </thead> 
                    <tbody> 
                        <?php $acum_copia = 0; ?>
                        @foreach($recibos as $re) 
                            <?php $acum_copia += $re->monto; ?>
                            <tr>
                                <td>{{$re->idbanco}}</td>
                                <td><?php echo number_format($re->recibido, 2, ',', '.'); ?></td>
                                <td>
                                    <?php 
                                        if ($re->idpago == 2) { echo number_format($re->tasap, 2, ',', '.'); }
                                        if ($re->idpago == 3) { echo number_format($re->tasab, 2, ',', '.'); }
                                    ?>
                                </td>
                                <td><?php echo number_format($re->monto, 2, ',', '.'); ?></td>
                                <td>{{$re->referencia}}</td> 
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot> 
                        <tr>
                            <th colspan="3">Total</th>
                            <th><?php echo "$ " . number_format($acum_copia, 2, ',', '.'); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </div>

    <!-- Línea divisoria de corte solo entre la 1ra y 2da copia -->
    @if($copia == 1)
        <div class="separador-corte no-print">
          
        </div>
    @endif

    @endfor

    <!-- BOTONERA (Oculta al imprimir) -->
    <input type="hidden" name="ruta" id="ruta" value="<?php echo ($ruta == 1) ? 'ventas' : 'edocuenta/' . $venta->id_cliente; ?>">
    
    <div class="row no-print mt-3">
        @if(Auth::user()->nivel == "A")
            <div class="col-12 text-center">
                <button type="button" id="regresar" class="btn btn-danger btn-sm">Regresar</button>
                <button type="button" id="nventa" class="btn btn-info btn-sm">Facturar</button>
                <button type="button" id="imprimir" class="btn btn-primary btn-sm">Imprimir</button>
            </div> 
        @else
            <div class="col-12 text-center">
                <button type="button" id="regresarvc" class="btn btn-danger btn-sm">Regresar</button>
                <button type="button" id="nventavc" class="btn btn-info btn-sm">Facturar</button> 
                <button type="button" id="imprimirvc" class="btn btn-primary btn-sm">Imprimir</button>
            </div> 
        @endif
    </div>
</div>

@push ('scripts')
<script>
$(document).ready(function(){
    
    function ejecutarImpresion() {
        // Ejecutar diálogo de impresión de navegador
        window.print();
        
        // Redireccionar al terminar
        var ruta = $('#ruta').val();
        window.location.href = "/" + ruta;
    }

    $('#imprimir, #imprimirvc').click(function(){
        ejecutarImpresion();
    });

    $('#regresar, #regresarvc').on("click", function(){
        var ruta = $('#ruta').val();
        window.location.href = "/" + ruta;
    });

    $('#nventa, #nventavc').on("click", function(){
        window.location.href = "/newventa";
    });
});
</script>
@endpush
@endsection