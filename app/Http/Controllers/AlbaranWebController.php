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
        /* $albaran = Albaran::findOrFail($id); */

        return view('show');
    }

    public function create() {
        return view('create');
    }


}
