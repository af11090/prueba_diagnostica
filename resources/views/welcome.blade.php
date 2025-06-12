@extends('layout.plantilla')
@section('title', 'Welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="font-weight-bold display-5">Bienvenido a RH Software</h1>
            <p>Esta es una aplicación de recurso humano para el registro de empleados.</p>
            <p>Utiliza el menú de navegación para acceder a las diferentes secciones.</p>
            <button class="btn btn-primary"><a href="{{ route('empleado.index') }}" class="text-white">Comenzar</a></button>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('image/portada.png') }}" alt="Bienvenido a RH Software" class="img-fluid">
        </div>
    </div>
</div>

@endsection
