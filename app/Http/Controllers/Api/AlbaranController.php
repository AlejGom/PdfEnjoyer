<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Albaran;

class AlbaranController extends Controller
{
        // Display de prueba
    public function mostrarSaludo() {
        return response()->json(['mensaje' => 'Hello World From API PdfHandler']);
    }

    // Display a listing of the resource.
    public function index() {
        $albaran = Albaran::all();

        return response()->json([
            'albaranes' => $albaran
        ]);
    }

    // Display the specified resource.
    public function show(string $id) {
        $albaran = Albaran::find($id);

        return response()->json([
            'id'         => $albaran->id,
            'nombre'     => $albaran->nombre,
            'subnombre'  => $albaran->subnombre,
            'archivo'    => $albaran->archivo,
            'fecha'      => $albaran->fecha,
            'created_at' => $albaran->created_at,
        ]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request) {
        
        $request->validate([
            'subnombre'=> 'required|string',
            'archivo'  => 'required|file|mimes:pdf',
            'fecha'    => 'required|date',
        ]);

        $archivo     = $request->file('archivo');
        $nombreBase  = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
        $rutaArchivo = $archivo->store('albaranes', 'public');

        $albaran = Albaran::create([
            'nombre'     => $nombreBase,
            'subnombre'  => $request->subnombre,
            'archivo'    => 'storage/' . $rutaArchivo,
            'fecha'      => $request->fecha,
        ]);
        
        return response()->json([
            'mensaje' => 'Albarán guardado correctamente',
            'albaran' => $albaran
        ], 201);
    }

    // Remove the specified resource from storage.
    public function destroy(string $id) {

        $albaran = Albaran::find($id);

        if (!$albaran) {
            return response()->json([
                'error' => 'Albarán no encontrado'
            ], 404);
        }

        $albaran->delete();

        return response()->json([
            'mensaje' => 'Albarán eliminado correctamente'
        ], 200);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id) {

        $albaran = Albaran::find($id);

        if (!$albaran) {
            return response()->json([
                'error' => 'Albarán no encontrado'
            ], 404);
        }

        $request->validate([
            'subnombre' => 'required|string|max:255',
            'fecha'     => 'required|date',
        ]);

        $albaran->subnombre = $request->input('subnombre');
        $albaran->fecha     = $request->input('fecha');
        $albaran->save();

        return response()->json([
            'mensaje' => 'Albarán actualizado correctamente',
            'albaran' => $albaran
        ]);
    }
}
