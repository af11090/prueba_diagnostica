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
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni') }}" required>
                    @error('dni')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
                    @error('apellido')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    @error('fecha_nacimiento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Columna derecha - Datos del contrato -->
            <div class="col-md-6">
                <h3>Datos del Contrato</h3>
                <div class="form-group">
                    <label for="id_local">Local</label>
                    <select class="form-control @error('id_local') is-invalid @enderror" id="id_local" name="id_local" required>
                        <option value="">Seleccione un local</option>
                        @foreach($locales as $local)
                             <option value="{{ $local->id }}">{{ $local->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_local')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_area">Área</label>
                    <select class="form-control @error('id_area') is-invalid @enderror" id="id_area" name="id_area"  required disabled>
                        <option value="">Primero seleccione un local</option>
                    </select>
                    @error('id_area')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_cargo">Cargo</label>
                    <select class="form-control @error('id_cargo') is-invalid @enderror" id="id_cargo" name="id_cargo" required disabled>
                        <option value="">Primero seleccione un área</option>
                    </select>
                    @error('id_cargo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_tipo_contrato">Tipo de Contrato</label>
                    <select class="form-control @error('id_tipo_contrato') is-invalid @enderror" id="id_tipo_contrato" name="id_tipo_contrato" required>
                        @foreach($tiposContrato as $tipo)
                            <option value="{{ $tipo->id }}" @if(old('id_tipo_contrato') == $tipo->id) selected @endif>{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_tipo_contrato')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                    @error('fecha_inicio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin</label>
                    <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}">
                    @error('fecha_fin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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
$(document).ready(function() {
    $('#id_local').change(function() {
        let localId = $(this).val();

        if(localId) {
            $.ajax({
                url: `locales/${localId}/areas`,
                method: 'GET',
                success: function(areas) {
                    $('#id_area')
                        .prop('disabled', false)
                        .html('<option value="">Seleccione un área</option>');
                    areas.forEach(area => {
                        $('#id_area').append(`<option value="${area.id}">${area.nombre}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar áreas:', error);
                    console.log('Respuesta:', xhr.responseText);
                }
            });
        } else {
            $('#id_area')
                .prop('disabled', true)
                .html('<option value="">Primero seleccione un local</option>');
        }
    });

    $('#id_area').change(function() {
        let areaId = $(this).val();
        if(areaId) {
            $.ajax({
                url: `areas/${areaId}/cargos`,
                method: 'GET',
                success: function(cargos) {
                    $('#id_cargo').prop('disabled', false)
                                .html('<option value="">Seleccione un cargo</option>');
                    cargos.forEach(cargo => {
                        $('#id_cargo').append(`<option value="${cargo.id}">${cargo.nombre}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar cargos:', error);
                    console.log('Respuesta:', xhr.responseText);
                }
            });
        } else {
            $('#id_cargo')
                .prop('disabled', true)
                .html('<option value="">Primero seleccione un área</option>');
        }
    });

    $('#dni').blur(function() {
        let dni = $(this).val();
        if (dni.length === 8) {
            $.ajax({
                url: `https://dniruc.apisperu.com/api/v1/dni/${dni}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InhvbWlrNDcxNDFAYWRyZXdpcmUuY29tIn0.k1DVYkHIhPPYcyCtMV-KHNZiDYLTCoPZxTSmqzMmtpg`,
                method: 'GET',
                success: function(data) {
                    if(data.success !== false) {
                        $('#nombre').val(data.nombres).prop('readonly', true);
                        $('#apellido').val(data.apellidoPaterno + ' ' + data.apellidoMaterno).prop('readonly', true);
                    } else {
                        $('#nombre').val('').prop('readonly', false);
                        $('#apellido').val('').prop('readonly', false);
                        console.error('DNI no válido o no encontrado');
                    }
                },
                error: function(xhr, status, error) {
                    $('#nombre').val('').prop('readonly', false);
                    $('#apellido').val('').prop('readonly', false);
                    console.error('Error al validar DNI:', error);
                    console.log('Respuesta:', xhr.responseText);
                }
            });
        } else {
            $('#nombre').prop('readonly', false);
            $('#apellido').prop('readonly', false);
        }
    });
});
</script>
@endpush
