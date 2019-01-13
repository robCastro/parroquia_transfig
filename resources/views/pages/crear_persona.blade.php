@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Registrar Persona</h1>
        </div>
        
        <div style="padding-top: 2%; padding-left: 30%" id="divForm">
            <form id="nuevaPersona" method="post">
                @csrf
                <table width="70%">
                    <tr>
                        <div class="form-group">
                            <td><label for="txtNombre"><strong>Nombre:</strong></label></td>
                            <td><input class="form-control" type="text" id="txtNombre"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtApellido"><strong>Apellido:</strong></label></td>
                            <td><input type="text" id="txtApellido"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtFechaNac"><strong>Fecha de Nacimiento:</strong></label></td>
                            <td><input type="date" id="txtFechaNac"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtPapa"><strong>Papá:</strong></label></td>
                            <td><input type="text" id="txtPapa"></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td><label for="txtMama"><strong>Mamá:</strong></label></td>
                            <td><input type="text" id="txtMama"></td>
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
                                <select id="slcPais" onchange="cambioPais()">
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
                                <select id="slcDepartamento">
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
                                <select id="slcMunicipio">
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
                                <button type="submit" id="btnGuardarR" class="btn btn-primary">Guardado Rapido</button>
                            </td>
                            <td>
                                <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Cancelar</button>
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

    $("#slcDepartamento").change(function(){
        console.log($("#slcDepartamento").val());
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
                console.log(response);
            }
        });
    });

    /*$('#cbxCarrera').change(function(){
        $("#cbxMaterias").prop("disabled", true);
        $("#btnNuevo").prop("disabled", true);
        $.ajax({
            type: 'get',
            url: '',
            data: {
                cbxCarrera : $("#cbxCarrera").val()
            },
            dataType : 'json',
            success: function(response){
                console.log(response);
                $('#cbxMaterias').empty();
                var i; 
                var cbxMaterias = document.getElementById('cbxMaterias');
                for (i = 0; i<response.materias.length; i++){
                    var opcion = document.createElement("option");
                    opcion.text = response.materias[i].nombre;
                    opcion.value = response.materias[i].id;
                    cbxMaterias.add(opcion);
                }
                $("#cbxMaterias").prop("disabled", false);
                $("#btnNuevo").prop("disabled", false);
            },
            error: function(response){
                console.log(response.responseText);
            }
        });
    });*/
</script>
@endsection