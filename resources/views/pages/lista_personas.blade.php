@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Personas</h1>
        </div>
        <div style="padding-bottom: 1rem; align-content: left;">
            <button type="button" class="btn btn-primary" id="btnCrearPersona">Nuevo</button>
        </div>

        <div class="table-responsive">
            @if ($personas->isEmpty())
                <div>No hay Usuarios</div>
            @else
            <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Bautizo</th>
                        <th>Confirma</th>
                        <th>Matrimonio</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Bautizo</th>
                        <th>Confirma</th>
                        <th>Matrimonio</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach($personas as $persona)
                    <tr>
                        <td>{!!$persona->apellido!!}</td>
                        <td>{!!$persona->nombre!!}</td>
                        <td>{{$persona->fechanac}}</td>
                        <td>
                            @if ($persona->bautismos_count > 0)
                                <button type="button" >
                                    <i class="fas fa-download"></i>
                                </button>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($persona->confirmas_count > 0)
                                <button type="button" >
                                    <i class="fas fa-download"></i>
                                </button>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($persona->casada)
                                <button type="button" >
                                    <i class="fas fa-download"></i>
                                </button>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
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
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title custom_align" id="Heading">Eliminar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-warning-sign"></span> Esta seguro de querer eliminar este registro?
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span>Si</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>

@endsection