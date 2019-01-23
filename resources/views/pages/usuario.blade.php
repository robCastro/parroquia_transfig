@extends('layouts.app')

@section('content')
    
    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        @if(Session::has('success'))
        <div class="alert alert-success" id="success-alert" style="padding-top: 1rem;">
            {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger" id="danger-alert" style="padding-top: 1rem;">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
        @endif

        <!-- Alerta error -->
        <div class="alert alert-danger alert-dismissible" hidden="" id="alertError">
            <button type="button" onclick="cerrarAlertas()" class="close" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            <strong id="msjError"></strong>
        </div>
        <!-- Alerta exito -->
        <div class="alert alert-success alert-dismissible" hidden="" id="alertExito">
            <button  onclick="cerrarAlertas()" type="button" class="close" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Exito!</h4>
            <strong id="msjExito"></strong>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Asistentes</h1>
        </div>
        <div style="padding-bottom: 1rem; align-content: left;">
            <button class="btn btn-primary btn-xs" data-title="Create" data-toggle="modal" data-backdrop="static" data-target="#create">Nuevo</button>
        </div>

        <div class="table-responsive">
            @if ($users->isEmpty())
                <div>No hay Usuarios</div>
            @else
                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Cambiar Contraseña</th>                      
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Cambiar Contraseña</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach($users as $user)
                    <tr id="tr{{ $user->id }}" data-id="{{ $user->id }}|{{ $user->name }}|{{ $user->username }}|{{ $user->email }}">
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <button class="btn btn-secondary btn-xs" id="btn{{ $user->id }}" data-toggle="modal" data-target="#editPass">
                                <i class="fas fa-key"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-info btn-xs" onclick="mostrarModal(this)" id="btn{{ $user->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-xs btnEliminar" onclick="mostrarModalEliminar(this)">
                                <i class="fas fa-trash-alt" ></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach 

                </tbody>
            </table>
            @endif
          </div>
        </main>
        
    <!-- modal-dialog CREAR--> 
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title custom_align" id="Heading">Crear Asistente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ url('asistente_crear') }}">
                        
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Usuario:</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal-dialog EDITAR--> 
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <form method="POST" id="frmEdit" action="{{ route('asistente_editar') }}" class="form-horizontal">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Editar Asistente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nameEdit" class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <div class="col-md-6">
                                <input type="text" name="idEdit" id="idEdit" hidden>
                                <input id="nameEdit" type="text" name="nameEdit" class="form-control" onkeyup="validarEditar()">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usernameEdit" class="col-md-4 col-form-label text-md-right">Usuario:</label>

                            <div class="col-md-6">
                                <input id="usernameEdit" type="text" name="usernameEdit" class="form-control" onkeyup="validarEditar()">
                            <div class="invalid-feedback"> Usuario no válido </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailEdit" class="col-md-4 col-form-label text-md-right">Email:</label>

                            <div class="col-md-6">
                                <input id="emailEdit" type="email" name="emailEdit" class="form-control" onkeyup="validarEditar()">
                                <div class="invalid-feedback">Email no válido</div>
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

    <!-- modal-dialog EDITAR PASS--> 
    <div class="modal fade" id="editPass" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <form method="GET" id="frmEditPass" class="form-horizontal">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Editar Contraseña</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="passwordEdit" class="col-md-4 col-form-label text-md-right">Contraseña:</label>

                            <div class="col-md-6">
                                <input type="text" name="idEditPass" id="idEditPass" value="{{$user->id}}" hidden>
                                <input id="passwordEdit" type="password" class="form-control{{ $errors->has('passwordEdit') ? ' is-invalid' : '' }}" name="passwordEdit" required>

                                @if ($errors->has('passwordEdit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passwordEdit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirmEdit" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password-confirmEdit" type="password" class="form-control" name="password_confirmationEdit" required>
                            </div>
                        </div>

                        <div class="modal-footer ">
                            <button type="button" id="btnModificarPass" onclick="mostrarModalPass()" class="btn btn-primary btn-lg">Cambiar Contraseña</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>     
    </div>

    <!-- modal-dialog ELIMINAR--> 
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <form method="POST" id="frmEliminar" action="{{ route('asistente_eliminar') }}" class="form-horizontal">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Eliminar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-warning-sign"></span> Esta seguro de querer eliminar el Asistente <strong><label id="nameDelete"></label></strong>?
                        </div>
                        <input type="text" name="idDelete" id="idDelete" hidden>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="btnEliminar"><span class="glyphicon glyphicon-ok-sign"></span>Si</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
        function validarEmail(mail) {
            if(mail == ""){
                return false;
            }
            else{
                var regex = /(^[a-z._0-9].+@.+$)/i;
                return regex.test(mail);
            }
        }
        function validaciones(name, username, email, password){
            var estado = false;
            estado = (validarNom(name) && validarNom(username) && validarEmail(email) && validarNom(password))
            return estado;
        }

        //Validacion de formulario Editar
        function validarEditar() {
            var name=document.getElementById('nameEdit').value;
            var username = document.getElementById('usernameEdit').value;
            var email = document.getElementById('emailEdit').value;

            if (!validarNom(name)){
                document.getElementById('nameEdit').className = "form-control is-invalid";
            }
            else{
                document.getElementById('nameEdit').className = "form-control";
            }
            if (!validarNom(username)){
                document.getElementById('usernameEdit').className = "form-control is-invalid";
            }
            else{
                document.getElementById('usernameEdit').className = "form-control";
            }
            if (!validarEmail(email)){
                document.getElementById('emailEdit').className = "form-control is-invalid";
            }
            else{
                document.getElementById('emailEdit').className = "form-control";
            }

            var esValido = validaciones(name, username, email);
            document.getElementById('btnModificar').disabled = !esValido;
        }

        function validarEditarPass() {
            var password = document.getElementById('passwordEdit').value;

            if (!validarNom(password)){
                document.getElementById('passwordEdit').className = "form-control is-invalid";
            }
            else{
                document.getElementById('passwordEdit').className = "form-control";
            }

            var esValido = validaciones(password);
            document.getElementById('btnModificarPass').disabled = !esValido;
        }

        function mostrarModal(button){
            $("#edit").modal();
            var datosFila = $(button).closest('tr').data('id')
            document.getElementById('idEdit').value = datosFila.split('|')[0];
            document.getElementById('nameEdit').value = datosFila.split('|')[1];
            document.getElementById('usernameEdit').value = datosFila.split('|')[2];
            document.getElementById('emailEdit').value = datosFila.split('|')[3];
            /*if (datosFila.split('|')[3] == true ){
                document.getElementById('obispo').checked=true;
            }
            else{
                document.getElementById('padre').checked = true;
            }*/
        }

        function mostrarModalEliminar(button){
            $("#delete").modal();
            var datosFila = $(button).closest('tr').data('id')
            document.getElementById('idDelete').value = datosFila.split('|')[0];
            document.getElementById('nameDelete').innerHTML = datosFila.split('|')[1]
        }

        function mostrarModalPass(){
            $("#editPass").modal();
            $("#btnModificarPass").prop("disabled", true);
            var id = $("#idEditPass").val();
            var password = $("#passwordEdit").val();
            var confirm = $("#password-confirmEdit").val();
            //console.log(id, password)
            if (password == confirm) {
                $.ajax({
                
                    url: "{{ url ('asistente_editPass') }}",
                    type: "GET",
                    data: 
                    {   
                        "_token": "{{ csrf_token() }}",
                        'id' : id,
                        'password': password,
                    },

                    success : function(response){
                        $("#editPass").modal("hide");
                        $("#msjExito").text("Contraseña cambiada");
                        $("#alertExito").prop("hidden", false);
                        desplazoArriba();
                        $("#btnModificarPass").prop("disabled", false);

                        console.log("exito");
                     },
                    error: function(err){
                        $("#editPass").modal("hide");
                        $("#msjError").text(err.responseText);
                        $("#alertError").prop("hidden", false);
                        $(".btn").prop("disabled", false);
                        console.log("error");
                    },
                });
            }else{
                desplazoArriba();
                $("#msjError").text("contraseñas no coinciden");
                $("#alertError").prop("hidden", false);
                $("#btnModificarPass").prop("disabled", false);
                return;                
            }


        }

    </script>

@endsection