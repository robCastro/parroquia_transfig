
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

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <nav class="navbar fixed-top flex-md-nowrap p-0 shadow menu">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">La Transfiguracion</a>  
      <div>
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                
            @else
                <li class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    
                </li>
                <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li class="dropdown-header">Dropdown header 1</li>
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Dropdown header 2</li>
                        <li><a href="#">About Us</a></li>
                      </ul>
                    </div>
            @endguest
        </ul>
      </div>

     
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          @include('includes.sidebar')
        </nav>
        @yield('content')
      </div>
    </div>
    
  <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable').dataTable();
          $("[data-toggle=tooltip]").tooltip();
      } );

      $("#success-alert").fadeTo(6000, 500).slideUp(500, function(){
          $(".alert-dismissible").alert('close');
      });
  </script>
  </body>
</html>
