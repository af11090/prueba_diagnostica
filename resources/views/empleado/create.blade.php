@extends('layout.plantilla')
@section('title', 'Crear Empleado')
@section('content')
<div class="container">
    <h1>Crear Empleado</h1>

    <form action="{{ route('empleado.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Columna izquierda - Datos del empleado -->
            <div class="col-md-6">
                <h3>Datos del Empleado</h3>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                </div>
            </div>

            <!-- Columna derecha - Datos del contrato -->
            <div class="col-md-6">
                <h3>Datos del Contrato</h3>
                <div class="form-group">
                    <label for="local_id">Local</label>
                    <select class="form-control" id="local_id" name="local_id" required>
                        <option value="">Seleccione un local</option>
                        @foreach($locales as $local)
                            <option value="{{ $local->id }}">{{ $local->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="area_id">Área</label>
                    <select class="form-control" id="area_id" name="area_id" required disabled>
                        <option value="">Primero seleccione un local</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cargo_id">Cargo</label>
                    <select class="form-control" id="cargo_id" name="cargo_id" required disabled>
                        <option value="">Primero seleccione un área</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_contrato_id">Tipo de Contrato</label>
                    <select class="form-control" id="tipo_contrato_id" name="tipo_contrato_id" required>
                        @foreach($tiposContrato as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
console.log('Script cargado');
$(document).ready(function() {
 $('#local_id').change(function() {
        let localId = $(this).val();
        console.log('Local seleccionado:', localId);

        if(localId) {
            $.ajax({
                url: `locales/${localId}/areas`,
                method: 'GET',
                success: function(areas) {
                    console.log('Áreas recibidas:', areas);
                    $('#area_id')
                        .prop('disabled', false)
                        .html('<option value="">Seleccione un área</option>');
                    areas.forEach(area => {
                        $('#area_id').append(`<option value="${area.id}">${area.nombre}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar áreas:', error);
                    console.log('Respuesta:', xhr.responseText);
                    alert('Error al cargar las áreas');
                }
            });
        } else {
            $('#area_id')
                .prop('disabled', true)
                .html('<option value="">Primero seleccione un local</option>');
        }
    });

    $('#area_id').change(function() {
        let areaId = $(this).val();
        if(areaId) {
            $.ajax({
                url: `areas/${areaId}/cargos`,
                method: 'GET',
                success: function(cargos) {
                    $('#cargo_id').prop('disabled', false)
                                .html('<option value="">Seleccione un cargo</option>');
                    cargos.forEach(cargo => {
                        $('#cargo_id').append(`<option value="${cargo.id}">${cargo.nombre}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar cargos:', error);
                    console.log('Respuesta:', xhr.responseText);
                    alert('Error al cargar los cargos');
                }
            });
        } else {
            $('#cargo_id')
                .prop('disabled', true)
                .html('<option value="">Primero seleccione un área</option>');
        }
    });
});
</script>
@endpush
