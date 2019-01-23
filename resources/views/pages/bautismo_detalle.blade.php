@extends('layouts.app')

@section('content')

<main role="main" class="ml-sm-auto col-lg-12 px-4">

        <div style="padding-left:5%" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <table width="100%">
                <tr>
                    <td><h1 class="h3">Bautismo de {{$bautismo->persona->nombre}} {{$bautismo->persona->apellido}}</h1></td>
                    <td>
                        <button class="btn btn-primary btn-xs btnDescargar" type="button" id="down-" onclick="window.location = '{{url('pdf_bautismo', $bautismo->persona->id)}}'">
                                <i class="fas fa-download" ></i>
                        </button>
                        <button class="btn btn-info btn-xs btnEditar" type="button" id="edit-" onclick="window.location.href = '{{ route ('bautismo_editar',$bautismo->persona->id) }}';" >
                            <i class="fas fa-edit" ></i>
                        </button>
                        <button class="btn btn-danger btn-xs" onclick="mostrarModalEliminar(this)" >
                                <i class="fas fa-trash-alt" ></i>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="alert alert-success" id="alerta-success" hidden="">
	        <button onclick="cerrarAlertas()" type="button" class="close" aria-hidden="true">&times;</button>
	        <h4><i class="icon fa fa-check"></i> Exito</h4>
	        <h5 id="mensaje_alerta"></h5>
        </div>
        <div class="alert alert-warning" id="alerta-error" hidden="">
            <button onclick="cerrarAlertas()" type="button" class="close" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-times"></i> Error</h4>
            <h5 id="mensaje_alerta2"></h5>
        </div>
        <div style="padding-top: 2%; padding-left: 15%; padding-bottom: 2%;">
            <table width="70%" cellpadding="10">
                <tr>
                    <td style="width:25%"><strong>Papá:</strong></td>
                    <td>{{ $bautismo->persona->papa }}</td>
                </tr>
                <tr>
                    <td><strong>Mamá:</strong></td>
                    <td>{{ $bautismo->persona->mama }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha:</strong></td>
                    <td>{{ $bautismo->fecha }}</td>
                </tr>
                <tr>
                    <td><strong>Padre:</strong></td>
                    <td>{{ $bautismo->padre->nombre }} {{ $bautismo->padre->apellido }}</td>
                </tr>
                <tr>
                    <td><strong>Ubicación:</strong></td>
                    <td>Libro {{ $bautismo->libro }} Acta {{ $bautismo->acta }}</td>
                </tr>
            </table>
        </div>    
        <div style="padding-left:5%" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Padrinos</h1>
        </div>
        
        <div style="padding-left:5%; padding-right:30%;">
        <table class="table table-bordered table-sm" cellspacing="0" width="80%" style="text-align: center; vertical-align: middle;">
            <thead>
				<tr>
					<th style="width:40%">Nombre</th>
                    <th style="width:40%">Apellido</th>
                    <th style="width:20%">Sexo</th>
				</tr>
			</thead>
			<tbody>
            @foreach($bautismo->padrinos()->get() as $padrino)
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

        <!-- Modal Eliminar-->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <form method="POST" id="frmEliminar" action="{{ route('bautismo_eliminar') }}" class="form-horizontal">
		  @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Atención</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                
                            </div>
                            @if($bautismo->persona->confirmas()->first())
                            <div class="modal-body">
                                <div class="alert alert-danger" id=alerta-danger>
                                    <span class="glyphicon glyphicon-warning-sign"></span> Esta persona tiene sacramentos que dependen de este bautismo, ¿Desea eliminarlo de todos modos?
                                </div>
                                <input type="text" name="txtIdBautismo" id="txtIdBautismo" value="{{ $bautismo->id }}" hidden>
                                <input type="text" name="txtIdPersona" id="txtIdPersona" value="{{ $bautismo->persona->id }}" hidden>
                            </div>
                            @else
                            <div class="modal-body">
                                <div class="alert alert-danger" id=alerta-danger>
                                    <span class="glyphicon glyphicon-warning-sign"></span> ¿Desea eliminar este Bautismo?
                                </div>
                                <input type="text" name="txtIdBautismo" id="txtIdBautismo" value="{{ $bautismo->id }}" hidden>
                                <input type="text" name="txtIdPersona" id="txtIdPersona" value="{{ $bautismo->persona->id }}" hidden>
                            </div>
                            @endif
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div> 
                    </div>
        </form>
        </div>


<script type="text/javascript">

            function desplazoArriba(){
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }

            function cerrarAlertas(){
            $(".alert").prop("hidden", true);
            }

            function mostrarModalEliminar(button){
			$("#delete").modal();
            $("#alerta-danger").prop("hidden", false);
		    }
</script>
@endsection