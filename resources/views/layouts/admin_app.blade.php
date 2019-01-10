

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <style>
            body {margin:0;font-family:Arial}

            .topnav {
              overflow: hidden;
              background-color: #333;
            }

            .topnav a {
              float: left;
              display: block;
              color: #f2f2f2;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
            }

            .active {
              background-color: #4CAF50;
              color: white;
            }

            .topnav .icon {
              display: none;
            }

            .dropdown {
              float: left;
              overflow: hidden;
            }

            .dropdown .dropbtn {
              font-size: 17px;    
              border: none;
              outline: none;
              color: white;
              padding: 14px 16px;
              background-color: inherit;
              font-family: inherit;
              margin: 0;
            }

            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f9f9f9;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }

            .dropdown-content a {
              float: none;
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
              text-align: left;
            }

            .topnav a:hover, .dropdown:hover .dropbtn {
              background-color: #555;
              color: white;
            }

            .dropdown-content a:hover {
              background-color: #ddd;
              color: black;
            }

            .dropdown:hover .dropdown-content {
              display: block;
            }

            @media screen and (max-width: 600px) {
              .topnav a:not(:first-child), .dropdown .dropbtn {
                display: none;
              }
              .topnav a.icon {
                float: right;
                display: block;
              }
            }

            @media screen and (max-width: 600px) {
              .topnav.responsive {position: relative;}
              .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
              }
              .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
              }
              .topnav.responsive .dropdown {float: none;}
              .topnav.responsive .dropdown-content {position: relative;}
              .topnav.responsive .dropdown .dropbtn {
                display: block;
                width: 100%;
                text-align: left;
              }
            }
            .topnav-right {
              float: right;
            }

            /*sidebar*/
            .sidenav {
              height: 100%;
              width: 0;
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;
              background-color: #111;
              overflow-x: hidden;
              transition: 0.5s;
              padding-top: 60px;
            }

            .sidenav a {
              padding: 8px 8px 8px 32px;
              text-decoration: none;
              font-size: 25px;
              color: #818181;
              display: block;
              transition: 0.3s;
            }

            .sidenav a:hover {
              color: #f1f1f1;
            }

            .sidenav .closebtn {
              position: absolute;
              top: 0;
              right: 25px;
              font-size: 36px;
              margin-left: 50px;
            }

            #main {
              transition: margin-left .5s;
              padding: 0px;
            }

            @media screen and (max-height: 450px) {
              .sidenav {padding-top: 15px;}
              .sidenav a {font-size: 18px;}
            }

        </style>
    </head>

    <body>
        
        
        <div id="main">
            <div class="topnav" id="myTopnav">
                <a href="{{ url('/') }}" style="background-color: #4CAF50;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @guest
                    @if (Route::has('register'))
                    @endif
                    @else
                    <span style="font-size:30px;cursor:pointer; color: white" onclick="openNav()">&#9776;</span>
                @endguest
                <div class="topnav-right">
                            
                    <!-- Authentication Links -->
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                        @else
                        <div class="dropdown">
                            
                            <button class="dropbtn">
                                <span style="color: white;">
                                    {{ Auth::user()->name }} 
                                </span> 
                                <i class="fa fa-caret-down"></i>
                            </button>
                    
                            <div class="dropdown-content">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
            </div>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Contact</a>
            </div>
            <main class="py-4">
                <div class="container">
                   
                    
                    <div class="row">
            
                        <div class="col-md-12">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Editar Usuario</h4>
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
                                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Actualizar</button>
                            </div>
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>
                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Eliminar</h4>
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
            </main>
        </div>
        <script>
            function myFunction() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                x.className += " responsive";
              } else {
                x.className = "topnav";
              }
            }
            function openNav() {
              document.getElementById("mySidenav").style.width = "250px";
              document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
              document.getElementById("mySidenav").style.width = "0";
              document.getElementById("main").style.marginLeft= "0";
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $("[data-toggle=tooltip]").tooltip();
            } );
        </script>
    </body>
</html>
