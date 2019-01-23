@extends('layouts.app')

@section('content')

<main role="main" class="ml-sm-auto col-lg-12 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Padres</h1>
        </div>
        <div class="alert alert-success" id="alerta-success" hidden="">
	        <button onclick="cerrarAlertas()" type="button" class="close" aria-hidden="true">&times;</button>
	        <h4><i class="icon fa fa-check"></i> Exito</h4>
	        <h5 id="mensaje_alerta"></h5>
        </div>
        <div class="alert alert-warning" id="alerta-error" hidden="">
            <button onclick="cerrarAlertas()" type="button" class="close" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-times"></i> Error</h4>
            <h5 id="mensaje_alerta2"></h5>
        </div>
        <div style="padding-bottom: 1rem; align-content: left;">
        <button class="btn btn-primary" data-title="Nuevo" onclick="mostrarModalNuevo(this)"  >
            Nuevo
            </button>
        </div>
        
        <div class="table-responsive">
        
            @if ($padres->isEmpty())
            <div>No hay Padres</div>
            @else
            <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
            <thead>
				<tr>
					<th>Nombre</th>
					<th>Tipo</th>
                    <th>Actual</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
					@foreach ($padres as $padre)
					<tr id="tr{{ $padre->id }}" data-id="{{ $padre->id }}|{{ $padre->nombre }}|{{ $padre->apellido }}|{{ $padre->esObispo }}|{{ $padre->padreActual }}">
						<td>{{ $padre->nombre }} {{ $padre->apellido }}</td>
						<td>@if ($padre->esObispo) Obispo @else Padre @endif</td>
                        <td>@if ($padre->padreActual) Sí @else - @endif</td>
                        <td>
                            <button class="btn btn-primary btn-xs" onclick="mostrarModal(this)" id="btn{{ $padre->id }}"  >
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            @if (!$padre->padreActual)
                            <button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" >
                                <i class="fas fa-trash-alt" ></i>
                            </button>
                            @endif
                        </td>
					</tr>
					@endforeach
			</tbody>
			<tfoot>
            <tr>
					<th>Nombre</th>
					<th>Tipo</th>
                    <th>Actual</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</tfoot>
            </table>
            @endif
          </div>
        </main>

        <!-- Modal Crear -->
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true" >
        <form method="POST" id="frmNuevo" action="{{ route('padres_crear') }}" class="form-horizontal">
		  @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Nuevo Padre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txtNombre" class="col-md-4 col-form-label text-md-right"><strong>Nombre:</strong></label>
                            <div class="col-sm-6">
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control" onkeyup="validarCrear()">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtApellido" class="col-md-4 col-form-label text-md-right"><strong>Apellido:</strong></label>
                            <div class="col-sm-6">
                                <input type="text" id="txtApellido" name="txtApellido" class="form-control" onkeyup="validarCrear()">
                                <div class="invalid-feedback">Apellido no válido</div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="esObispoN" class="col-md-4 text-md-right"><strong>Tipo:</strong></label>
                            <div class="col-sm-3">
                                <input type="radio" id="padreN" name="esObispoN" class="radiobox" value="padre" checked> Padre
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" id="obispoN" name="esObispoN" class="radiobox" value="obispo"> Obispo<br><br>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-6">
                                <input type="checkbox" id="padreActualN" name="padreActualN" class="checkbox" value="true"> Padre Actual<br><br>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnGuardar" class="btn btn-primary btn-lg" >Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Modal Editar -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
        <form method="POST" id="frmMod" action="{{ route('padres_editar') }}" class="form-horizontal">
		  @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Editar Padre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txtNombre" class="col-md-4 col-form-label text-md-right"><strong>Nombre:</strong></label>
                            <div class="col-sm-6">
                                <input type="text" name="txtEditarCodigo" id="txtEditarCodigo" hidden>
                                <input type="text" id="txtEditarNombre" name="txtEditarNombre" class="form-control" onkeyup="validarEditar()">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtApellido" class="col-md-4 col-form-label text-md-right"><strong>Apellido:</strong></label>
                            <div class="col-sm-6">
                                <input type="text" id="txtEditarApellido" name="txtEditarApellido" class="form-control" onkeyup="validarEditar()">
                                <div class="invalid-feedback">Apellido no válido</div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="esObispo" class="col-md-4 text-md-right"><strong>Tipo:</strong></label>
                            <div class="col-sm-3">
                                <input type="radio" id="padre" name="esObispo" class="radiobox" value="padre"> Padre
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" id="obispo" name="esObispo" class="radiobox" value="obispo"> Obispo <br><br>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-6">
                                <input type="checkbox" id="padreActual" name="padreActual" class="checkbox" value="true"> Padre Actual <br><br>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnModificar" class="btn btn-primary btn-lg">Actualizar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Modal Eliminar-->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <form method="POST" id="frmEliminar" action="{{ route('padres_eliminar') }}" class="form-horizontal">
		  @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Eliminar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" id=alerta-danger>
                                    <span class="glyphicon glyphicon-warning-sign"></span> Esta seguro de querer eliminar el Padre <strong><label id="txtEliminarNombre"></label></strong>?
                                </div>
                                <input type="text" name="txtEliminarCodigo" id="txtEliminarCodigo" hidden>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success" id="btnEliminar"><span class="glyphicon glyphicon-ok-sign"></span>Si</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div> 
                    </div>
                    </form>
                </div>



        <script type="text/javascript">
		
		function desplazoArriba(){
	        $("html, body").animate({ scrollTop: 0 }, "slow");
    	}

        window.onload=function(){
			/*$('.alert .close').on('click', function(e) {
    			$(this).parent().hide();
			});*/

            document.getElementById('btnGuardar').disabled = true;
		}
        
        function cerrarAlertas(){
            $(".alert").prop("hidden", true);
        }

        //Validaciones
        function validarNom(nom) {
        if(nom == ""){
            return false;
        }
        else{
            var regex = /(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)/;
            return regex.test(nom);
        }
        }
        function validaciones(nombre, apellido){
            var estado = false;
            estado = (validarNom(nombre) && validarNom(apellido))
            return estado;
        }
        //Validacion de formulario Crear
        function validarCrear() {
        var nombre=document.getElementById('txtNombre').value;
        var apellido = document.getElementById('txtApellido').value;
        if (!validarNom(nombre)){
            document.getElementById('txtNombre').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtNombre').className = "form-control";
        }
        if (!validarNom(apellido)){
            document.getElementById('txtApellido').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtApellido').className = "form-control";
        }
        
        var esValido = validaciones(nombre, apellido);
        document.getElementById('btnGuardar').disabled = !esValido;
        }

        //Validacion de formulario Editar
        function validarEditar() {
        var nombre=document.getElementById('txtEditarNombre').value;
        var apellido = document.getElementById('txtEditarApellido').value;
        if (!validarNom(nombre)){
            document.getElementById('txtEditarNombre').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtEditarNombre').className = "form-control";
        }
        if (!validarNom(apellido)){
            document.getElementById('txtEditarApellido').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtEditarApellido').className = "form-control";
        }
        
        var esValido = validaciones(nombre, apellido);
        document.getElementById('btnModificar').disabled = !esValido;
        }

		function mostrarModal(button){
			$("#edit").modal();
            var datosFila = $(button).closest('tr').data('id')
            document.getElementById('txtEditarCodigo').value = datosFila.split('|')[0];
            document.getElementById('txtEditarNombre').value = datosFila.split('|')[1];
            document.getElementById('txtEditarApellido').value = datosFila.split('|')[2];
            if (datosFila.split('|')[3]){
                document.getElementById('obispo').checked=true;
            }
            else{
                document.getElementById('padre').checked = true;
            }
            if (datosFila.split('|')[4]){
                document.getElementById('padreActual').checked=true;
                //document.getElementById('padreActual').disabled=true;
            }
            else{
                document.getElementById('padreActual').checked=false;
                //document.getElementById('padreActual').disabled=false;
            }
		}

        function mostrarModalEliminar(button){
			$("#delete").modal();
            $("#alerta-danger").prop("hidden", false);
            var datosFila = $(button).closest('tr').data('id')
            document.getElementById('txtEliminarCodigo').value = datosFila.split('|')[0];
            document.getElementById('txtEliminarNombre').innerHTML = datosFila.split('|')[1] + ' ' + datosFila.split('|')[2];
		}

        function mostrarModalNuevo(button){
			$("#create").modal();
		}

		$(document).ready(function(){
			$('#btnGuardar').click(function(e){
				e.preventDefault();
				var form = $("#frmNuevo");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        $("#create").modal("toggle");

                        if (result.tipo){
                            var tipo='<td>Obispo</td>';
                            }
                        else{
                            var tipo='<td>Padre</td>';
                            }
                        if (result.actual){
                            var actual= '<td>Sí</td>';
                            var eliminar='<td></td>';
                            }
                        else{
                            var actual='<td>-</td>';
                            var eliminar='<td><button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" ><i class="fas fa-trash-alt" ></i></button></td>';
                            }
						
                        var tabla = $("#datatable").DataTable();
                        if (result.codigo != result.codigoAnterior && result.actual){
                            celda = tabla.cell(tabla.row('#tr' + result.codigoAnterior), 2);
                            if (result.actualAnterior){
                                celda.data('Sí');
                            }
                            else{
                                celda.data('-');
                            }
                            celda = tabla.cell(tabla.row('#tr' + result.codigoAnterior), 4);
                            if (result.actualAnterior){
                                celda.data('');
                            }
                            else{
                                celda.data('<button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" ><i class="fas fa-trash-alt" ></i></button>');
                            }
                            var dataid = result.codigoAnterior + '|' + result.nombreAnterior + '|' + result.apellidoAnterior + '|' + result.tipoAnterior + '|' + result.actualAnterior;
                            $("#tr" + result.codigoAnterior).data("id",dataid);
                        }
						var nodo=tabla.row.add([
							result.nombre + ' '+ result.apellido,
							tipo,
                            actual,
							'<td><button class="btn btn-primary btn-xs" onclick="mostrarModal(this)" id="btn'+ result.codigo +'"  ><i class="fas fa-edit"></i></button></td>',
							eliminar
						]).node();

                        $(nodo).attr("id", 'tr' + result.codigo);

                        var dataid = result.codigo + '|' + result.nombre + '|' + result.apellido + '|' + result.tipo + '|' + result.actual;
                        
                        $(nodo).data("id", dataid);
                        tabla.draw(false);
                        desplazoArriba();
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#create").modal("toggle");
                        desplazoArriba();
						console.log(result.responseText);
					}
				});	
			});

			$('#btnModificar').click(function(e){
				e.preventDefault();
				var form = $("#frmMod");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
                        $("#alerta-success").prop("hidden", false);
						$("#edit").modal("toggle");

						var tabla = $("#datatable").DataTable();
						celda = tabla.cell(tabla.row('#tr' + result.codigo), 0);
						celda.data(result.nombre + ' ' + result.apellido);
                        celda = tabla.cell(tabla.row('#tr' + result.codigo), 1);
						if (result.tipo){
                            celda.data('Obispo');
                        }
                        else{
                            celda.data('Padre');
                        }
                        celda = tabla.cell(tabla.row('#tr' + result.codigo), 2);
						if (result.actual){
                            celda.data('Sí');
                        }
                        else{
                            celda.data('-');
                        }
                        celda = tabla.cell(tabla.row('#tr' + result.codigo), 4);
						if (result.actual){
                            celda.data('');
                        }
                        else{
                            celda.data('<button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" ><i class="fas fa-trash-alt" ></i></button>');
                        }
                        var dataid = result.codigo + '|' + result.nombre + '|' + result.apellido + '|' + result.tipo + '|' + result.actual;
                        $("#tr" + result.codigo).data("id",dataid);

                        if (result.codigo != result.codigoAnterior && result.actual){
                            celda = tabla.cell(tabla.row('#tr' + result.codigoAnterior), 2);
                            if (result.actualAnterior){
                                celda.data('Sí');
                            }
                            else{
                                celda.data('-');
                            }
                            celda = tabla.cell(tabla.row('#tr' + result.codigoAnterior), 4);
                            if (result.actualAnterior){
                                celda.data('');
                            }
                            else{
                                celda.data('<button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" ><i class="fas fa-trash-alt" ></i></button>');
                            }
                            var dataidAnterior = result.codigoAnterior + '|' + result.nombreAnterior + '|' + result.apellidoAnterior + '|' + result.tipoAnterior + '|' + result.actualAnterior;
                            $("#tr" + result.codigoAnterior).data("id",dataidAnterior);
                        }

						desplazoArriba();
						tabla.draw();
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#edit").modal("toggle");
						desplazoArriba();
						console.log(result.responseText);
					}
				});	
			});

            $('#btnEliminar').click(function(e){
				e.preventDefault();
				var form = $("#frmEliminar");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        $("#delete").modal("toggle");
                        var tabla = $("#datatable").DataTable();
                        var fila=tabla.row('#tr' + result.codigo);
                        fila.remove();
                        tabla.draw();
                        desplazoArriba();
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#delete").modal("toggle");
                        desplazoArriba();
						console.log(result.responseText);
					}
				});	
			});

		});

	</script>

@endsection