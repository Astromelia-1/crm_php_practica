<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AplicacionController extends Controller
{
    /**
     * Candidato aplica a una vacante
     */
    public function store(Request $request, $vacante_id)
    {
        if (Auth::user()->rol !== 'candidato') {
            return response()->json(['message' => 'Solo los candidatos pueden aplicar a vacantes'], 403);
        }

        $validator = Validator::make($request->all(), [
            'cv_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vacante = Vacante::find($vacante_id);

        if (!$vacante) {
            return response()->json(['message' => 'Vacante no encontrada'], 404);
        }

        // Verificar si el candidato ya aplicó a esta vacante
        if (Aplicacion::where('candidato_id', Auth::id())->where('vacante_id', $vacante_id)->exists()) {
            return response()->json(['message' => 'Ya has aplicado a esta vacante'], 400);
        }

        $aplicacion = Aplicacion::create([
            'id' => (string) Str::uuid(),
            'candidato_id' => Auth::id(),
            'vacante_id' => $vacante_id,
            'cv_url' => $request->cv_url,
            'estado' => 'en proceso',
        ]);

        return response()->json(['message' => 'Aplicación enviada exitosamente', 'aplicacion' => $aplicacion], 201);
    }

    /**
     * Reclutador actualiza el estado de una aplicación
     */
    public function update(Request $request, $id)
    {
        $aplicacion = Aplicacion::find($id);

        if (!$aplicacion) {
            return response()->json(['message' => 'Aplicación no encontrada'], 404);
        }

        $vacante = Vacante::find($aplicacion->vacante_id);

        if ($vacante->reclutador_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permisos para modificar esta aplicación'], 403);
        }

        $validator = Validator::make($request->all(), [
            'estado' => 'required|in:en proceso,contratado,rechazado',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $aplicacion->update(['estado' => $request->estado]);

        return response()->json(['message' => 'Estado de la aplicación actualizado', 'aplicacion' => $aplicacion]);
    }

    /**
     * Candidato ve sus aplicaciones
     */
    public function misAplicaciones()
    {
        if (Auth::user()->rol !== 'candidato') {
            return response()->json(['message' => 'Solo los candidatos pueden ver sus aplicaciones'], 403);
        }

        $aplicaciones = Aplicacion::where('candidato_id', Auth::id())->with('vacante')->get();

        return response()->json($aplicaciones);
    }

    /**
     * Reclutador ve las aplicaciones a su vacante
     */
    public function aplicacionesPorVacante($vacante_id)
    {
        $vacante = Vacante::find($vacante_id);

        if (!$vacante) {
            return response()->json(['message' => 'Vacante no encontrada'], 404);
        }

        if ($vacante->reclutador_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permisos para ver estas aplicaciones'], 403);
        }

        $aplicaciones = Aplicacion::where('vacante_id', $vacante_id)->with('candidato')->get();

        return response()->json($aplicaciones);
    }
}