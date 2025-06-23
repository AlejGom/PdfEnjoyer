<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Albaran;

class AlbaranWebController extends Controller
{
    // Functions for showing views
    public function index() {

        // Api call
        $response  = Http::get('http://192.168.1.20/api/albaranes')->json();
        $albaranes = $response['albaranes'];

        return view('index', [
            'albaranes'=> $albaranes,
        ]);
        
        // DB call
        /* $albaranes = Albaran::all();

        return view('index', [
            'albaranes' => $albaranes,
        ]); */
    }

    public function show($id) {
        
        // Api call
        $albaran = Http::get('http://192.168.1.20/api/albaranes/'.$id)->json();
        
        return view('show', [
            'albaran'=> $albaran
        ]);
        
        
        // DB call
        /* $albaran = Albaran::find($id);

        return view('show', [
            'albaran'=> $albaran
        ]); */
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        
        $request->validate([
            'subnombre' => 'required|string',
            'archivo'   => 'required|file|mimes:pdf',
            'fecha'     => 'required|date',
        ]);

        $archivo = $request->file('archivo');

        $response = Http::attach(
            'archivo',
            file_get_contents($archivo),
            $archivo->getClientOriginalName()
        )->post('http://192.168.1.20/api/CrearAlbaran', [
            'subnombre' => $request->subnombre,
            'fecha'     => $request->fecha,
        ]);

        if($response->successful()) {
            return redirect('/');
        } else {
            return back()->with('error', 'Error al crear el albarán');
        }
    }


}
