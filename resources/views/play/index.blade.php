@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($leagues as $index => $league)
            <div class="col-12 col-md-4 col-lg-3 pt-2">
                <div class="card bg-dark-blue border-light">
                    <img src="{{ $league->logo }}" class="card-img-top" style="width:80%;margin-left: 10%;margin-top: 10%;">
                    <div class="card-body text-center">
                        <p class="card-text">{{ $league->name }}</p>
                        <p class="card-text">{{ $league->country->name }}</p>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="/jugar/{{ $league->slug }}/jornadas" class="btn btn-primary">Ver Jornadas</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
