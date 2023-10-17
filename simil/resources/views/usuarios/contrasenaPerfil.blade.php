<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIMIL</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset ('/dash/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset ('/dash/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('/dash/img/logo_simil.png') }}" alt="SIMIL Logo" style="width: 200px;">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <h1 class="h3 mb-0 text-gray-800">Ajustes de Usuario</h1>

            </div>

            <div id="mensaje-error" class="alert alert-danger" style="display: none;"></div>


<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif    
</div>

<div id="cambiar_contrasena_Perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña y Preguntas de Seguridad</h5>
            </div>
            <form action="/usuarios/contrasenaPerfil" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if($message = Session::get('EditInsert'))
                    <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
                        <h6>Errores:</h6>
                        <ul>
                            @foreach( $errors->all() as $error )
                            <li>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="form-group">
                    <label for="contrasena_anterior">Contraseña Anterior:</label>
                        <input type="password" name="contrasena_anterior" id="contrasena_anterior" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" aria-describedby="basic-addon2"  value="{{ old('editar_descripcion_descuento') }}" >
                    </div>

                    <div class="form-group">
                    <label for="contrasena">Contraseña Nueva:</label>
                        <input type="password" name="contrasena" id="contrasena" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" aria-describedby="basic-addon2"  value="{{ old('editar_descripcion_descuento') }}" >
                    </div>

                    <div class="form-group">
                        Confirmar Contraseña
                        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_porcentaje_descuento') }}">
                    </div>

                    <div class="form-group">
                        <select name="pregunta_usuario"  id="pregunta_usuario" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                        @foreach($preguntas_array[0] as $preguntas)
                        <option value="{{$preguntas['COD_PREGUNTA']}}">{{$preguntas['PREGUNTA']}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="respuesta" style="width: 70%;" class="form-control custom-input " placeholder="Ingresar respuesta" aria-describedby="basic-addon2">
                    </div>

                    <div class="form-group">
                        <select name="pregunta_usuario2"  id="pregunta_usuario2" class="form-control bg-light border-0 small" aria-describedby="basic-addon2">
                        @foreach($preguntas_array[0] as $preguntas)
                        <option value="{{$preguntas['COD_PREGUNTA']}}">{{$preguntas['PREGUNTA']}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="respuesta2" style="width: 70%;" class="form-control custom-input " placeholder="Ingresar respuesta" aria-describedby="basic-addon2">
                    </div>

                    <div class="form-group">
                    <div class="alert alert-info" style="font-size: 12px; width: 350px; " >
                    <small>
                    Las contraseñas deben contener mayúsculas, minúsculas, números, caracteres especiales, minimo 5 y maximo 8 caracteres para poder realizar el cambio. 
                    Ejemplo: Abc123@
                    </small>
                    </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #1cc88a; color: white; width 70%" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Cambiar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</script>
      

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Piratas Informaticos 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset ('/dash/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('/dash/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset ('/dash/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset ('/dash/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset ('/dash/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset ('/dash/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset ('/dash/js/demo/chart-pie-demo.js') }}"></script>
    @yield('scripts')

</body>
</html>