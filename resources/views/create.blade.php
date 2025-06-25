@extends('templates.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<a href="/" class="green-button-generic">Albaranes</a>

<h1>Crear Albarán</h1>

<div class="formulario-container">
    <form action="{{ route('addAlbaran') }}" method="POST" enctype="multipart/form-data" class="formulario-albaran">
        @csrf

        <div class="form-group">
            <label for="subnombre">Subnombre *</label>
            <input type="text" name="subnombre" id="subnombre" required>
        </div>

        <div class="form-group">
            <label for="archivo">Archivo PDF *</label>
            <input type="file" name="archivo" id="archivo" accept="application/pdf" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha *</label>
            <input type="date" name="fecha" id="fecha" required>
        </div>

        <button type="submit">Guardar albarán</button>
    </form>
</div>

@endsection
