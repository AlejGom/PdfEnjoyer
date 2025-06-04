<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrato;

class ContratoController extends Controller
{

    public function mostrarSaludo() {
        return response()->json(['mensaje' => 'Hello World From API PdfHandler']);
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string',
            'subnombre'=> 'required|string',
            'archivo'  => 'required|file|mimes:pdf',
            'fecha'    => 'required|date',
        ]);

        $rutaArchivo = $request->file('archivo')->store('albaranes', 'public');

        $albaran = Contrato::create([
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
