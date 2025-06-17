@extends('templates.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<h1>Detalle de un albaran</h1>

<div class="tabla-container">
    <table class="tabla-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Subnombre</th>
                <th>Archivo</th>
                <th>Fecha</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $albaran['id'] }}</td>
                    <td>{{ $albaran['nombre'] }}</td>
                    <td>{{ $albaran['subnombre'] }}</td>
                    <td><a href="{{ asset($albaran['archivo']) }}" target="_blank">Ver PDF</a></td>
                    <td>{{ $albaran['fecha'] }}</td>
                    <td>{{ $albaran['created_at'] }}</td>
                </tr>
        </tbody>
    </table>
</div>

@endsection