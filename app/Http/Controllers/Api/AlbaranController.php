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
            'id'       => $albaran->id,
            'nombre'   => $albaran->nombre,
            'subnombre'=> $albaran->subnombre,
            'archivo'  => $albaran->archivo,
            'fecha'    => $albaran->fecha
        ]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request) {
        
        $request->validate([
            'nombre'   => 'required|string',
            'subnombre'=> 'required|string',
            'archivo'  => 'required|file|mimes:pdf',
            'fecha'    => 'required|date',
        ]);

        $rutaArchivo = $request->file('archivo')->store('albaranes', 'public');

        $albaran = Albaran::create([
            'nombre'   => $request->nombre,
            'subnombre'=> $request->subnombre,
            'archivo'  => $rutaArchivo,
            'fecha'    => $request->fecha,
        ]);

        return response()->json([
            'mensaje' => 'Albarán guardado correctamente',
            'albaran' => $albaran
        ], 201);
    }

    // Remove the specified resource from storage.
    public function destroy(string $id) {

        $albaran = Albaran::find($id);

        $albaran->delete();

        return response()->json([
            'mensaje' => 'Albarán eliminado correctamente'
        ], 200);
    }
}
