@extends('layouts.app')

@section('content')

    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Nuevo Matrimonio</h1>
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
            
            <table width="70%" cellpadding="10">
                <tr>
                    <div class="form-group">
                        <td><label for="txtNombre"><strong>Esposo:</strong></label></td>
                        <td>
                            <input class="form-control" type="text" id="txtEsposo">
                            <strong id="idEsposo" hidden=""></strong>
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label for="txtEsposa"><strong>Esposa:</strong></label></td>
                        <td>
                            <input class="form-control" type="text" id="txtEsposa">
                            <strong id="idEsposa" hidden=""></strong>
                        </td>

                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label for="txtFechaNac"><strong>Fecha:</strong></label></td>
                        <td><input class="form-control" type="date" id="txtFecha"></td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label for="txtPapa"><strong>Padre:</strong></label></td>
                        <td><select id="slcPadre" class="form-control">
                            @foreach ($padres as $padre)
                                <option value="{{ $padre->id }}" @if($padre->padreActual) selected @endif>
                                    {{ $padre->nombre }} {{ $padre->apellido }}
                                </option>
                            @endforeach
                        </select></td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label><strong>Ubicación:</strong></label></td>
                        <td>
                            <label for="txtLibro">Libro:</label>
                            <input type="text" id="txtLibro" name="txtLibro">
                            <label for="txtFolio">Folio:</label>
                            <input type="text" id="txtFolio" name="txtFolio">
                        </td>
                    </div>
                </tr>
            </table>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h3">Padrinos</h1>
            </div>
            
            <table cellpadding="10" width="70%">
                <tr>
                    <div class="form-group">
                        <td><label for="txtNombre"><strong>Nombre:</strong></label></td>
                        <td><input type="text" name="txtNombre" id="txtNombre" class="form-control"></td>
                        <td></td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label for="txtApellido"><strong>Apellido:</strong></label></td>
                        <td><input type="text" name="txtApellido" id="txtApellido" class="form-control"></td>
                        <td></td>
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
                        <td>
                            <button id="btnAgregar" class="btn btn-primary">Agregar</button>
                        </td>
                    </div>
                </tr>
            </table>
            <div style="padding-top: 5%;">
                <table id="datatable">
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Sexo</th>
                        <th></th>
                    </thead>
                </table>
            </div>  
            <div style="padding-top: 5%; padding-left: 80%">
                <table cellpadding="10">
                    <tr>
                        <td>
                            <button type="submit" id="btnGuardar" class="btn boton btn-primary">Guardar</button>
                        </td>
                        <td>
                            <button type="button" onclick="window.location.href = '{{ url ('lista_personas') }}';" class="btn btn-block btn-default btn-flat">Cancelar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


    <!-- modal save -->
    <div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="save" aria-hidden="true">
        <form method="post" id="frmGuardar">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title custom_align" id="Heading">Guardar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <div>
                        <span class="glyphicon glyphicon-warning-sign"></span> <strong id="msjModal"></strong>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" id="btnDelete" ><span class="glyphicon glyphicon-ok-sign"></span>Si</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content --> 
        </div>
        </form>
        <!-- /.modal-dialog --> 
    </div>
<script>

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


    $( "#txtEsposo" ).autocomplete({
        source: function(request, response){
            $("#btnGuardar").prop("disabled", true);
            $.getJSON("{{ url('hombres_no_casados') }}", {
                term : request.term,
                sexo : "M",
            }
            , response);
        },
        minLength: 3,
        delay: 500,
        select : function(event, ui){
            $("#txtEsposo").val(ui.item.label);
            $("#idEsposo").text(ui.item.value);
            $("#btnGuardar").prop("disabled", false);
            //Return false por la documentacion, no sé realmente para que sirve
            return false;
        },
        response: function(event, ui){
            if(ui.content.length == 0){
                $("#msjError").text("No hay registros que corresponde a la busqueda.");
                $("#alertError").prop("hidden", false);
            }
            else{
                $("#alertError").prop("hidden", true);
            }
        },
        search: function(event, ui){
            $("#idEsposo").text("");
        },
    });

    $( "#txtEsposa" ).autocomplete({
        source: function(request, response){
            $("#btnGuardar").prop("disabled", true);
            $.getJSON("{{ url('hombres_no_casados') }}", {
                term : request.term,
                sexo : "F",
            }
            , response);
        },
        minLength: 3,
        delay: 500,
        select : function(event, ui){
            $("#txtEsposa").val(ui.item.label);
            $("#idEsposa").text(ui.item.value);
            $("#btnGuardar").prop("disabled", false);
            //Return false por la documentacion, no sé realmente para que sirve
            return false;
        },
        response: function(event, ui){
            if(ui.content.length == 0){
                $("#msjError").text("No hay registros que corresponde a la busqueda.");
                $("#alertError").prop("hidden", false);
            }
            else{
                $("#alertError").prop("hidden", true);
            }
        },
        search: function(event, ui){
            $("#idEsposa").text("");
        },
    });

    $("#btnAgregar").click(function(){
        var tabla = $("#datatable").DataTable();

        if($("#txtNombre").val() == ""){
            desplazoArriba();
            $("#msjError").text("Especificar nombre de Padrino.");
            $("#alertError").prop("hidden", false);
            return;
        }
        if($("#txtApellido").val() == ""){
            desplazoArriba();
            $("#msjError").text("Especificar apellido de Padrino.");
            $("#alertError").prop("hidden", false);
            return;
        }

        if(tabla.rows().count() < 8){
            var sexo = "Masculino";
            if ($("#radioFemenino").prop("checked")){
                sexo = "Femenino";
            }
            /*var boton = document.createElement("BUTTON");
            boton.type = "button";
            boton.classList.add("btn");
            boton.classList.add("btn-danger");
            boton.classList.add("btn-xs");
            boton.classList.add("btnEliminar");
            boton.onclick = eliminarFila;
            var i = document.createElement("i");
            i.classList.add("fas");
            i.classList.add("fa-trash-alt");
            boton.appendChild(i);*/
            tabla.row.add([
                $("#txtNombre").val(),
                $("#txtApellido").val(),
                sexo,
                '<button class="btn btn-danger btn-xs btnEliminar" onclick="eliminarFila(this)" type="button" id="delete"><i class="fas fa-trash-alt" ></i></button>',
                
            ]).draw();
            //console.log(tabla.cell((tabla.row().count()-1), 3).append(boton));
            /*console.log(tabla.row(tabla.rows().count()-1).index());
            var tablaNormal = document.getElementById("datatable");
            var index = tablaNormal.rows.length - 1;
            tablaNormal.rows[index].cells[3].append(boton);*/
            $("#alertError").prop("hidden", true);
            $("#txtNombre").val("");
            $("#txtApellido").val("");
            $("#txtNombre").focus();
        }
        else{
            desplazoArriba();
            $("#msjError").text("Solo se permiten 8 padrinos como maximo.");
            $("#alertError").prop("hidden", false);
        }
    });

    function eliminarFila(boton){
        var tabla = $("#datatable").DataTable();
        tabla.row($(boton).parents('tr')).remove().draw();
    }

    $("#btnGuardar").click(function(e){
        e.preventDefault();
        $("#btnGuardar").prop("disabled", true);
        var tabla = $("#datatable").DataTable();
        if(tabla.rows().count() < 2){
            desplazoArriba();
            $("#msjError").text("Fatan padrinos, deben ser 2 como minimo.");
            $("#alertError").prop("hidden", false);
            return;
        }
        if(tabla.rows().count() > 8){
            desplazoArriba();
            $("#msjError").text("Demasiados padrinos, deben ser 8 como maximo.");
            $("#alertError").prop("hidden", false);
            return;
        }
        console.log("Datos");
        console.log($("#idEsposo").html());
        console.log($("#idEsposa").html());
        console.log($("#txtFecha").val());
        console.log($("#slcPadre").val());
        console.log($("#txtLibro").val());
        console.log($("#txtFolio").val());
        var padrinos = "";
        for( i = 0; i < tabla.rows().count(); i++){
            padrinos += tabla.row(i).data()[0] + "(//)";
            padrinos += tabla.row(i).data()[1] + "(//)";
            padrinos += tabla.row(i).data()[2] + "(&&)";
        }
        cantPadrinos = tabla.rows().count();
        console.log(tabla.rows().count());
        console.log(padrinos);
        $.ajax({
            type: 'POST',
            url: '{{ url('guardar_nuevo_matrimonio') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                idEsposo : $("#idEsposo").html(),
                idEsposa : $("#idEsposa").html(),
                fecha : $("#txtFecha").val(),
                padre: $("#slcPadre").val(),
                libro : $("#txtLibro").val(),
                folio: $("#txtFolio").val(),
                cantPadrinos : cantPadrinos,
                padrinos : padrinos,
            },
            success : function(response){
                
                $("#btnGuardar").prop("disabled", false);
                $("#txtEsposo").val("");
                $("#idEsposo").html("");
                $("#txtEsposa").val("");
                $("#idEsposa").html("");
                //response recibe id del esposo
                window.location = "{{ url('detalle_matrimonio') }}" + "/" + response;
            },
            error: function(response){
                $(".btn").prop("disabled", false);
                $("#msjError").text(response.responseText);
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
            },
        });
    });

    /*$(".boton").click(function(){
        $(".btn").prop("disabled", true);
        $.ajax({
            type: 'POST',
            url: '',
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
                if(response.includes("Nuevo id:")){
                    var url_detalle = "";
                    url_detalle = url_detalle + "/" + response.split(":")[1];
                    window.location = url_detalle;
                }
                else{
                    $(".btn").prop("disabled", false);
                    $("#msjExito").text(response);
                    $("#alertExito").prop("hidden", false);
                }
                
            },
            error: function(response){
                $(".btn").prop("disabled", false);
                $("#msjError").text(response.responseText);
                $("#alertError").prop("hidden", false);
            },
        });
    });*/
</script>
@endsection