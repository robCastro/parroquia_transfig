<div id="sidebar-wrapper">
  <ul id="sidebar_menu" class="sidebar-nav">
    <li class="sidebar-brand"><a id="menu-toggle" href="#">Administrador <i id="main_icon" class="fas fa-bars fa-lg"></i></a></li>
  </ul>
  <ul class="sidebar-nav" id="sidebar" style="text-align: justify;">
    <li class="nav-item {{ request()->is('lista_personas') ? 'active' : '' }}">
      <a href="{{ url('lista_personas') }}">
        Personas <i id="sub_icon" class="fas fa-user fa-lg"></i>
      </a>
    </li>

    <li class="nav-item {{ request()->is('') ? 'active' : '' }}">
      <a href="{{ url('comuniones') }}">
        Comunión <i id="sub_icon" class="fas fa-file-pdf fa-lg"></i>
      </a>
    </li>
    <li class="nav-item {{ request()->is('padres') ? 'active' : '' }}">
      <a href="{{ url('padres') }}">
        Padres <i id="sub_icon" class="fas fa-church fa-lg"></i>
      </a>
    </li>
    @if(Auth::user()->type == 'admin')
    <li class="nav-item {{ request()->is('asistentes') ? 'active' : '' }}">
      <a href="{{ url('asistentes') }}">
        Asistentes <i id="sub_icon" class="fas fa-users fa-lg"></i>
      </a>
    </li>
    @endif
    <li class="nav-item {{ request()->is('') ? 'active' : '' }}">
      <a href="{{ route('miusuario') }}">
        Mi Usuario <i id="sub_icon" class="fas fa-user-cog fa-lg"></i>
      </a>
    </li>
  </ul>
</div>
