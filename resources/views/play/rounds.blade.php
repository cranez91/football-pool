@extends('layouts.app')


@section('content')
    @guest
        <div class="alert alert-warning" role="alert">
            <a class="text-black" role="button" href="/register"> Registrate </a>
            o 
            <a class="text-black" role="button" href="/login"> inicia sesión </a>
            para jugar
        </div>
    @endguest

    <div class="container">
        <div class="row justify-content-center">
            @foreach($rounds as $round)
                <div class="col-10 col-md-4 col-lg-2 pt-4">
                    <div class="{{ 'card border-light' . ( $round->current ? ' bg-info' : ' bg-dark-blue') }}">
                        <img src="{{ $round->league->logo }}" class="card-img-top" style="width:80%;margin-left: 10%;margin-top: 10%;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $round->name }}</p>
                            @if(Auth::user() && $round->active)
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <a href="/jornada/{{ $round->slug }}/quiniela" class="btn btn-success mb-4">Jugar</a>
                                </div>
                            @elseif(!Auth::user() && $round->active)
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <a href="/quiniela/{{ $round->slug }}/participantes" class="btn btn-success mb-4">Jugar</a>
                                </div>
                            @else
                                <div class="d-grid gap-2 col-6 mx-auto">
                                    <a href="/quiniela/{{ $round->slug }}/participantes" class="btn btn-warning mb-4">Ver</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
