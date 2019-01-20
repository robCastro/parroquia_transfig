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
            <form id="nuevaConfirma" method="POST">
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
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control" onkeyup="validarCrear()">
                                <div class="invalid-feedback">Nombre no válido</div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="txtApellido"><strong>Apellido:</strong></label></th>
                            <td colspan="6">
                                <input type="text" id="txtApellido" name="txtApellido" class="form-control" onkeyup="validarCrear()"> <!-- onkeyup="validarCrear()"-->
                                <div class="invalid-feedback">Apellido no válido</div>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <th><label for="sltSexo"><strong>Sexo:</strong></label></th>
                            <td colspan="6">
                                <select class="form-control" id="sltSexo">
                                    <option selected disabled>--Seleccionar--</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
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
                                <button type="button" id="btnGuardar" class="btn boton btn-primary" onclick="ingresarConfirma()">Guardar</button>
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
        
        window.onload=function(){
            var alerta = $("#alerta-success");
            alerta.hide();
            var alerta = $("#alerta-error");
            alerta.hide();
            $('.alert .close').on('click', function(e) {
                $(this).parent().hide();
            });

            //document.getElementById('btnGuardar').disabled = true;
            document.getElementById('btnAgregar').disabled = true;
        }

        //Validaciones
        function validarNom(nom) {
        if(nom == ""){
            return false;
        }
        else{
            var regex = /(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)|(^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+ ?[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$)/;
            return regex.test(nom);
        }
        }

        function validaciones(_nom, _ape){
            var estado = false;
            estado = (validarNom(_nom) && validarNom(_ape))
            return estado;
        }

        function validarCrear() {
            var _nom = document.getElementById("txtNombre").value;
            var _ape = document.getElementById("txtApellido").value;
            if (!validarNom(_nom)){
            document.getElementById('txtNombre').className = "form-control is-invalid";
            }   
            else{
                document.getElementById('txtNombre').className = "form-control";
            }
            if (!validarNom(_ape)){
                document.getElementById('txtApellido').className = "form-control is-invalid";
            }
            else{
                document.getElementById('txtApellido').className = "form-control";
            }
            
            var esValido = validaciones(_nom, _ape);
            document.getElementById('btnAgregar').disabled = !esValido;
        }

        var i = 0;
        //Agregar a Tabla
        function guardar(){
            
            if(i === 4){
                document.getElementById('btnAgregar').disabled = true;
            }
            else{
                var _nom = document.getElementById("txtNombre").value;
                var _ape = document.getElementById("txtApellido").value;
                var _sex = document.getElementById("sltSexo").value;

                i++;
                var fila = '<tr id="row' + i + '"><td>' + _nom+ '</td><td>' + _ape + '</td><td>' + _sex + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-xs btn_remove"><i class="fas fa-minus" ></i></button></td></tr>'; //esto seria lo que contendria la fila
                var btn = document.createElement("TR");
                btn.innerHTML=fila;
                document.getElementById("tablita").appendChild(btn);
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

        /*function ingresarConfirma(){
            var data = walk("padTable");
            console.log(data)
            
            var confirma = {
                "_token": "{{ csrf_token() }}",
                fecha : $("#txtFecha").val(),
                obispo : $("#slcObispo").val(),
                libro : $("#txtLibro").val(),
                acta : $("#txtActa").val(),
                pagina : $("#txtPagina").val(),
                padrinos : data
            };

            console.log(confirma)

            $.ajax({
                
                url: '{{ url ('padrinos_confirma') }}',
                type: "POST",
                dataType: "JSON",
                data: 
                {
                    confir: JSON.stringify(confirma)
                },

                success: function (result) {
                    console.log();
                },
                error: function (err) {
                    console.log();   
                }
            });

        }*/

        function ingresarConfirma(){
            var data = walk("padTable");
            console.log(data)
            var num = i;
            var confirma = {
                "_token": "{{ csrf_token() }}",
                fecha : $("#txtFecha").val(),
                obispo : $("#slcObispo").val(),
                libro : $("#txtLibro").val(),
                acta : $("#txtActa").val(),
                pagina : $("#txtPagina").val(),
                padrinos : data
            };

            console.log(confirma)

            $.ajax({
                
                url: '{{ url ('padrinos_confirma') }}',
                type: "POST",
                dataType: "JSON",
                data: 
                {
                    "_token": "{{ csrf_token() }}",
                    fecha : $("#txtFecha").val(),
                    obispo : $("#slcObispo").val(),
                    libro : $("#txtLibro").val(),
                    acta : $("#txtActa").val(),
                    pagina : $("#txtPagina").val(),
                    cantPad: num,
                    padrinos : JSON.stringify(data),
                },

                success: function (result) {
                    console.log();
                },
                error: function (err) {
                    console.log();   
                }
            });

        }

/*                success : function(response){
                    if(response.includes("Nuevo id:")){
                        var url_confirma = "{{ url('crear_confirma') }}";
                        url_confirma = url_confirma + "/" + response.split(":")[1];
                        window.location = url_confirma;
                    }
                    else{
                        $("#btnGuardar").prop("disabled", false);
                        $("#msjExito").text(response);
                        $("#alertExito").prop("hidden", false);
                    }
                    
                },
                error: function(response){
                    $("#btnGuardar").prop("disabled", false);
                    $("#msjError").text(response.responseText);
                    $("#alertError").prop("hidden", false);
                },
            });
        });*/
    </script>

    

@endsection