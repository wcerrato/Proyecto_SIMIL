@extends('layouts.main')

@section('contenido')

<div class="row">
    @if($message = Session::get('mensaje_guardado'))
    <div class="col-12 alert alert-danger alert-dismissable fade show" role='alert'>
        <span>{{ $message }}</span>
    </div>
    @endif    
</div>

<div id="cambiar_contrasena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
            </div>
            <form action="/usuarios/contrasena" method="post">
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
                        Contraseña
                        <input type="password" name="contrasena" id="contrasena" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_descripcion_descuento') }}">
                    </div>
                    <div class="form-group">
                        Confirmar Contraseña
                        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" style="width: 70%;" class="form-control bg-light border-0 small" aria-describedby="basic-addon2" value="{{ old('editar_porcentaje_descuento') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="background-color: #1cc88a; color: white;" class="d-none d-sm-inline-block btn btn-sm shadow-sm">
                        <i class="fas fa-check-circle fa-sm text-white-50"></i> Cambiar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection