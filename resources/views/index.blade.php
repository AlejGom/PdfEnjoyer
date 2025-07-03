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
                        <a class="actionsLink" href="#" data-id="{{ $albaran['id'] }}" onclick="event.preventDefault(); confirmarEliminacion(this)">
                            <img class="actionIcon" src="{{ asset('images/delete.png') }}" alt="Eliminar">
                        </a>
                        <a class="actionsLink" href="#" data-id="{{ $albaran['id'] }}" onclick="event.preventDefault(); abrirModal(this)" >
                            <img class="actionIcon" src="{{ asset('images/edit.png') }}" alt="Editar">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

<!-- MODAL -->
<div id="modalEdicion" class="modal">
    <div class="modal-content formulario-container">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Editar Albarán</h2>

        <form id="formularioEditar" class="formulario-albaran">
            <input type="hidden" id="edit_id" name="id">

            <div class="form-group">
                <label for="edit_subnombre">Subnombre *</label>
                <input type="text" id="edit_subnombre" name="subnombre" required>
            </div>

            <div class="form-group">
                <label for="edit_fecha">Fecha *</label>
                <input type="date" id="edit_fecha" name="fecha" required>
            </div>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</div>


<!-- SCRIPTS -->

<script>
    /* Función para confirmar la eliminación */
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

    /* Función para abrir el modal */
    function abrirModal(element) {
        const id = element.getAttribute('data-id');

        fetch(`/api/albaranes/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_subnombre').value = data.subnombre;
            document.getElementById('edit_fecha').value = data.fecha;

            document.getElementById('modalEdicion').style.display = 'block';
        })
        .catch(error => {
            console.error(error);
            alert('Error al cargar el albarán');
        });
    }

    /* Función para cerrar el modal */
    function cerrarModal() {
        document.getElementById('modalEdicion').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const formularioEditar = document.getElementById('formularioEditar');
        
        formularioEditar.addEventListener('submit', function(e) {
            e.preventDefault();

            const id        = document.getElementById('edit_id').value;
            const subnombre = document.getElementById('edit_subnombre').value;
            const fecha     = document.getElementById('edit_fecha').value;

            fetch('/api/EditarAlbaran/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ subnombre, fecha })
            })
            .then(response => {
                if (response.ok) {
                    /* alert('Albarán editado correctamente'); */
                    cerrarModal();
                    location.reload();
                } else {
                    return response.json().then(data => {
                        alert('Error: ' + (data?.error ?? 'Error al editar el albarán'));
                    });
                }
            })
            .catch(error => {
                console.error('Error al actualizar', error);
                alert('Error al editar el albarán');
            });
        });
    });
</script>