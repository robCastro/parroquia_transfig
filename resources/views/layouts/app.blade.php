
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema informatico para procesos administrativos">
    <meta name="author" content="Roberto Castro, Patricia Solano y Marisol Garcia">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Parroquia La Transfiguración</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" integrity="" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrapadd.min.css') }}">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <div id="wrapper" class="active">
      
      @include('includes.sidebar')

      <div id="page-content-wrapper">
        <div class="page-content inset">
          <div class="row">
            <nav class="navbar fixed-top navbar-expand-lg menu" style="float: right;">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto" style="float: right;">
                    <!-- Authentication Links -->
                    @guest
                        
                    @else
                        <li class="nav-item dropdown">
                            <button id="navbarDropdown" class="btn dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="color: black;">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>    
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    
  <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable').dataTable({
            "language": {
                "search":"Buscar",
                "lengthMenu": "Mostar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, no encontramos lo que estas buscando",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Registros no encontrados",
                "infoFiltered": "(Filtrado en _MAX_ registros totales)",
                "paginate": {
                  "previous": "Anterior",
                  "next": "Siguiente"
                }

            }
          });
          $("[data-toggle=tooltip]").tooltip();
      } );

      $("#success-alert").fadeTo(6000, 500).slideUp(500, function(){
          $(".alert-dismissible").alert('close');
      });

      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});
  </script>
  </body>
</html>
