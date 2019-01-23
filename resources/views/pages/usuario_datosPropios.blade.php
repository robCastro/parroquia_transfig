@extends('layouts.app')

@section('content')
<main role="main" class="ml-sm-auto col-lg-12 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3border-bottom">
            <h1 style="padding-left:5%" class="h2">Usuario</h1>
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
        <div style="padding-top: 3%; padding-left: 15%; padding-bottom: 2%;">
            <table width="55%" cellpadding="10" id="datos">
                <tr>
                    <td style="width:25%"><strong>Nombre:</strong></td>
                    <td id="celdaNombre" style="width:55%">{{ $usuario->name }}</td>
                    <td style="width:20%">
                    	<button class="btn btn-info btn-xs btnEditar" type="button" onclick="mostrarModalNombre(this)">
                            <i class="fas fa-edit" ></i>
                        </button>
                   	</td>
                </tr>
                <tr>
                    <td><strong>Usuario:</strong></td>
                    <td id="celdaUsuario">{{ $usuario->username }}</td>
                    <td>
                    	<button class="btn btn-info btn-xs btnEditar" type="button" onclick="mostrarModalUsuario(this)">
                            <i class="fas fa-edit" ></i>
                        </button>
                   	</td>
                </tr>
 				<tr>
                    <td></td>
                </tr>
            </table>
            <div style="padding-top: 3%; padding-left: 1%;">
            <button class="btn btn-info btn-xs btnEditar" type="button" onclick="mostrarModalContrasenia(this)">
                Cambiar Contraseña  <i class="fas fa-edit" ></i>
            </button>
            </div>
        </div>  
</main>

<!-- Modal Cambiar Nombre -->
        <div class="modal fade" id="cambiarNombre" tabindex="-1" role="dialog" aria-labelledby="cambiarNombre" aria-hidden="true" >
        <form method="POST" id="frmCambiarNombre" action="{{ route('miusuario_editarNombre') }}" class="form-horizontal">
		  @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Cambiar Nombre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txtNombre" class="col-md-3 col-form-label text-md-right"><strong>Nombre:</strong></label>
                            <div class="col-sm-8">
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{$usuario->name}}" onkeyup="validarCambiarNombre()">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtContraseniaNombre" class="col-md-3 col-form-label text-md-right"><strong>Contraseña:</strong></label>
                            <div class="col-sm-8">
                                <input type="password" id="txtContraseniaNombre" name="txtContraseniaNombre" class="form-control" onkeyup="validarCambiarNombre()">
                                <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnCambiarNombre" class="btn btn-primary btn-lg">Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

<!-- Modal Cambiar Usuario -->
        <div class="modal fade" id="cambiarUsuario" tabindex="-1" role="dialog" aria-labelledby="cambiarUsuario" aria-hidden="true" >
        <form method="POST" id="frmCambiarUsuario" action="{{ route('miusuario_editarUsuario') }}" class="form-horizontal">
		  @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Cambiar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txtNombre" class="col-md-4 col-form-label text-md-right"><strong>Usuario:</strong></label>
                            <div class="col-sm-6">
                                <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" value="{{$usuario->username}}" onkeyup="validarCambiarUsuario()">
                                <div class="invalid-feedback">Usuario no válido</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtContraseniaUsuario" class="col-md-4 col-form-label text-md-right"><strong>Contraseña:</strong></label>
                            <div class="col-sm-6">
                                <input type="password" id="txtContraseniaUsuario" name="txtContraseniaUsuario" class="form-control" onkeyup="validarCambiarUsuario()">
                                <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnCambiarUsuario" class="btn btn-primary btn-lg">Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

<!-- Modal Cambiar Contraseña -->
        <div class="modal fade" id="cambiarContrasenia" tabindex="-1" role="dialog" aria-labelledby="cambiarContrasenia" aria-hidden="true" >
        <form method="POST" id="frmCambiarContrasenia" action="{{ route('miusuario_editarContrasenia') }}" class="form-horizontal">
		  @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Cambiar Contraseña</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="txtContraseniaActual" class="col-md-4 col-form-label text-md-right"><strong>Actual:</strong></label>
                            <div class="col-sm-6">
                                <input type="password" id="txtContraseniaActual" name="txtContraseniaActual" class="form-control" onkeyup="validarCambiarContrasenia()">
                                <div class="invalid-feedback">Campo obligatorio</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtContraseniaNueva" class="col-md-4 col-form-label text-md-right"><strong>Nueva:</strong></label>
                            <div class="col-sm-6">
                                <input type="password" id="txtContraseniaNueva" name="txtContraseniaNueva" class="form-control" onkeyup="validarCambiarContrasenia()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtContraseniaRepetir" class="col-md-4 col-form-label text-md-right"><strong>Repetir</strong></label>
                            <div class="col-sm-6">
                                <input type="password" id="txtContraseniaRepetir" name="txtContraseniaRepetir" class="form-control" onkeyup="validarCambiarContrasenia()">
                                <div class="invalid-feedback">Las contraseñas no coinciden</div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnCambiarContrasenia" class="btn btn-primary btn-lg">Guardar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>


<script type="text/javascript">
		
		function desplazoArriba(){
	        $("html, body").animate({ scrollTop: 0 }, "slow");
    	}
        
        function cerrarAlertas(){
            $(".alert").prop("hidden", true);
        }

        window.onload=function(){
            document.getElementById('btnCambiarNombre').disabled = true;
            document.getElementById('btnCambiarUsuario').disabled = true;
            document.getElementById('btnCambiarContrasenia').disabled = true;
		}

        function mostrarModalNombre(button){
			$("#cambiarNombre").modal();
			document.getElementById('txtContraseniaNombre').value = "";
		}
		function mostrarModalUsuario(button){
			$("#cambiarUsuario").modal();
			document.getElementById('txtContraseniaUsuario').value = "";
		}
		function mostrarModalContrasenia(button){
			$("#cambiarContrasenia").modal();
			document.getElementById('txtContraseniaActual').value = "";
			document.getElementById('txtContraseniaNueva').value = "";
			document.getElementById('txtContraseniaRepetir').value = "";
		}

		//Validaciones
        function validarNom(nom) {
        if(nom == ""){
            return false;
        }
        else{
            var regex = /(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)/;
            return regex.test(nom);
        }
        }
        function validaciones(nombre,contrasenia){
            var estado = false;
            estado = (validarNom(nombre) && contrasenia!= "")
            return estado;
        }
        //Validacion de formulario Cambiar Nombre
        function validarCambiarNombre() {
        var nombre=document.getElementById('txtNombre').value;
        var contrasenia=document.getElementById('txtContraseniaNombre').value;
        if (!validarNom(nombre)){
            document.getElementById('txtNombre').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtNombre').className = "form-control";
        }
        if (contrasenia==""){
            document.getElementById('txtContraseniaNombre').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtContraseniaNombre').className = "form-control";
        }
        
        var esValido = validaciones(nombre,contrasenia);
        document.getElementById('btnCambiarNombre').disabled = !esValido;
        }

        //Validacion de formulario Cambiar Usuario
        function validarCambiarUsuario() {
        var usuario=document.getElementById('txtUsuario').value;
        var contrasenia=document.getElementById('txtContraseniaUsuario').value;
        if (usuario==""){
            document.getElementById('txtUsuario').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtUsuario').className = "form-control";
        }
        if (contrasenia==""){
            document.getElementById('txtContraseniaUsuario').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtContraseniaUsuario').className = "form-control";
        }
        
        var esValido = (usuario!="" && contrasenia!= "");
        document.getElementById('btnCambiarUsuario').disabled = !esValido;
        }


        //Validacion de formulario Cambiar Contraseña
        function validarCambiarContrasenia() {
        var contraseniaActual=document.getElementById('txtContraseniaActual').value;
        var contraseniaNueva=document.getElementById('txtContraseniaNueva').value;
        var contraseniaRepetir=document.getElementById('txtContraseniaRepetir').value;
        if (contraseniaActual==""){
            document.getElementById('txtContraseniaActual').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtContraseniaActual').className = "form-control";
        }
        if (contraseniaNueva!=contraseniaRepetir){
            document.getElementById('txtContraseniaRepetir').className = "form-control is-invalid";
        }
        else{
            document.getElementById('txtContraseniaRepetir').className = "form-control";
        }
        
        var esValido = (contraseniaActual!="" && contraseniaNueva==contraseniaRepetir);
        document.getElementById('btnCambiarContrasenia').disabled = !esValido;
        }


		$(document).ready(function(){

			$('#btnCambiarNombre').click(function(e){
				e.preventDefault();
				var form = $("#frmCambiarNombre");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        $("#cambiarNombre").modal("toggle");
                        desplazoArriba();
                        document.getElementById('txtNombre').value=result.nombre;
                        document.getElementById('celdaNombre').innerHTML=result.nombre;
                        document.getElementById('navbarDropdown').innerHTML=result.nombre;
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#cambiarNombre").modal("toggle");
                        desplazoArriba();
					}
				});	
			});


			$('#btnCambiarUsuario').click(function(e){
				e.preventDefault();
				var form = $("#frmCambiarUsuario");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        $("#cambiarUsuario").modal("toggle");
                        desplazoArriba();
                        document.getElementById('txtUsuario').value=result.usuario;
                        document.getElementById('celdaUsuario').innerHTML=result.usuario;
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#cambiarUsuario").modal("toggle");
                        desplazoArriba();
					}
				});	
			});

			$('#btnCambiarContrasenia').click(function(e){
				e.preventDefault();
				var form = $("#frmCambiarContrasenia");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        $("#cambiarContrasenia").modal("toggle");
                        desplazoArriba();
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        $("#cambiarContrasenia").modal("toggle");
                        desplazoArriba();
					}
				});	
			});

		});

</script>

@endsection