@extends('layouts.app')

@section('content')

    <style>
        .celdaClic {cursor: pointer;}
    </style>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Personas</h1>
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



        <div style="padding-top: 3%; align-content: left;">
            <button type="button" onclick="window.location.href = '{{ url ('crear_persona') }}';"  class="btn btn-primary" id="btnCrearPersona">Nuevo</button>
        </div>

        <div class="table-responsive" style="padding-top: 2%;">
            @if ($personas->isEmpty())
                <div>No hay Usuarios</div>
            @else
            <table id="datatable" class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach($personas as $persona)
                    <tr id="tr-{{ $persona->id }}" data-target="{{ url('detalle_persona', $persona->id)}}">
                        <td class="celdaClic" >{!!$persona->apellido!!}</td>
                        <td class="celdaClic" >{!!$persona->nombre!!}</td>
                        <td class="celdaClic" >{{$persona->fechanac}}</td>
                        <td>
                            <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-edit" ></i>
                            </button>
                            <button class="btn btn-danger btn-xs btnEliminar" type="button" id="delete-{{ $persona->id }}">
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


    <!-- modal delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <form method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title custom_align" id="Heading">Eliminar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> <strong id="msjModal"></strong>
                        <strong id="idAux" hidden=""></strong>
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

    <script type="text/javascript">
        function cerrarAlertas(){
           $(".alert").prop("hidden", true);
        }

        $(".btnEliminar").click(function(){
            var idPersona = $(this).attr("id").split("-")[1];
            $("#idAux").html(idPersona);
            $.ajax({
                type: 'get',
                url: '{{ url ('consultar_sacramentos') }}',
                data: {
                    codPersona : idPersona,
                },
                dataType: 'json',
                success : function(response){
                    console.log(response);
                    var mensaje = "";
                    if (response.cantBautismos > 0 || response.cantConfirmas > 0 || response.cantMatrimonios){
                        mensaje = "<p>Esta persona cuenta con registro de:</p>";
                        if (response.cantBautismos > 0)
                            mensaje = mensaje + "<p> - Bautismo</p>";
                        if (response.cantConfirmas > 0)
                            mensaje = mensaje + "<p> - Confirma</p>";
                        if (response.cantMatrimonios > 0)
                            mensaje = mensaje + "<p> - Matrimonio</p>";
                        mensaje = mensaje + "¿Seguro que desea eliminarla?";
                    }
                    else
                        mensaje = "¿Confirma que desea eliminar a estar persona?";
                    console.log(mensaje);
                    $("#msjModal").html(mensaje);
                    $("#modalDelete").modal("show");

                },
                error: function(response){
                    console.log(response.responseText);
                    $("#msjError").text(response.responseText);
                    $("#alertError").prop("hidden", false);
                }
            });
        });

        $("#btnDelete").click(function(){
            var idPersona = $("#idAux").html();
            $("#modalDelete").modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ url ('eliminar_persona') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    codPersona : idPersona,
                },
                success : function(response){
                    var tabla = $("#datatable").DataTable();
                    tabla.row($("#tr-"+idPersona)).remove().draw();
                    $("#msjExito").text(response);
                    $("#alertExito").prop("hidden", false);
                },
                error: function(response){
                    console.log(response.responseText);
                    $("#msjError").text(response.responseText);
                    $("#alertError").prop("hidden", false);
                }
            });
        });

        $(".celdaClic").click(function() {
            window.location = $(this).parents('tr').data("target");
        });
    </script>
@endsection