@extends('layouts.app')

@section('content')

    <main role="main" class="ml-sm-auto col-lg-12 px-4">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" @if (!$persona) hidden @endif>
            <h1 class="h2">Confirma de {{ $persona->nombre }} {{ $persona->apellido }}</h1>
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
            <form id="nuevaConfirma" method="GET">
               @csrf
                <table width="70%" cellpadding="5">
                    <tr>
                        <div class="form-group">
                            <th><label for="txtFecha"><strong>Fecha:</strong></label></th>
                            <td colspan="6"><input class="form-control" type="date" id="txtFecha" required></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="slcObispo"><strong>Obispo:</strong></label></th>
                            <td colspan="6">
                                <select class="form-control" id="slcObispo" required>
                                    <option selected disabled>
                                    --Seleccionar--
                                    </option>
                                    @foreach ($obispos as $obispo)                            
                                        <option value="{{ $obispo->id}}">
                                            {{ $obispo->nombre }} {{ $obispo->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="txtUbicacion"><strong>Ubicación:</strong></label></th>
                            <td>
                                <label for="txtLibro"><strong>Libro:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtLibro" required>
                            </td>
                            <td>
                                <label for="txtActa"><strong>Acta:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtActa" required>
                            </td>
                            <td>
                                <label for="txtPagina"><strong>Pagina:</strong></label>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="txtPagina" required>
                            </td>
                        </div>
                    </tr>
                </table>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3">Padrinos</h1>
                </div>

                <small style="color: red; text-align: center;">Puede agregar hasta 4 padrinos</small>
                <table  width="70%" cellpadding="5">
                    <tr>
                        <div class="form-group">
                            <th><label for="txtNombre"><strong>Nombre:</strong></label></th>
                            <td colspan="6">
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="txtApellido"><strong>Apellido:</strong></label></th>
                            <td colspan="6">
                                <input type="text" id="txtApellido" name="txtApellido" class="form-control"> <!-- onkeyup="validarCrear()"-->
                                <div class="invalid-feedback">Apellido no válido</div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="sltSexo"><strong>Sexo:</strong></label></th>
                            <td colspan="6">
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
                        <th></th>
                        <td colspan="6" style="float: right;">
                            <button type="button" id="btnAgregar" class="btn btn-primary" onclick="guardar()"><i class="fas fa-plus-circle" ></i></button>
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table table-hover table-bordered table-sm" cellspacing="0" width="100%" style="text-align: center;" id="padTable">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Sexo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody id="tablita">
                       
                    </tbody>
                </table>
                
                <div style="padding-top: 5%; padding-left: 50%">
                    <table>
                        <tr>
                            <td>
                                <button type="submit" id="btnGuardar" class="btn boton btn-primary" onclick="ingresarConfirma()">Guardar</button>
                            </td>
                            <td>
                                <button type="button" onclick="window.location.href = '{{ url ('detalle_persona', $persona->id) }}';" class="btn btn-block btn-danger btn-flat">Cancelar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </main>    

    <script type="text/javascript">
        
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

        var i = 0;
        //Agregar a Tabla
        function guardar(){
            //var tabla = $("#padTable").DataTable();

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

            if(i === 4){
                document.getElementById('btnAgregar').disabled = true;
            }
            else{
                var _nom = $("#txtNombre").val();
                var _ape = $("#txtApellido").val();
                var _sex = "Masculino";
                if ($("#radioFemenino").prop("checked")){
                    _sex = "Femenino";
                }
                i++;
                var fila = '<tr id="row' + i + '"><td>' + _nom+ '</td><td>' + _ape + '</td><td>' + _sex + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-xs btn_remove"><i class="fas fa-minus" ></i></button></td></tr>'; //esto seria lo que contendria la fila
                var btn = document.createElement("TR");
                btn.innerHTML=fila;
                document.getElementById("tablita").appendChild(btn);
                $("#alertError").prop("hidden", true);
                $("#txtNombre").val("");
                $("#txtApellido").val("");
                $("#txtNombre").focus();
            }
        }

        $(function () {
            $(document).on('click', '.btn_remove', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
                i--;
            });
        });

        function foreach(root, selector, callback) {
            if (typeof selector == 'string') {
                var all = root.querySelectorAll(selector);
                for (var each = 0; each < all.length; each++) {
                    callback(all[each]);
                }
            } else {
                for (var each = 0; each < selector.length; each++) {
                    foreach(root, selector[each], callback);
                }
            }
        }

        function walk(padTable) {
            var padTable = document.getElementById(padTable);
            var data = [];
            if (padTable) {
                foreach(padTable, 'tr', function (row) {
                    var record = [];
                    foreach(row, 'td', function (cell) {
                        if (cell.children.length > 0 && cell.children.length < 2) {
                            record.push(cell.children[0].value);
                        } else {
                            record.push(cell.innerText);
                        }

                    });
                    if (record.length > 0) {
                        data.push(record);
                    }

                });
            }
            
            return data;
        }

        function ingresarConfirma(){
            var data = walk("padTable");
            if(data.length < 1){
                desplazoArriba();
                $("#msjError").text("Fatan padrinos, debe ser 1 como minimo.");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }

            if(data.length > 4){
                desplazoArriba();
                $("#msjError").text("Demasiados padrinos, deben ser 4 como maximo.");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }

            if($("#txtFecha").val() == ""){
                desplazoArriba();
                $("#msjError").text("Especificar fecha");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }

            var regex = /^[1-9]+[0-9]*$/;
            if(! regex.test($("#txtLibro").val())){
                desplazoArriba();
                $("#msjError").text("Solamente numeros en libro");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }
            if(! regex.test($("#txtActa").val())){
                desplazoArriba();
                $("#msjError").text("Solamente numeros en Acta");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }
            if(! regex.test($("#txtPagina").val())){
                desplazoArriba();
                $("#msjError").text("Solamente numeros en Pagina");
                $("#alertError").prop("hidden", false);
                $("#btnGuardar").prop("disabled", false);
                return;
            }

            var confirma = {
                "_token": "{{ csrf_token() }}",
                fecha : $("#txtFecha").val(),
                obispo : $("#slcObispo").val(),
                libro : $("#txtLibro").val(),
                acta : $("#txtActa").val(),
                pagina : $("#txtPagina").val(),
                padrinos : data
            };

            console.log(confirma);

            $.ajax({
                
                url: '{{ url ('registrar_confirma', $persona->id) }}',
                type: "GET",
                dataType: "JSON",
                data: 
                {
                    'data' : JSON.stringify(confirma)
                },

                success : function(response){
                
                    $("#btnGuardar").prop("disabled", false);
                    
                    //response recibe id del esposo
                    //window.location = "{{ url('detalle_confirma', $persona->id) }}";
                },
                error: function(err){
                    $(".btn").prop("disabled", false);
                    window.location = "{{ url('detalle_confirma', $persona->id) }}";
                },
            });

        }

    </script>

    

@endsection