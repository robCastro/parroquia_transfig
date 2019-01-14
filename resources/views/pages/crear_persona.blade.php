@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Registrar Persona</h1>
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
                            <td><label for="txtNombre"><strong>Nombre:</strong></label></td>
                            <td><input class="form-control" type="text" id="txtNombre"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtApellido"><strong>Apellido:</strong></label></td>
                            <td><input class="form-control" type="text" id="txtApellido"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtFechaNac"><strong>Fecha de Nacimiento:</strong></label></td>
                            <td><input class="form-control" type="date" id="txtFechaNac"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtPapa"><strong>Papá:</strong></label></td>
                            <td><input class="form-control" type="text" id="txtPapa"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtMama"><strong>Mamá:</strong></label></td>
                            <td><input class="form-control" type="text" id="txtMama"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="radioMasculino"><strong>Sexo:</strong></label></td>
                            <td>
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
                        <div class="form-group">
                            <td><label for="slcPais"><strong>País:</strong></label></td>
                            <td>
                                <select class="form-control" id="slcPais" onchange="cambioPais()">
                                    @foreach ($paises as $pais)                            
                                        <option @if ($pais->id == 54) selected @endif value="{{ $pais->id }}">
                                            {{ $pais->pais }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr id="trDepartamento">
                        <div class="form-group">
                            <td><label for="slcDepartamento"><strong>Departamento:</strong></label></td>
                            <td>
                                <select class="form-control" id="slcDepartamento">
                                    @foreach ($departamentos as $departamento)                            
                                        <option @if ($departamento->id == 6) selected @endif value="{{ $departamento->id }}">
                                            {{ $departamento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr id="trMunicipio">
                        <div class="form-group">
                            <td><label for="slcMunicipio"><strong>Municipio:</strong></label></td>
                            <td>
                                <select class="form-control" id="slcMunicipio">
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio->id }}">
                                            {{ $municipio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </div>
                    </tr>
                </table>
                <div style="padding-top: 5%; padding-left: 50%">
                    <table>
                        <tr>
                            <td>
                                <button type="submit" id="btnGuardarR" class="btn boton btn-primary">Guardado Rapido</button>
                            </td>
                            <td>
                                <button type="submit" id="btnGuardar" class="btn boton btn-primary">Guardar</button>
                            </td>
                            <td>
                                <button type="button" onclick="window.location.href = '{{ url ('lista_personas') }}';" class="btn btn-block btn-default btn-flat">Cancelar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
<script>
    function cambioPais(){
        let trDepartamento = document.getElementById("trDepartamento");
        let trMunicipio = document.getElementById("trMunicipio");
        let codPais = document.getElementById("slcPais").value;
        trDepartamento.hidden = codPais != 54;
        trMunicipio.hidden = codPais != 54;
    }

    function cerrarAlertas(){
        $(".alert").prop("hidden", true);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#slcDepartamento").change(function(){
        $("#slcMunicipio").prop("disabled", true);
        $("#btnGuardarR").prop("disabled", true);
        $("#btnGuardar").prop("disabled", true);
        $.ajax({
            type: 'get',
            url: '{{ url ('filtrar_municipios') }}',
            data: {
                codDepartamento : $("#slcDepartamento").val(),
            },
            dataType: 'json',
            success : function(response){
                $('#slcMunicipio').empty();
                var i; 
                var slcMunicipio = document.getElementById('slcMunicipio');
                for (i = 0; i<response.municipios.length; i++){
                    var opcion = document.createElement("option");
                    opcion.text = response.municipios[i].nombre;
                    opcion.value = response.municipios[i].id;
                    slcMunicipio.add(opcion);
                }
                $("#slcMunicipio").prop("disabled", false);
                $("#btnGuardarR").prop("disabled", false);
                $("#btnGuardar").prop("disabled", false);
            },
            error: function(response){
                $("#msjError").text(response);
                $("#alertError").prop("hidden", false);
            }
        });
    });

    $(".boton").click(function(){
        $(".btn").prop("disabled", true);
        $.ajax({
            type: 'POST',
            url: '{{ url ('guardar_persona') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                nombre : $("#txtNombre").val(),
                apellido : $("#txtApellido").val(),
                fechaNac : $("#txtFechaNac").val(),
                papa : $("#txtPapa").val(),
                mama : $("#txtMama").val(),
                sexo : $("#radioMasculino").prop("checked"),
                pais : $("#slcPais").val(),
                municipio : $("#slcMunicipio").val(),
                tipoGuardado : $(this).attr('id'),
            },
            success : function(response){
                $(".btn").prop("disabled", false);
                $("#msjExito").text(response);
                $("#alertExito").prop("hidden", false);
            },
            error: function(response){
                $(".btn").prop("disabled", false);
                $("#msjError").text(response.responseText);
                $("#alertError").prop("hidden", false);
            },
        });
    });
</script>
@endsection