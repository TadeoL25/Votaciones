<?php

namespace App\Http\Controllers;

use App\Models\candidato;
use App\Models\votacion;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function candidatoInicio()
    {
        $candidatos = candidato::all(); 
        return view('candidatos', ['candidatos' => $candidatos]);
    }

    public function votacionesInicio()
    {
        $candidatos = candidato::all();
        $votaciones = votacion::all();
        return view('votaciones', ['candidatos' => $candidatos, 'votaciones' => $votaciones]);
    }

    public function estadisticasInicio()
    {
        $candidatos = candidato::all();
        return view('estadisticas', ['candidatos' => $candidatos]);
    }

    public function candidatoNuevo(Request $request)
    {
        $candidato = new candidato();
        $candidato->nombre = $request->nombre;
        $candidato->votos = 0;
        $candidato->direccion = $request->direccion;
        $candidato->telefono = $request->telefono;
        $candidato->save();
        return redirect()->route('candidato.inicio');
    }

    public function candidatoVotar(Request $request)
    {
        $candidato = candidato::find($request->id);
        $candidato->votos = $candidato->votos + 1;
        $candidato->save();
        return redirect()->route('votaciones.inicio');
    }

    public function candidatoEliminar(Request $request)
    {
        $candidato = candidato::find($request->id);
        $candidato->delete();
        return redirect()->back();
    }

    public function candidatoEditar(Request $request)
    {
        $idCandidato = $request->id;

        $candidato = candidato::find($idCandidato);

        $candidato->nombre = $request->nombre;
        $candidato->direccion = $request->direccion;
        $candidato->telefono = $request->telefono;
        $candidato->save();

        return redirect()->back();
    }

    //Votaciones
    public function votacionesNuevo(Request $request)
    {
        // Verificar si ya existe una votación para el candidato seleccionado
        $votacionExistente = votacion::where('candidato', $request->candidato)->first();
        
        // Si ya existe una votación para el candidato, redirigir con un mensaje de error
        if ($votacionExistente) {
            return redirect()->back()->with('error', 'Ya existe una votación para este candidato.');
        }

        // Si no existe una votación para el candidato, proceder con la creación de la votación
        $votacion = new votacion();
        $votacion->candidato = $request->candidato;
        $votacion->save();
        return redirect()->route('votaciones.inicio');
    }


    public function votacionesVotar(Request $request)
    {
        $votacion = votacion::find($request->id);
        $candidato = candidato::where('nombre', $votacion->candidato)->first();
        $candidato->votos += 1;
        $user = $request->user();
        $user->voto = 'si';
        $candidato->save();
        $user->save();
        return redirect()->back();
    }


    public function votacionesEliminar(Request $request)
    {
        $votacion = votacion::find($request->id);
        $votacion->delete();
        return redirect()->back();
    }
}
