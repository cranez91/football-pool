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
            @foreach($leagues as $index => $league)
                <div class="col-10 col-md-4 col-lg-3 pt-4">
                    <div class="card bg-dark-blue border-light">
                        <img src="{{ $league->logo }}" class="card-img-top" style="width:80%;margin-left: 10%;margin-top: 10%;">
                        <div class="card-body text-center">
                            <p class="card-text">{{ $league->name }}</p>
                            <p class="card-text">{{ $league->country->name }}</p>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="/jugar/{{ $league->slug }}/jornadas" class="btn btn-warning">Ver Jornadas</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
