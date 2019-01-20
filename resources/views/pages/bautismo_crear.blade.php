@extends('layouts.app')

@section('content')

<main role="main" class="ml-sm-auto col-lg-12 px-4">

        <div style="padding-left:5%" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Bautismo de {{$persona->nombre}} {{$persona->apellido}}</h1>
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
        <form method="POST" id="frmCrear" action="{{ route('bautismo_guardar') }}" class="form-horizontal">
        @csrf
        <input type="text" name="txtCodigoPersona" id="txtCodigoPersona" value="{{$persona->id}}" hidden>
        <input type="text" name="listaPadrinos" id="listaPadrinos" hidden>
        <div class="justify-content-center">
            <div class="form-group row">
                <label for="txtFecha" class="col-md-3 col-form-label text-md-right"><strong>Fecha:</strong></label>
                <div class="col-sm-4">
                    <input type="date" id="txtFecha" name="txtFecha" class="form-control" required>
                    <div class="invalid-feedback">Ingrese la fecha</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="selectPadre" class="col-md-3 col-form-label text-md-right"><strong>Padre:</strong></label>
                <div class="col-sm-4">
                    <select class="form-control" id="selectPadre" name="selectPadre">
                        @foreach ($padres as $padre)                            
                            <option @if ($padre->padreActual) selected @endif value="{{ $padre->id }}">
                                {{ $padre->nombre }} {{$padre->apellido}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
            <label for="txtUbicacion" class="col-md-3 col-form-label text-md-right"><strong>Ubicación </strong></label>
            <div class="col-sm-2">
            <div class="form-group row">
            <label for="txtLibro" class="col-md-4 col-form-label text-md-right"><strong>Libro:</strong></label>
                <div class="col-sm-7">
                    <input type="text" id="txtLibro" name="txtLibro" class="form-control" onkeyup="validar()">
                    <div class="invalid-feedback">Campo numérico</div>
                </div>
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group row">
            <label for="txtActa" class="col-md-4 col-form-label text-md-right"><strong>Acta:</strong></label>
                <div class="col-sm-7">
                    <input type="text" id="txtActa" name="txtActa" class="form-control" onkeyup="validar()">
                    <div class="invalid-feedback">Campo numérico</div>
                </div>
            </div>
            </div>
            </div>
        </div>           
        <div style="padding-left:5%" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h3">Padrinos</h1>
        </div>
        <div class="justify-content-center">
            <div class="form-group row">
                <label for="txtNombre" class="col-md-3 col-form-label text-md-right"><strong>Nombre:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" onkeyup="validarAgregarPadrinos()">
                    <div class="invalid-feedback">Nombre no válido</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="txtApellido" class="col-md-3 col-form-label text-md-right"><strong>Apellido:</strong></label>
                <div class="col-sm-4">
                    <input type="text" id="txtApellido" name="txtApellido" class="form-control" onkeyup="validarAgregarPadrinos()">
                    <div class="invalid-feedback">Apellido no válido</div>
                </div>
            </div>
            <div class="input-group">
                <label for="sexo" class="col-md-3 text-md-right"><strong>Sexo:</strong></label>
                    <div class="col-sm-2">
                        <input type="radio" id="masculino" name="sexo" class="radiobox" value="Masculino" checked> Masculino
                    </div>
                    <div class="col-sm-2">
                        <input type="radio" id="femenino" name="sexo" class="radiobox" value="Femenino"> Femenino
                    </div>
            </div>
            <div style="padding-left:60%;">
            <a href="#" id="btnAgregar" class="btn btn-secondary" data-title="Agregar" onclick="agregarPadrino()">
            Agregar
            </a>
            </div><br>
        </div>
        <div class="table-responsive" style="padding-left:12%; padding-right:32%;">
        
            <table name="padrinosB_table" id="padrinosB_table" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;">
            <thead>
				<tr>
					<th style="width:55%">Nombre</th>
                    <th style="width:55%">Apellido</th>
                    <th style="width:30%">Sexo</th>
					<th style="width:15%">Eliminar</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
            </table>
        </div>
        <br>
        <div class="row" style="padding-left:30%;">
            <div class="col-sm-2">
            <button type="submit" id="btnGuardar" class="btn btn-primary" >Guardar</button>
            </div>
            <div class="col-sm-2">
            <button onclick="window.location.href = '{{ route ('detalle_persona',$persona->id) }}';" type="button" id="btnCancelar" class="btn btn-secondary" >Cancelar</button>
            </div>
        </div>
        </form>
        <br><br>


        <script type="text/javascript">

            function desplazoArriba(){
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }

            function cerrarAlertas(){
            $(".alert").prop("hidden", true);
            }
            window.onload=function(){
                document.getElementById('btnGuardar').disabled = true;
                $("#btnAgregar").addClass('disabled');
		    }
            function agregarPadrino(){
                var nombre=document.getElementById('txtNombre').value;
                var apellido=document.getElementById('txtApellido').value;
                var sexo=$('input:radio[name=sexo]:checked').val()
                var table =document.getElementById("padrinosB_table");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                cell1.innerHTML = nombre;
                cell2.innerHTML = apellido; 
                cell3.innerHTML = sexo;
                cell4.innerHTML = '<button class="btn btn-danger btn-xs" onclick="eliminarFila('+ row.rowIndex +')"><i class="fas fa-trash-alt"></i></button>';     
                validar();
                document.getElementById('txtNombre').value="";
                document.getElementById('txtApellido').value="";
            }

            function eliminarFila(rowIndex) {
                document.getElementById("padrinosB_table").deleteRow(rowIndex);
                validar();
            }

            //validaciones
            function validarNom(nom) {
            if(nom == ""){
                return false;
            }
            else{
                var regex = /(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)/;
                return regex.test(nom);
            }
            }
            function validacionesPadrinos(nombre, apellido){
                var estado = false;
                estado = (validarNom(nombre) && validarNom(apellido))
                return estado;
            }
            //Validacion de formulario Agregar padrinos
            function validarAgregarPadrinos() {
            var nombre=document.getElementById('txtNombre').value;
            var apellido = document.getElementById('txtApellido').value;
            if (!validarNom(nombre)){
                document.getElementById('txtNombre').className = "form-control is-invalid";
            }
            else{
                document.getElementById('txtNombre').className = "form-control";
            }
            if (!validarNom(apellido)){
                document.getElementById('txtApellido').className = "form-control is-invalid";
            }
            else{
                document.getElementById('txtApellido').className = "form-control";
            }
            
            var esValido = validacionesPadrinos(nombre, apellido);
            if(esValido){
                $("#btnAgregar").removeClass('disabled');
            }
            else{
                $("#btnAgregar").addClass('disabled');
            }
            }

            function validarNum(num) {
            if(num == ""){
                return false;
            }
            else{
                var regex = /^[1-9]{1}([0-9])*$/;
                return regex.test(num);
            }
            }
            function validarTabla() {
                var cantFilas=document.getElementById("padrinosB_table").rows.length-1;
                if(cantFilas>=1 && cantFilas<=8){
                    return true;
                }
                else{
                    return false;
                }
            }

            function validaciones(libro,acta){
                var estado = false;
                estado = (validarNum(libro) && validarNum(acta) && validarTabla());
                return estado;
            }
            //Validacion de formulario Crear Bautismo
            function validar() {
            var libro=document.getElementById('txtLibro').value;
            var acta = document.getElementById('txtActa').value;
            if (!validarNum(libro)){
                document.getElementById('txtLibro').className = "form-control is-invalid";
            }
            else{
                document.getElementById('txtLibro').className = "form-control";
            }
            if (!validarNum(acta)){
                document.getElementById('txtActa').className = "form-control is-invalid";
            }
            else{
                document.getElementById('txtActa').className = "form-control";
            }
            var esValido = validaciones(libro, acta);
            document.getElementById('btnGuardar').disabled = !esValido;
            }

            function listarPadrinos(){
                var lista=[];
                $("#padrinosB_table tr").each(function (index) {
                if(index != 0){
                    var tr=[];
                    $(this).children("td").each(function (index2) {
                        if(index2 != 3){
                            tr.push($(this).text());
                        }
                    });
                    lista.push(tr);
                }
                });
                console.log(lista);
                document.getElementById('listaPadrinos').value=JSON.stringify(lista);
            }

            $(document).ready(function(){
			$('#btnGuardar').click(function(e){
				e.preventDefault();
                listarPadrinos();
				var form = $("#frmCrear");
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					data: form.serialize(),
					success: function(result){
						$("#mensaje_alerta").html(result.mensaje);
						$("#alerta-success").prop("hidden", false);
                        desplazoArriba();
                        var url_detalle = "{{ route('detalle_persona',$persona->id) }}";
                        window.location = url_detalle;
					},
					error: function(result){
						$("#mensaje_alerta2").html(result.responseText);
						$("#alerta-error").prop("hidden", false);
                        desplazoArriba();
						console.log(result.responseText);
					}
				});	
			});
            });

        </script>
        
@endsection