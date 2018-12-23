<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">           
                <li class="header"><span>Administrador</span></li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active">
                    <a href="{{ url('admin/profesores') }}">
                        <i class='fa fa-chalkboard-teacher'></i> <span>Profesores</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/edificios') }}">
                        <i class='fa fa-building'></i> <span>Edificios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/aulas') }}">
                        <i class='fa fa-chalkboard'></i> <span>Aulas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/materiaList') }}">
                        <i class='fa fa-book'></i> <span>Materias</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/relaciones') }}">
                        <i class='fa fa-link'></i> <span>Relaciones</span>
                    </a>
                </li>
                <li class="header"><span>Visitante</span></li>
                <li class="treeview">
                    <a>
                        <i class='fa fa-chalkboard'></i> <span>Aulas</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ url('usuario/aulasActuales') }}">Disponibles Actualmente</a>
                        </li>
                        <li>
                            <a href="{{ url('usuario/aulasPorHorario') }}">Disponibles por Horario</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('admin/')}}">
                        <i class='fa fa-link'></i> <span>Teóricos y Discusiones</span>
                    </a>
                </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
