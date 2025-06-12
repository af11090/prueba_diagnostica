<!-- filepath: c:\Users\lucas\Downloads\prueba_diagnostica\resources\views\empleado\index.blade.php -->
@extends('layout.plantilla')

@section('title', 'Inicio de Empleados')

@section('content')
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center mb-4">
            <h1>Empleados</h1>

            <a href="{{ route('empleado.create') }}" class="btn btn-primary"> Agregar <i class="fas fa-plus"></i></a>
        </div>
        <!-- Formulario de filtros -->
        <form method="GET" action="{{ route('empleado.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <select name="area_id" class="form-control">
                        <option value="">-- Área --</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="cargo_id" class="form-control">
                        <option value="">-- Cargo --</option>
                        @foreach ($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ request('cargo_id') == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="local_id" class="form-control">
                        <option value="">-- Local --</option>
                        @foreach ($locales as $local)
                            <option value="{{ $local->id }}" {{ request('local_id') == $local->id ? 'selected' : '' }}>
                                {{ $local->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i></button>
                </div>
            </div>
        </form>
        @if ($empleados->count() > 0)
            <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="d-none d-md-table-cell">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col" class="d-none d-sm-table-cell">DNI</th>
                        <th scope="col" class="d-none d-lg-table-cell">Email</th>
                        <th scope="col" class="d-none d-md-table-cell">Fecha de Nacimiento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td class="d-none d-md-table-cell">{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->apellido }}</td>
                            <td class="d-none d-sm-table-cell">{{ $empleado->dni }}</td>
                            <td class="d-none d-lg-table-cell">{{ $empleado->email }}</td>
                            <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($empleado->fecha_nacimiento)->format('d/m/Y') }}</td>
                            <td>
                                <!-- Botones visibles en pantallas medianas y grandes -->
                                <div class="d-none d-md-block">
                                    <a href="{{ route('empleado.show', $empleado->id) }}" class="btn btn-primary btn-sm"
                                        title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('empleado.edit', $empleado->id) }}" class="btn btn-warning btn-sm"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $empleado->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#bajaModal{{ $empleado->id }}">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </div>

                                <!-- Menú desplegable para pantallas pequeñas -->
                                <div class="dropdown d-md-none">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $empleado->id }}" data-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $empleado->id }}">
                                        <a class="dropdown-item" href="{{ route('empleado.show', $empleado->id) }}"><i class="fas fa-eye mr-2"></i>Ver</a>
                                        <a class="dropdown-item" href="{{ route('empleado.edit', $empleado->id) }}"><i class="fas fa-edit mr-2"></i>Editar</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal{{ $empleado->id }}"><i class="fas fa-trash mr-2"></i>Eliminar</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bajaModal{{ $empleado->id }}"><i class="fas fa-user-slash mr-2"></i>Dar de Baja</a>
                                    </div>
                                </div>
                                <!-- Modal para cada empleado -->
                                <div class="modal fade" id="deleteModal{{ $empleado->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $empleado->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $empleado->id }}">Confirmar
                                                    eliminación</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea eliminar al empleado <span
                                                    class="font-weight-bold fs-4">{{ $empleado->nombre }}
                                                    {{ $empleado->apellido }}</span>?
                                                Se eliminará permanentemente de la base de datos y no podrá ser recuperado
                                                todos sus datos y contratos asociados.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('empleado.destroy', $empleado->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal para Dar de Baja -->
                                <div class="modal fade" id="bajaModal{{ $empleado->id }}" tabindex="-1"
                                    aria-labelledby="bajaModalLabel{{ $empleado->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bajaModalLabel{{ $empleado->id }}">Confirmar
                                                    baja</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro que desea dar de baja al empleado <span
                                                    class="font-weight-bold fs-4">{{ $empleado->nombre }}
                                                    {{ $empleado->apellido }}</span>?
                                                El empleado quedará inactivo pero sus datos no serán eliminados.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('empleado.baja', $empleado->id) }}" method="POST"
                                                    style="display:inline;">
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
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $empleados->links() }}
            </div>
        @else
            <p>No hay empleados registrados.</p>
        @endif
    </div>
@endsection
