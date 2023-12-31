<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                <img src="{{ asset('/dash/img/logo_simil.png') }}" alt="SIMIL Logo" style="width: 200px;">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span style="color: black ">Panel Inicial</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Módulos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span style="color: black ">Administración</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Administración:</h6>
                        <a class="collapse-item" href="/administracion/reportes">Reportes</a>
                        <a class="collapse-item" href="/administracion/sucursal">Sucursal</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventarios"
                    aria-expanded="true" aria-controls="collapseInventarios">
                    <i class="fas fa-fw fa-archive"></i>
                    <span style="color: black ">Inventario</span>
                </a>
                <div id="collapseInventarios" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Inventarios:</h6>
                        <a class="collapse-item" href="/inventarios/inventario">Inventario</a>
                        <a class="collapse-item" href="/inventarios/productos">Productos</a>
<!--                        <a class="collapse-item" href="/inventarios/tipo_movimiento">Tipo Movimiento</a>-->
                        <a class="collapse-item" href="/inventarios/ajustes">Ajustes</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFacturacion"
                    aria-expanded="true" aria-controls="collapseFacturacion">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span style="color: black ">Facturación</span>
                </a>
                <div id="collapseFacturacion" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Facturación:</h6>
                        <a class="collapse-item" href="/facturacion/descuentos">Descuentos</a>
<!--                        <a class="collapse-item" href="/facturacion/dias_credito">Dias Credito</a>-->
<!--                        <a class="collapse-item" href="/facturacion/estado_factura">Estado Factura</a>-->
                        <a class="collapse-item" href="/facturacion/facturas">Facturas</a>
                        <a class="collapse-item" href="/facturacion/forma_pago">Forma de Pago</a>
                        <a class="collapse-item" href="/facturacion/numeraciones_sar">Numeraciones SAR</a>
                        <a class="collapse-item" href="/facturacion/tipo_factura">Tipo de Factura</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras"
                    aria-expanded="true" aria-controls="collapseCompras">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span style="color: black ">Compras</span>
                </a>
                <div id="collapseCompras" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Compras:</h6>
                        <a class="collapse-item" href="/compras/categorias">Categorías</a>
                        <a class="collapse-item" href="/compras/compras">Compras</a>
                        <a class="collapse-item" href="/compras/proveedores">Proveedores</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes"
                    aria-expanded="true" aria-controls="collapseClientes">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span style="color: black ">Clientes</span>
                </a>
                <div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Clientes:</h6>
                        <a class="collapse-item" href="/clientes/clientes">Clientes</a>
                        <a class="collapse-item" href="/clientes/personas">Personas</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios"
                    aria-expanded="true" aria-controls="collapseUsuarios">
                    <i class="fas fa-fw fa-user"></i>
                    <span style="color: black ">Usuarios</span>
                </a>
                <div id="collapseUsuarios" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Módulos de Usuarios:</h6>
                        <a class="collapse-item" href="/usuarios/usuarios">Usuarios</a>
                        <a class="collapse-item" href="/usuarios/permisos">Permisos</a>
                        <a class="collapse-item" href="/usuarios/roles">Roles</a>
                        <a class="collapse-item" href="/usuarios/objetos">Objetos</a>
                        <a class="collapse-item" href="/usuarios/bitacora">Bitácora</a>
<<<<<<< HEAD
=======
                        <a class="collapse-item" href="/usuarios/parametros_generales">Parámetros Generales</a>
>>>>>>> a21a0e59a4c7d7268e56ec9f9b6ee908436bdc30
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

</ul>