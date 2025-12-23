@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h4>Precio: ${{ $round->price }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-left">
            <a 
                href="{{ '/jugar/' . $round->league->slug . '/jornadas' }}"
                class="btn bg-light text-black btn-sm" role="button"
            >{{'<'}} Regresar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-left pt-4">
            @if ($round->userMatchdays()->where('user_id', Auth::user()->id)->count() > 0)
                @include('play.user-matchday-summary')
                <p>
                    *Puedes pagar tus quinielas con cualquiera de nuestros distribuidores autorizados, deberás proporcionar tus folios.
                    <button type="button" 
                        class="btn btn-primary btn-sm ml-2" 
                        data-bs-toggle="modal" 
                        data-bs-target="#distribuidores"
                    >
                        Ver Distribuidores
                    </button>
                </p>

                <div class="modal modal-xl fade" 
                     id="distribuidores" 
                     tabindex="-1" 
                     aria-labelledby="exampleModalLabel" 
                     aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark-blue">
                            <div class="modal-header">
                                Lista de Distribuidores
                            </div>
                            <div class="modal-body text-white">
                                @include('play.distribuitors')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <form id="frmPredictions" action="/predictions/{{ $round->slug }}" method="POST">
            @csrf
            <input type="hidden" name="matchday_slug" value="{{$round->slug}}">
            <input type="hidden" name="paid" value="0">
            <input type="hidden" name="winner" value="0">
        <div class="row">
            @foreach ($round->games as $game)
                <game content="{{ json_encode($game) }}"
                    type="forecast"
                    date="{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y') }}"
                    time="{{ \Carbon\Carbon::parse($game->time)->format('h:i') }}"
                ></game>
            @endforeach
            @if($round->active)
                <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-2">
                    <button class="btn btn-success" type="submit" form="frmPredictions">Guardar</button>
                </div>
            @else
                <div class="d-grid gap-2 col-6 mx-auto mt-4 mb-2">
                    <a href="/liga/{{ $round->league->slug }}/jornadas" class="btn btn-secondary">Ver Quiniela</a>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
