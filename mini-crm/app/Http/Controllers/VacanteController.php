<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VacanteController extends Controller
{
    /**
     * Listar todas las vacantes
     */
    public function index()
    {
        $vacantes = Vacante::all();
        return response()->json($vacantes);
    }

    /**
     * Mostrar una vacante específica
     */
    public function show($id)
    {
        $vacante = Vacante::find($id);

        if (!$vacante) {
            return response()->json(['message' => 'Vacante no encontrada'], 404);
        }

        return response()->json($vacante);
    }

    /**
     * Crear una nueva vacante (solo reclutadores)
     */
    public function store(Request $request)
    {
        if (Auth::user()->rol !== 'reclutador') {
            return response()->json(['message' => 'No tienes permisos para crear vacantes'], 403);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'requisitos' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vacante = Vacante::create([
            'id' => (string) Str::uuid(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'requisitos' => $request->requisitos,
            'reclutador_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Vacante creada exitosamente', 'vacante' => $vacante], 201);
    }

    /**
     * Actualizar una vacante (solo el reclutador que la creó)
     */
    public function update(Request $request, $id)
    {
        $vacante = Vacante::find($id);

        if (!$vacante) {
            return response()->json(['message' => 'Vacante no encontrada'], 404);
        }

        if ($vacante->reclutador_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permisos para editar esta vacante'], 403);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'requisitos' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vacante->update($request->only(['titulo', 'descripcion', 'requisitos']));

        return response()->json(['message' => 'Vacante actualizada exitosamente', 'vacante' => $vacante]);
    }

    /**
     * Eliminar una vacante (solo el reclutador que la creó)
     */
    public function destroy($id)
    {
        $vacante = Vacante::find($id);

        if (!$vacante) {
            return response()->json(['message' => 'Vacante no encontrada'], 404);
        }

        if ($vacante->reclutador_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permisos para eliminar esta vacante'], 403);
        }

        $vacante->delete();

        return response()->json(['message' => 'Vacante eliminada correctamente']);
    }
}
