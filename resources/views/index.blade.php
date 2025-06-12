@extends('templates.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<h1>Listado de albaranes</h1>

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
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td><a href="">Ver PDF</a></td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
            </tr>
            <tr>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td><a href="">Ver PDF</a></td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
                <td>Ejemplo</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection