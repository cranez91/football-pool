@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <p>
                * Da clic en el nombre de la Jornada para desplegar la información de los juegos.
            </p>
            <p>
                * Si la Jornada está actualmente expandida, vuelve a dar clic en el nombre para contraerla.
            </p>
            <div class="accordion" id="accordionRounds">
                @foreach($rounds as $index => $round)
                    <div class="accordion-item bg-dark-blue">
                        <h2 class="accordion-header" id="{{'heading' . ($index + 1) }}">
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#{{'collapse' . ($index + 1) }}" aria-expanded="false"
                            class="accordion-button bg-secondary text-black collapsed" aria-controls="{{'collapse' . ($index + 1) }}"
                        >
                            {{ $round->name }}
                        </button>
                        </h2>
                        <div id="{{'collapse' . ($index + 1) }}" aria-labelledby="{{'heading' . ($index + 1) }}" data-bs-parent="#accordionRounds"
                            class="{{ 'accordion-collapse collapse ' . ($round->current ? 'show' : '') }}">
                            <div class="accordion-body table-responsive mb-2">
                                <table class="table bg-dark-blue text-white ">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> Partido </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @foreach ($round->games as $game)
                                                    <game content="{{ json_encode($game) }}"
                                                        type="readonly"
                                                        date="{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y') }}"
                                                        time="{{ \Carbon\Carbon::parse($game->time)->format('h:i') }}"
                                                    ></game>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if(Auth::user() && $round->active)
                                <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                    <a href="/jornada/{{ $round->slug }}/quiniela" class="btn btn-success">Jugar</a>
                                </div>
                            @else
                                <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                    <a href="/quiniela/{{ $round->slug }}/participantes" class="btn btn-warning">Ver Quiniela</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
