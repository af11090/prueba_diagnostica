<!-- filepath: c:\Users\lucas\Downloads\prueba_diagnostica\resources\views\empleado\index.blade.php -->
@extends('layout.plantilla')

@section('title', 'Inicio de Empleados')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Empleados</h1>
        <a href="{{ route('empleado.create') }}" class="btn btn-primary"> Agregar <i class="fas fa-plus"></i></a>
    </div>
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
                        <a href="{{route('empleado.show', $empleado->id)}}" class="btn btn-primary btn-sm" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('empleado.edit', $empleado->id)}}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$empleado->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#bajaModal{{$empleado->id}}">
                            Dar de Baja
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
                                        ¿Está seguro que desea eliminar al empleado <span class="font-weight-bold fs-4">{{$empleado->nombre}} {{$empleado->apellido}}</span>?
                                        Se eliminará permanentemente de la base de datos y no podrá ser recuperado todos sus datos y contratos asociados.
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
                        <!-- Modal para Dar de Baja -->
                        <div class="modal fade" id="bajaModal{{$empleado->id}}" tabindex="-1" aria-labelledby="bajaModalLabel{{$empleado->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bajaModalLabel{{$empleado->id}}">Confirmar baja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea dar de baja al empleado <span class="font-weight-bold fs-4">{{$empleado->nombre}} {{$empleado->apellido}}</span>?
                                        El empleado quedará inactivo pero sus datos no serán eliminados.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('empleado.baja', $empleado->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Dar de Baja</button>
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
