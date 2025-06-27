@extends('templates.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<a href="/crearAlbaran" class="green-button-generic">Añadir Albarán</a>

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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($albaranes as $albaran)
                <tr>
                    <td>{{ $albaran['id'] }}</td>
                    <td>{{ $albaran['nombre'] }}</td>
                    <td>{{ $albaran['subnombre'] }}</td>
                    <td><a href="{{ asset($albaran['archivo']) }}" target="_blank">Ver PDF</a></td>
                    <td>{{ $albaran['fecha'] }}</td>
                    <td>{{ $albaran['created_at'] }}</td>
                    <td class="acciones">
                        <a class="deleteLink" href="#" data-id="{{ $albaran['id'] }}" onclick="event.preventDefault(); confirmarEliminacion(this)">
                            <img class="trashIcon" src="{{ asset('images/delete.png') }}" alt="Eliminar">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

<!-- SCRIPTS -->

<script>
    function confirmarEliminacion(element) {
        const id = element.getAttribute('data-id');
    
        if (confirm('¿Estás seguro de que deseas eliminar este albarán? Esta acción no se puede deshacer.')) {
            fetch('/api/EliminarAlbaran/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    const row = element.closest('tr');
                    row.remove();
                } else {
                    /* alert('Error al eliminar el albarán'); */
                    return response.json().then(data => {
                        alert('Error: ' + (data?.error ?? 'Error al eliminar el albarán'));
                    });
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error al eliminar el albarán');
            });
        }

    }
</script>