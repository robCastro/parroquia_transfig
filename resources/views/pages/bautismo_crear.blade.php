@extends('layouts.app')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Bautismo de {{$persona->nombre}} {{$persona->apellido}}</h1>
        </div>
        <div class="justify-content-center">
            <div class="form-group row">
                <label for="txtFecha" class="col-md-3 col-form-label text-md-right"><strong>Fecha:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtFecha" name="txtFecha" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="txtPadre" class="col-md-3 col-form-label text-md-right"><strong>Padre:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtPadre" name="txtPadre" class="form-control">
                </div>
            </div>
            <div class="row">
            <label for="txtUbicacion" class="col-md-3 col-form-label text-md-right"><strong>Ubicación </strong></label>
            <div class="col-sm-2">
            <div class="form-group row">
            <label for="txtLibro" class="col-md-4 col-form-label text-md-right"><strong>Libro:</strong></label>
                <div class="col-sm-7">
                    <input type="text" id="txtLibro" name="txtLibro" class="form-control">
                </div>
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group row">
            <label for="txtActa" class="col-md-4 col-form-label text-md-right"><strong>Acta:</strong></label>
                <div class="col-sm-7">
                    <input type="text" id="txtActa" name="txtActa" class="form-control">
                </div>
            </div>
            </div>
            </div>
        </div>           
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Padrinos</h1>
        </div>
        <div class="justify-content-center">
            <div class="form-group row">
                <label for="txtNombre" class="col-md-3 col-form-label text-md-right"><strong>Nombre:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="txtApellido" class="col-md-3 col-form-label text-md-right"><strong>Apellido:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtApellido" name="txtApellido" class="form-control">
                </div>
            </div>
            <div class="input-group">
                <label for="sexo" class="col-md-3 text-md-right"><strong>Sexo:</strong></label>
                    <div class="col-sm-2">
                        <input type="radio" id="masculino" name="sexo" class="radiobox" value="padre" checked> Masculino
                    </div>
                    <div class="col-sm-2">
                        <input type="radio" id="femenino" name="sexo" class="radiobox" value="obispo"> Femenino
                    </div>
            </div>
            <div style="padding-left:60%;">
            <button class="btn btn-secondary" data-title="Agregar">
            Agregar
            </button>
            </div><br>
        </div>
        <div class="table-responsive" style="padding-left:12%; padding-right:32%;">
        
            <table id="padrinosB_table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
            <thead>
				<tr>
					<th style="width:55%">Nombre</th>
                    <th style="width:30%">Sexo</th>
					<th style="width:15%">Eliminar</th>
				</tr>
			</thead>
			<tbody>
            <tr>
                <td>Jose Arturo Hernandez Perez</td>
				<td>Masculino</td>
                <td>
                <button class="btn btn-danger btn-xs">
                    <i class="fas fa-trash-alt" ></i>
                </button>
                </td>		
            </tr>
			</tbody>
            </table>
        </div>
        <br>
        <div class="row" style="padding-left:30%;">
            <div class="col-sm-2">
            <button type="submit" id="btnGuardar" class="btn btn-primary" >Guardar</button>
            </div>
            <div class="col-sm-2">
            <button type="button" id="btnCancelar" class="btn btn-secondary" >Cancelar</button>
            </div>
        </div>
        <br><br>
        
@endsection