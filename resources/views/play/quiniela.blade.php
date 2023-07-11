@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container p-4">
    <div class="row justify-content-center">
        @if ($round->userMatchdays()->count() > 0)
            @include('play.user-matchday-summary')
        @endif
        <div class="col-12 col-md-10">
            <div class="accordion" id="accordionRounds">
                    <div class="accordion-item bg-dark-blue">
                        <h2 class="accordion-header" id="heading1">
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"
                            class="accordion-button bg-secondary text-black collapsed" aria-controls="collapse1"
                        >
                            {{ $round->name }} - <strong>(Precio: ${{ $round->price }})</strong>
                        </button>
                        </h2>
                        <div id="collapse1"
                            aria-labelledby="heading1"
                            data-bs-parent="#accordionRounds"
                            class="{{ 'accordion-collapse collapse ' . ($round->active ? 'show' : '') }}"
                        >
                            <div class="accordion-body table-responsive mb-2">
                                <table class="table bg-dark-blue text-white ">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center"> Partido </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <form id="frmPredictions" action="/predictions/{{ $round->slug }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="matchday_slug" value="{{$round->slug}}">
                                                    <input type="hidden" name="paid" value="0">
                                                    <input type="hidden" name="winner" value="0">
                                                    @foreach ($round->games as $game)
                                                        <game content="{{ json_encode($game) }}"
                                                            type="forecast"
                                                            date="{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y') }}"
                                                            time="{{ \Carbon\Carbon::parse($game->time)->format('h:i') }}"
                                                        ></game>
                                                    @endforeach
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if($round->active)
                                <div class="d-grid gap-2 col-6 mx-auto  mb-2">
                                    <button class="btn btn-success" type="submit" form="frmPredictions">Guardar</button>
                                </div>

                            @else
                                <div class="d-grid gap-2 col-6 mx-auto  mb-2">
                                    <a href="/liga/{{ $round->league->slug }}/jornadas" class="btn btn-secondary">Ver Quiniela</a>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
