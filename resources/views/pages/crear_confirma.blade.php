@extends('layouts.app')

@section('content')

    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" @if (!$persona) hidden @endif>
            <h1 class="h2">Confirma de {{ $persona->nombre }} {{ $persona->apellido }}</h1>
        </div>
        
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


        <div style="padding-top: 2%; padding-left: 3%" id="divForm">
            <form id="nuevaPersona" method="post">
                @csrf
                <table width="70%" cellpadding="5">
                    <tr>
                        <div class="form-group">
                            <th><label for="txtFecha"><strong>Fecha:</strong></label></th>
                            <td colspan="6"><input class="form-control" type="date" id="txtFecha"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="slcObispo"><strong>Obispo:</strong></label></th>
                            <td colspan="6">
                                <select class="form-control" id="slcObispo">
                                    <option selected disabled>
                                    --Seleccionar--
                                    </option>
                                    @foreach ($obispos as $obispo)                            
                                        <option value="{{ $obispo->id}}">
                                            {{ $obispo->nombre }} {{ $obispo->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="txtUbicacion"><strong>Ubicación:</strong></label></th>
                            <td>
                                <label for="txtLibro"><strong>Libro:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtLibro">
                            </td>
                            <td>
                                <label for="txtActa"><strong>Acta:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtActa">
                            </td>
                            <td>
                                <label for="txtPagina"><strong>Pagina:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtPagina">
                            </td>
                        </div>
                    </tr>
                </table>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3">Padrinos</h1>
                </div>
                <table  width="70%" cellpadding="5">
                    <tr>
                        <div class="form-group">
                            <th><label for="txtNombre"><strong>Nombre:</strong></label></th>
                            <td colspan="6"><input class="form-control" type="text" id="txtNombre"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="txtApellido"><strong>Apellido:</strong></label></th>
                            <td colspan="6"><input class="form-control" type="text" id="txtApellido"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="radioMasculino"><strong>Sexo:</strong></label></th>
                            <td colspan="6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sexo" id="radioMasculino" value="Masculino" checked>
                                        Masculino
                                    </label>
                                    <label>
                                        <input type="radio" name="sexo" id="radioFemenino" value="Femenino">
                                        Femenino
                                    </label>
                                </div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <th></th>
                        <td colspan="6" style="float: right;">
                            <button type="submit" id="btnAgregar" class="btn botonAdd btn-primary"><i class="fas fa-plus" ></i></button>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Sexo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr id="" data-target="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-danger btn-xs btnEliminar" type="button" id="delete-{{ $persona->id }}">
                                    <i class="fas fa-minus" ></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="padding-top: 5%; padding-left: 50%">
                    <table>
                        <tr>
                            <td>
                                <button type="submit" id="btnGuardar" class="btn boton btn-primary">Guardar</button>
                            </td>
                            <td>
                                <button type="button" onclick="window.location.href = '{{ url ('detalle_persona', $persona->id) }}';" class="btn btn-block btn-danger btn-flat">Cancelar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </main>    

    <script type="text/javascript">
        
        function cerrarAlertas(){
            $(".alert").prop("hidden", true);
        }

        /*$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });*/

        $(document).ready(function(){
            $("#btnAgregar").click(function(e){
                e.preventDefault();
                $(".botonAdd").prop("disabled", true);
                $.ajax({
                    type: 'POST',
                    url: '{{ url ('padrinos_confirma') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        nombre : $("#txtNombre").val(),
                        apellido : $("#txtApellido").val(),
                        sexo : $("#radioMasculino").prop("checked"),
                        tipoGuardado : $(this).attr('id'),
                    },
                    success : function(response){
                        if(response.includes("Nuevo id:")){
                            var url_confirma = "{{ url('crear_confirma') }}";
                            url_confirma = url_confirma + "/" + response.split(":")[1];
                            window.location = url_confirma;
                        }
                        else{
                            $("#btnAgregar").prop("disabled", false);
                            $("#msjExito").text(response);
                            $("#alertExito").prop("hidden", false);
                        }
                        
                    },
                    error: function(response){
                        $("#btnAgregar").prop("disabled", false);
                        $("#msjError").text(response.responseText);
                        $("#alertError").prop("hidden", false);
                    },
                });
            });
        });
    </script>

@endsection