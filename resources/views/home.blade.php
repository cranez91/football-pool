@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-dark mb-1">
                <img style="max-height: 400px;" src="/img/assets/inicio_estadio.jpg" class="card-img-top" alt="...">
                <div class="card-body bg-dark-blue bg-gradient text-white text-center">
                    <p class="card-text">¡Bienvenido al terreno de juego!</p>
                    <p class="card-text">
                        <a class="text-white" href="{{ route('jugar') }}">Jugar</a>
                    </p>
                    <p class="card-text">
                        <a class="text-white" href="{{ route('reglamento') }}">Ver Reglamento</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
