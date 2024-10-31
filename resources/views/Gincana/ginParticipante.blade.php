@extends('Gincana.layout.app')

@section('title', 'Gincana Participante') 

@section('content') 
    <h1>Lista de Participantes</h1>

    @if($participantes->isNotEmpty())
        <ul class="list-group">
            @foreach ($participantes as $participante)
                <li class="list-group-item">{{ $participante->parNome }}</li>
            @endforeach
        </ul>
    @else
        <p>Nenhum participante encontrado.</p>
    @endif
@endsection