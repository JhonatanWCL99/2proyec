<ul class="sidebar-menu sidebar">
    <li class="menu-header ">Dashboard</li>
    <li class="dropdown {{ $activePage == 'home' ? ' active' : '' }}">
        <a href="{{ route('home') }}"><i class="fas fa-home titulo"></i><span
                class="titulo">Dashboard</span></a>
    </li>
    <li class="menu-header">Administracion</li>
    <li class="dropdown {{ $activePage === 'proveedores' ? ' active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users titulo"></i> <span
                class="titulo">Usuarios</span></a>
        <ul class="dropdown-menu ">
            <li class="nav-item{{ $activePage == 'proveedores' ? ' active' : '' }}"><a
                    href="{{ route('proveedores.index') }}" class="nav-link"
                    href="layout-transparent.html">Proveedores</a></li>
        </ul>
        @role('Super Admin')
            <a href="{{ route('roles.index') }}"><i class="fa fa-user-lock f-left titulo"></i><span
                    class="titulo">Roles</span></a>
        @endrole
        
            <a href="{{ route('horarios.create') }}"><i class="fa fa-user-circle"></i><span
                    class="titulo">Marcar Asistencia</span></a>
       

    </li>

    <li class="menu-header">Modulos</li>

    <li
        class="dropdown {{ $activePage === 'categorias' || $activePage === 'productos' || $activePage === 'productos_proveedores'? ' active': '' }}">
        @role('Super Admin')
            <a href="inventario" class="nav-link has-dropdown "><i class="fas fa-archive"></i><span>Inventario</span></a>
            <ul class="dropdown-menu  ">
            @endrole

            @can('categorias.index')
                <li class="nav-item{{ $activePage == 'categorias' ? ' active' : '' }}"><a
                        href="{{ route('categorias.index') }}">Categorias</a></li>
            @endcan
            @can('productos.index')
                <li class="nav-item{{ $activePage == 'productos' ? ' active' : '' }}"><a
                        href="{{ route('productos.index') }}">Productos</a></li>
            @endcan
            @can('productos_proveedores.create')
                <li class="nav-item{{ $activePage == 'productos_proveedores' ? ' active' : '' }}"><a
                        href="{{ route('productos_proveedores.create') }}">Asignar Producto</a></li>
            @endcan

        </ul>
    </li>
    <li class="dropdown">
        <a href="" class="nav-link has-dropdown"><i class="fas fa-shopping-bag"></i> <span> Compras</span></a>
        <ul class="dropdown-menu">
            <li class="nav-item"> <a href="{{ route('compras.index') }}">Compra</a> </li>
        </ul>

    </li>

    {{-- <li class="dropdown ">
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
    </li> --}}
    <li
        class="dropdown  {{ $activePage === 'contratos' ||$activePage === 'personales' ||$activePage === 'contratos' ||$activePage === 'departamentos' ||$activePage === 'bonos' ||$activePage === 'descuentos' ||$activePage === 'horarios' ||$activePage === 'sanciones'? ' active': '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>RRHH</span></a>
        <ul class="dropdown-menu">
            @role('Super Admin')
                <li class="nav-item{{ $activePage == 'departamentos' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('departamentos.index') }}">Departamentos</a></li>
                <li class="nav-item{{ $activePage == 'contratos' ? ' active' : '' }}"><a class="nav-link "
                        href="{{ route('contratos.index') }}">Contratos</a></li>
                <li class="nav-item{{ $activePage == 'bonos' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('bonos.index') }}">Bonos</a></li>
                <li class="nav-item{{ $activePage == 'descuentos' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('descuentos.index') }}">Descuentos</a></li>
                <li class="nav-item{{ $activePage == 'horarios' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('horarios.index') }}">Horario Personal</a></li>  
                <li class="nav-item{{ $activePage == 'manoObra' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('horarios.store') }}">Costo Mano de Obra</a></li>
                <li class="nav-item{{ $activePage == 'sanciones' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('sanciones.index') }}">Sanciones</a></li>
                <li class="nav-item{{ $activePage == 'vacaciones' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('vacaciones.index') }}">Vacaciones</a></li>
                    
                <li class="nav-item{{ $activePage == 'cronologias' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('cronologias.index') }}">Cronologias</a></li>
                <li class="nav-item{{ $activePage == 'observaciones' ? ' active' : '' }}"><a class="nav-link"
                        href="{{ route('observaciones.index') }}">Observaciones</a></li>
            @endrole

            <li class="nav-item{{ $activePage == 'personales' ? ' active' : '' }}"><a class="nav-link "
                    href="{{ route('personales.index') }}">Personales</a></li>

        </ul>
    </li>


    <style>


    </style>
