<ul class="sidebar-menu sidebar">
    <li class="menu-header ">Dashboard</li>
    <li class="dropdown {{ $activePage == 'home'  ? ' active' : '' }}">
      <a href="home" ><i class="fas fa-home titulo"></i><span class="titulo">Dashboard</span></a>
    </li>
    <li class="menu-header">Administracion</li>
    <li class="dropdown {{ $activePage === 'proveedores' ? ' active' : '' }}">
      <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users titulo"></i> <span class="titulo">Usuarios</span></a>
      <ul class="dropdown-menu ">
        <li><a class="nav-link" href="layout-default.html"> Trabajadores</a></li>
        <li  class="nav-item{{ $activePage == 'proveedores' ? ' active' : '' }}"><a  href="{{ route('proveedores.index') }}" class="nav-link" href="layout-transparent.html">Proveedores</a></li>
        <li><a class="nav-link" href="blank.html">Roles</a></li>
      </ul>
    </li>
    <li class="dropdown {{ $activePage === 'sucursales' || $activePage === 'sucursales2' ? ' active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-th titulo"></i> <span class="titulo">Reportes</span></a>
      <ul class="dropdown-menu">
        <li  class="nav-item{{ $activePage == 'sucursales' ? ' active' : '' }}"><a href="{{ route('sucursales.index') }}" class="nav-link" href="bootstrap-alert.html">Sucursales Reporte</a></li>
        <li  class="nav-item{{ $activePage == 'sucursales2' ? ' active' : '' }}"><a href="reporteproducto" class="nav-link" href="bootstrap-badge.html">Productos Reporte</a></li>
      </ul>
    </li>
    <li class="menu-header">Modulos</li>
    <li class="dropdown {{ $activePage === 'categorias' || $activePage === 'productos' ? ' active' : '' }}">
      <a href="#" class="nav-link has-dropdown class="sidebar><i class="fas fa-archive"></i><span>Inventario</span></a>
      <ul class="dropdown-menu  ">
        <li class="nav-item"><a  href="{{ route('inventarios.create') }}">Registro Inventario</a></li> 
        <li class="nav-item{{ $activePage == 'categorias' ? ' active' : '' }}"><a  href="{{ route('categorias.index') }}">Categorias</a></li> 
        <li class="nav-item{{ $activePage == 'productos' ? ' active' : '' }}"><a  href="{{ route('productos.index') }}">Productos</a></li>
        <li class="nav-item{{ $activePage == 'productos' ? ' active' : '' }}"><a  href="{{ route('productos_proveedores.create') }}">Asignar Producto</a></li>
      </ul>
    </li>
    <li class="dropdown ">
      <a href="#" class="nav-link has-dropdown class="sidebar><i class="fas fa-building"></i><span>Sucursales</span></a>
      <ul class="dropdown-menu  ">
        <li class="nav-item"><a  href="{{ route('sucursales.index')}}">Sucursales</a></li> 
        <li class="nav-item"><a  href="">Bodega Principal</a></li> 
        <li class="nav-item"><a  href="{{ route('encargados.create') }}">Asignar Sucursal</a></li>
        <li class="nav-item"><a  href="{{ route('horarios.planillaHorarios') }}">Planilla de Horarios</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown class="sidebar><i class="fas fa-list"></i><span>Compras</span></a>
      <ul class="dropdown-menu  ">
        <li><a  href="auth-forgot-password.html">Inventario</a></li> 
        <li><a  href="auth-login.html">Solicitudes</a></li> 
        <li><a  href="auth-register.html">Traspasos</a></li> 
        <li><a  href="auth-reset-password.html">Eliminacion</a></li> 
      </ul>
    </li>
    <li class="dropdown  {{ $activePage === 'contratos'  ? ' active' : '' }}">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>RRHH</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-link" href="{{ route('departamentos.index') }}">Departamentos</a></li> 
        <li><a class="nav-link" href="errors-503.html">Planillas</a></li> 
        <li class="nav-item{{ $activePage == 'contratos' ? ' active' : '' }}"><a class="nav-link " href="{{ route('contratos.index') }}">Contratos</a></li> 
        <li class="nav-item{{ $activePage == 'personales' ? ' active' : '' }}"><a class="nav-link " href="{{ route('personales.index') }}">Personales</a></li> 
        <li><a class="nav-link" href="errors-404.html">Vacaciones</a></li> 
        <li><a class="nav-link" href="{{ route('bonos.index') }}">Bonos</a></li> 
        <li><a class="nav-link" href="{{ route('descuentos.index') }}">Descuentos</a></li> 
        <li><a class="nav-link" href="errors-500.html">Costo Mano de Obra</a></li> 
        <li><a class="nav-link" href="{{ route('sanciones.index')}}">Sanciones</a></li> 
        
      </ul>
    </li>

    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown"><i class="fas fa-car"></i> <span>Extra</span></a>
      <ul class="dropdown-menu">
        <li><a class="nav-item{{ $activePage == 'sucursales' ? ' active' : '' }}"  href="{{ route('sucursales.index') }}">Sucursales</a></li> 
        <li><a class="nav-link" href="{{ route('contratos.index') }}">Contrato</a></li> 
        <li><a class="nav-link" href="errors-404.html">Vacaciones</a></li> 
        <li><a class="nav-link" href="errors-500.html">Bonos</a></li> 
      </ul>
      
    </li>

    <!-- <li class="menu-header">Log Out</li>
    <li class="dropdown">
      <a href="#" class="nav-link has-dropdown class="sidebar><i class="fas fa-sign-out-alt"></i><span>Mas</span></a>
      <ul class="dropdown-menu  ">
        <li><a  href="auth-forgot-password.html">Editar Perfil</a></li> 
        <li><a  href="auth-login.html">Cambiar Contraseña</a></li>
        <li><a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>Salir</a></li> 
      </ul>
    </li> -->
    
    
    <style>
    
    
    </style>