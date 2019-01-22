@extends('layouts.app')

@section('content')

    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Constancias de Comuniones</h1>
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
                        <td><label for="txtNombre"><strong>Nombre:</strong></label></td>
                        <td>
                            <input class="form-control" type="text" id="txtNombre">
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td><label for="txtApellido"><strong>Apellido:</strong></label></td>
                        <td>
                            <input class="form-control" type="text" id="txtApellido">
                        </td>
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
                        <td><label for="txtFechaNac"><strong>Fecha:</strong></label></td>
                        <td><input required="" class="form-control" type="date" id="txtFecha"></td>
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
            </table>
            <div style="padding-top: 5%; padding-left: 80%">
                <table cellpadding="10">
                    <tr>
                        <td>
                            <button type="submit" id="btnGenerar" class="btn boton btn-primary">Generar</button>
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

    $("#btnGenerar").click(function(e){
        e.preventDefault();
        $("#btnGenerar").prop("disabled", true);
        var tabla = $("#datatable").DataTable();
        
        if($("#txtNombre").val() == ""){
            desplazoArriba();
            $("#msjError").text("Especificar Nombre");
            $("#alertError").prop("hidden", false);
            $("#btnGenerar").prop("disabled", false);
            return;
        }
        if($("#txtApellido").val() == ""){
            desplazoArriba();
            $("#msjError").text("Especificar Apellido");
            $("#alertError").prop("hidden", false);
            $("#btnGenerar").prop("disabled", false);
            return;
        }
        if($("#txtFecha").val() == ""){
            desplazoArriba();
            $("#msjError").text("Especificar fecha");
            $("#alertError").prop("hidden", false);
            $("#btnGenerar").prop("disabled", false);
            return;
        }
        var nombre = $("#txtNombre").val();
        var apellido = $("#txtApellido").val();
        var sexo = $("#radioMasculino").prop("checked");
        var fecha = $("#txtFecha").val();
        var padre = $("#slcPadre").val();
        nombre = nombre.replace(" " , "%20");
        apellido = apellido.replace(" " , "%20");
        var url = "{{ url('pdf_comunion') }}" + "?nombre="+nombre+"&apellido="+apellido+"&sexo="+sexo+"&fecha="+fecha+"&padre="+padre;
        window.location = url;
        $("#btnGenerar").prop("disabled", false);
    });
</script>
@endsection