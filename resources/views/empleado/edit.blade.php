@extends('layout.plantilla')
@section('title', 'Editar Empleado')
@section('content')
<div class="container">
    <h1>Editar Empleado</h1>

    <form action="{{ route('empleado.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $empleado->apellido }}" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ $empleado->dni }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->email }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ date('Y-m-d', strtotime($empleado->fecha_nacimiento)) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
    </form>
    <a href="{{ route('empleado.index') }}" class="btn btn-secondary mt-3">Volver a la lista de empleados</a>
</div>
@endsection
