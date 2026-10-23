@extends('layouts.app')

@section('content')

<h1>Listado de Aprendices</h1>

@if (session('ok'))
    <div>
        {{ session('ok') }}
    </div>
@endif

<a href="{{ route('aprendices.create') }}">
    Nuevo aprendiz
</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Ficha</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($aprendices as $aprendiz)

            <tr>
                <td>{{ $aprendiz->id }}</td>
                <td>{{ $aprendiz->nombre }}</td>
                <td>{{ $aprendiz->documento }}</td>
                <td>{{ $aprendiz->correo }}</td>
                <td>{{ $aprendiz->ficha_id ?? 'Sin ficha' }}</td>
            </tr>

        @empty

            <tr>
                <td colspan="5">
                    No hay aprendices registrados.
                </td>
            </tr>

        @endforelse

    </tbody>
</table>

<br>

{{ $aprendices->links() }}

@endsection