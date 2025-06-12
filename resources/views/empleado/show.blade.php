@extends('layout.plantilla')
@section('title', 'Detalle del Empleado')
@section('content')
<div class="container">
    <h1>Detalle del Empleado</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Información del Empleado</h5>
            <p><strong>ID:</strong> {{ $empleado->id }}</p>
            <p><strong>Nombre:</strong> {{ $empleado->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $empleado->apellido }}</p>
            <p><strong>DNI:</strong> {{ $empleado->dni }}</p>
            <p><strong>Email:</strong> {{ $empleado->email }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ date('d/m/Y', strtotime($empleado->fecha_nacimiento)) }}</p>
        </div>
    </div>

    <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Volver a la lista de empleados</a>
@endsection
