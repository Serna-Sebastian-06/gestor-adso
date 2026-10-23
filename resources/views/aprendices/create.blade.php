@extends('layouts.app')

@section('content')

<h1>Crear Aprendiz</h1>

@if ($errors->any())
    <div>
        <strong>Se encontraron errores:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('aprendices.store') }}" method="POST">

    @csrf

    <div>
        <label>Nombre:</label>
        <input
            type="text"
            name="nombre"
            value="{{ old('nombre') }}"
        >
    </div>

    <br>

    <div>
        <label>Documento:</label>
        <input
            type="text"
            name="documento"
            value="{{ old('documento') }}"
        >
    </div>

    <br>

    <div>
        <label>Correo:</label>
        <input
            type="email"
            name="correo"
            value="{{ old('correo') }}"
        >
    </div>

    <br>

    <div>
        <label>Ficha:</label>
        <input
            type="number"
            name="ficha_id"
            value="{{ old('ficha_id') }}"
        >
    </div>

    <br>

    <button type="submit">
        Guardar aprendiz
    </button>

</form>

<br>

<a href="{{ route('aprendices.index') }}">
    Volver al listado
</a>

@endsection