@extends('layouts.app')

@section('content')

    <style>
        .celdaClic {cursor: pointer;}
    </style>
    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="titulo" @if (!$persona) hidden @endif >
            <table width="100%">
                <tr>
                    <td><h1 class="h2">{{ $persona->nombre }} {{ $persona->apellido }}</h1></td>
                    <td>
                        <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" onclick="window.location = '{{ url('editar_persona', $persona->id) }}'" >
                            <i class="fas fa-edit" ></i>
                        </button>
                        <button class="btn btn-danger btn-xs btnEliminar" data-toggle="modal" data-target="#modalDelete" type="button" id="delete-{{ $persona->id }}">
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


        <div style="padding-top: 2%; padding-left: 15%; padding-bottom: 5%;" @if (!$persona) hidden @endif>
            <table width="70%" cellpadding="10">
                <tr>
                    <td><strong>Fecha de Nacimiento:</strong></td>
                    <td>{{ $persona->fechanac }}</td>
                </tr>
                <tr>
                    <td><strong>Lugar de Nacimiento:</strong></td>
                    <td>@if ($salvadorenio) {{ $persona->municipio->nombre }}, {{ $persona->municipio->departamento->nombre }}, @endif {{ $persona->nacionalidad->pais }}.</td>
                </tr>
                <tr>
                    <td><strong>Papá:</strong></td>
                    <td>{{ $persona->papa }}.</td>
                </tr>
                <tr>
                    <td><strong>Mamá:</strong></td>
                    <td>{{ $persona->mama }}.</td>
                </tr>
            </table>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="titulo" @if (!$persona) hidden @endif >
            <h1 class="h3">Sacramentos</h1>
        </div>

        <div @if (!$persona) hidden @endif style="padding-left: 10%; padding-top: 3%; width: 80%;">
            <table class="table table-bordered table-hover table-sm" cellspacing="0" width="80%" style="text-align: center; vertical-align: middle;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>

                <tbody>
                    @if($persona->bautismos()->first())
                    <tr data-target="#{{ $persona->id }}">
                        <td class="celdaClic" style="vertical-align:middle">Bautismo</td>
                        <td class="celdaClic"  style="vertical-align:middle">{{ $persona->bautismos()->first()->fecha }}</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnDescargar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-download" ></i>
                            </button>
                            <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-edit" ></i>
                            </button>
                            <button class="btn btn-danger btn-xs btnEliminar" type="button" id="delete-{{ $persona->id }}">
                                <i class="fas fa-trash-alt" ></i>
                            </button>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td style="vertical-align:middle">Bautismo</td>
                        <td style="vertical-align:middle">----</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-plus-circle" ></i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @if($persona->confirmas()->first())
                    <tr data-target="#{{ $persona->id }}">
                        <td class="celdaClic"  style="vertical-align:middle">Confirma</td>
                        <td class="celdaClic"  style="vertical-align:middle">{{ $persona->confirmas()->first()->fecha }}</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnDescargar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-download" ></i>
                            </button>
                            <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-edit" ></i>
                            </button>
                            <button class="btn btn-danger btn-xs btnEliminar" type="button" id="delete-{{ $persona->id }}">
                                <i class="fas fa-trash-alt" ></i>
                            </button>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td style="vertical-align:middle">Confirma</td>
                        <td style="vertical-align:middle">----</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnCrear" type="button" id="create-{{ $persona->id }}" >
                                <a href="{{url ('crear_confirma', $persona->id)}}" style="color: white">
                                    <i class="fas fa-plus-circle" ></i>
                                </a>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @if($matrimonio)
                    <tr data-target="#{{ $persona->id }}">
                        <td class="celdaClic"  style="vertical-align:middle">Matrimonio</td>
                        <td class="celdaClic"  style="vertical-align:middle">{{ $matrimonio->fecha }}</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnDescargar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-download" ></i>
                            </button>
                            <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-edit" ></i>
                            </button>
                            <button class="btn btn-danger btn-xs btnEliminar" type="button" id="delete-{{ $persona->id }}">
                                <i class="fas fa-trash-alt" ></i>
                            </button>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td style="vertical-align:middle">Matrimonio</td>
                        <td style="vertical-align:middle">----</td>
                        <td style="vertical-align:middle">
                            <button class="btn btn-primary btn-xs btnEditar" type="button" id="edit-{{ $persona->id }}" >
                                <i class="fas fa-plus-circle" ></i>
                            </button>
                        </td>
                    </tr>
                    @endif
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
                        <span class="glyphicon glyphicon-warning-sign"></span> <strong id="msjModal">¿Confirma que desea eliminar a estar persona?</strong>
                        <strong id="idAux" hidden="">{{ $persona->id }}</strong>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*$(".celdaClic").mouseenter(function(){
        console.log("Mouse dentro");
        object.style.cursor="pointer";
    }).mouseleave(function(){
        object.style.cursor="auto";
    });*/

    $(".celdaClic").click(function() {
        window.location = $(this).parents('tr').data("target");
    });
    
    $("#btnDelete").click(function(){
        var idPersona = $("#idAux").html();
        $.ajax({
            type: 'post',
            url: '{{ url ('eliminar_persona') }}',
            data: {
                "_token": "{{ csrf_token() }}",
                codPersona : idPersona,
            },
            success : function(response){
                $("#modalDelete").modal('hide');
                window.location = "{{ url('lista_personas') }}";
            },
            error: function(response){
                $("#modalDelete").modal('hide');
                console.log(response.responseText);
                $("#msjError").text(response.responseText);
                $("#alertError").prop("hidden", false);
            }
        });
    });
</script>
@endsection