<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Albaran;

class AlbaranWebController extends Controller
{
    // Functions for showing views
    public function index() {
        return view('index');
    }

    public function show($id) {
        $albaran = Albaran::find($id);

        return view('show', [
            'albaran'=> $albaran
        ]);
    }

    public function create() {
        return view('create');
    }


}
