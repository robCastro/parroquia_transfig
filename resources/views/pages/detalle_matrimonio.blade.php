@extends('layouts.app')

@section('content')
    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="titulo" >
            <table width="100%">
                <tr>
                    <td><h1 class="h2">Matrimonio de {{ $esposo->nombre }}  y {{ $esposa->nombre }} </h1></td>
                    <td>
                        <button class="btn btn-primary btn-xs btnDescargar" type="button" id="down-" onclick="window.location = '{{ url('pdf_matrimonio', $idPersona) }}'">
                                <i class="fas fa-download" ></i>
                        </button>
                        <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-" onclick="window.location = '{{ url('editar_matrimonio', $idPersona) }}'" >
                            <i class="fas fa-edit" ></i>
                        </button>
                        <button class="btn btn-danger btn-xs btnEliminar" data-toggle="modal" data-target="#modalDelete" type="button" id="delete-">
                            <i class="fas fa-trash-alt" ></i>
                        </button>
                    </td>
                </tr>
            </table>
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


        <div style="padding-top: 2%; padding-left: 15%; padding-bottom: 5%;">
            <table width="70%" cellpadding="10">
                <tr>
                    <td><strong>Fecha:</strong></td>
                    <td>{{ $matrimonio->fecha }}</td>
                </tr>
                <tr>
                    <td><strong>Padre:</strong></td>
                    <td>{{ $matrimonio->padre->nombre }} {{ $matrimonio->padre->apellido }}</td>
                </tr>
                <tr>
                    <td><strong>Ubicación:</strong></td>
                    <td>Libro {{ $matrimonio->libro }}   Folio {{ $matrimonio->folio }}</td>
                </tr>
            </table>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="titulo" >
            <h1 class="h3">Padrinos</h1>
        </div>

        <div style="padding-top: 3%;">
            <table style="text-align: center;" id="datatable" class="table table-striped table-bordered table-sm">
                <thead>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Sexo</th>
                </thead>
                <tbody>
                    @foreach($matrimonio->padrinos()->get() as $padrino)
                    <tr>
                        <td>{{ $padrino->nombre }}</td>
                        <td>{{ $padrino->apellido }}</td>
                        <td>
                            @if ($padrino->sexo)
                                Masculino
                            @else
                                Femenino
                            @endif
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
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
                        <span class="glyphicon glyphicon-warning-sign"></span> <strong id="msjModal">¿Confirma que desea eliminar este matrimonio?</strong>
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


<script>
    
    function cerrarAlertas(){
        $(".alert").prop("hidden", true);
    }
    
    $("#btnDelete").click(function(){
        $("#btnDelete").prop("disabled", true);
        $.ajax({
            type: 'post',
            url: '{{ url ('eliminar_matrimonio') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                idPersona : {{ $idPersona }},
            },
            success : function(response){
                $("#modalDelete").modal('hide');
                window.location = "{{ url('detalle_persona', $idPersona) }}";
            },
            error: function(response){
                $("#modalDelete").modal('hide');
                $("#msjError").text("Ocurrió un Error, favor refrescar e intentar de nuevo");
                $("#alertError").prop("hidden", false);
                $("#btnDelete").prop("disabled", false);
            }
        });
    });
</script>
@endsection