<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;


class RecuperacionController extends Controller
{
    public function index()
    {
        // Lógica para mostrar la vista de recuperación de contraseña
        $preguntas = HTTP::get('http://127.0.0.1:9000/api/simil/preguntas');
        $preguntas_array = $preguntas->json();

        return view('/usuarios/recuperacion', compact('preguntas_array'));
    }

    public function verificar(Request $request)
    {
        // Validación de los campos en el formulario
        $validator = Validator::make($request->all(), [
            'usuario' => 'required',
            'pregunta_usuario' => 'required',
            'respuesta' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        } else {
            // Resto del código para verificar las respuestas
            $preguntaSeleccionada = $request->input('pregunta_usuario');
            
            $usuario = Http::get('http://127.0.0.1:9000/api/simil/usuario');
            $usuarios_array = $usuario->json();

            $respuesta = Http::get('http://127.0.0.1:9000/api/simil/respuestas');
            $respuesta_array = $respuesta->json();


            session(['recuperacion' => 'FALSE']);

            foreach ($usuarios_array[0] as $usuario) {
                foreach ($respuesta_array[0] as $respuesta) { // Itera sobre las respuestas
                    if (
                        $usuario['COD_USUARIO'] == $request->usuario &&
                        $respuesta['COD_PREGUNTA'] == $request->pregunta_usuario&&
                        $respuesta['RESPUESTA'] == $request->respuesta
                    ) {
                        session(['recuperacion' => 'TRUE']);
                        session(['user' => $usuario['COD_USUARIO']]);
                        return view('/usuarios/contrasena');
                    }
                }
            }

            session(['recuperacion' => 'FALSE']);
            return back()->with('mensaje_guardado', 'Usuario, pregunta o respuesta incorrectos.');
        }
    }
}
