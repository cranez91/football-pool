@extends('layouts.app')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-dark mb-1">
                <img style="max-height: 400px;" src="/img/assets/inicio_estadio.jpg" class="card-img-top" alt="...">
                <div class="card-body bg-dark-blue bg-gradient text-white text-center">
                    <p class="card-text">¡Bienvenido al terreno de juego!</p>
                </div>
                <div class="card-footer bg-dark-blue text-white text-center">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="{{ route('jugar') }}" class="btn btn-outline-primary">Jugar</a>
                        <a href="{{ route('reglamento') }}" class="btn btn-outline-primary">Ver Reglamento</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
