<!DOCTYPE html>
<html>
    <head>
        @section('head')
            @include('includes.head')
        @show
    </head>

    <body>
        @include('includes.header')

        <div class="container">
            

            <div id="main">

                @yield('content')

            </div>

            <footer>
                @include('includes.footer')
            </footer>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $("[data-toggle=tooltip]").tooltip();
            } );
        </script>
    </body>
</html>
