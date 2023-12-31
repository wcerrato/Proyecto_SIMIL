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

<body id="page-top">

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

                        <h1 class="h3 mb-0 text-gray-800">Bienvenido</h1>

                    </div>

                    <div class="row">
                        @if($message = Session::get('mensaje_guardado'))
                        <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
                            <span>{{ $message }}</span>
                        </div>
                        @endif    
                    </div>

                    <div  id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión </h5>
                                </div>
                                <form action="/" method="post" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        @if($message = Session::get('ErrorInsert'))
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
                                            <div class="input-group">
                                                <input type="text" name="usuario" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Ingresar Usuario" aria-describedby="basic-addon2" oninput="mayus(this); noespacio(this);" onkeypress="return soloLetras(event);"´
                                                autocomplete="off"  oncut="return false" oncopy="return false" onpaste="return false">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" name="contrasena" style="width: 70%;" class="form-control bg-light border-0 small" placeholder="Ingresar Contraseña" aria-describedby="basic-addon2"
                                                autocomplete="off"  oncut="return false" oncopy="return false" onpaste="return false"onkeyup="sinespacio(this);">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="padding: 0;">
                                                        <i class="fas fa-eye" id="togglePassword" style="cursor: pointer; font-size: 16px;"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                    <div class="d-flex justify-content-between align-items-start" style="width: 100%;">
                                        <!-- Enlace "Olvidaste tu contraseña?" -->
                                        <a  href="/usuarios/recuperacion" class="text-left">¿Olvidaste tu contraseña?</a>
                                    </div>
    
                                        <!-- Botón "Acceder" -->
                                    <button type="submit" style="background-color: #1cc88a; color: white; min-width: 200px;" class="btn btn-sm shadow-sm">
                                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Acceder
                                    </button>
                                    </div>




                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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

    <!-- Activar la vista en la contraseña -->
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('input[name="contrasena"]');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    </script>

    <!-- Validar solo Mayusculas en el txt -->
    <script type="text/javascript">
      function mayus(e) {
        e.value = e.value.toUpperCase();
      }
    </script>
    <!-- Validar solo letras en el txt -->
    <script>
      function soloLetras(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = ["8-37-39-46"];

        tecla_especial = false
        for(var i in especiales){
          if(key == especiales[i]){
            tecla_especial = true;
            break;
          }
        }

        if(letras.indexOf(tecla)==-1 &&!tecla_especial){
          return false;
        }
      }
    </script>

        <!-- Validar sin espacios en el usuario -->
    <script language="javascript">
        function noespacio(campo, event) {
        CadenaaReemplazar = " ";
        CadenaReemplazo = "";
        CadenaTexto = campo.value;
        CadenaTextoNueva = CadenaTexto.split(CadenaaReemplazar).join(CadenaReemplazo);
        campo.value = CadenaTextoNueva;
        }
    </script>  

    <!-- Validar sin espacios en la contraseña -->
    <script type="text/javascript">
      function sinespacio(e) { 
        var cadena =  e.value;
        var limpia = "";
        var parts = cadena.split(" ");
        var length = parts.length;
        for (var i = 0; i < length; i++) {
          nuevacadena = parts[i];
          subcadena = nuevacadena.trim();
          if(subcadena != "") {
            limpia += subcadena + " ";
          }
        }
        limpia = limpia.trim();
        e.value = limpia;
      };
    </script>
</body>

</html>