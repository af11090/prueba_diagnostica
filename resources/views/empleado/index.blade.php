<!-- filepath: c:\Users\lucas\Downloads\prueba_diagnostica\resources\views\empleado\index.blade.php -->
@extends('layout.plantilla')

@section('title', 'Inicio de Empleados')

@section('content')
<div class="container">
    <h1>Empleados</h1>
    <a href="{{ route('empleado.create') }}" class="btn btn-success mb-3">Crear Empleado</a>
    <p>Lista de empleados registrados en el sistema.</p>
    <p>Para crear un nuevo empleado, haga clic en el botón "Crear Empleado".</p>
    <p>Para editar o eliminar un empleado, utilice los botones correspondientes en la tabla.</p>
    @if($empleados->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->apellido }}</td>
                    <td>{{ $empleado->dni }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->fecha_nacimiento }}</td>
                    <td>
                        <a href="{{route('empleado.show', $empleado->id)}}" class="btn btn-primary btn-sm">Ver</a>
                        <a href="{{route('empleado.edit', $empleado->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$empleado->id}}">
                            Eliminar
                        </button>

                        <!-- Modal para cada empleado -->
                        <div class="modal fade" id="deleteModal{{$empleado->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$empleado->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$empleado->id}}">Confirmar eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea eliminar al empleado {{$empleado->nombre}} {{$empleado->apellido}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="{{route('empleado.destroy', $empleado->id)}}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay empleados registrados.</p>
    @endif
</div>
@endsection
