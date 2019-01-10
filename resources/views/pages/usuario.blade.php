@extends('layouts.app')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Asistentes</h1>
        </div>
        <div class="table-responsive">
            @if ($users->isEmpty())
                <div>No hay Usuarios</div>
            @else
            <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </tfoot>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{!!$user->id!!}</td>
                        <td>{!!$user->name!!}</td>
                        <td>{!!$user->email!!}</td>
                        <td>
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                <i class="fas fa-edit"></i>
                            </button>
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
    

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Tiger Nixon">
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="System Architect">
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Edinburgh">
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            
                    <!-- /.modal-dialog --> 
                </div>
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