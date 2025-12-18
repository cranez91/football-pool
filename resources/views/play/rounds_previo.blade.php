@extends('layouts.app')

@section('content')
{{-- 
    <!--div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                @foreach($rounds->where('current', 1)->all() as $index => $round)
                    <div class="row">
                        <table class="table text-white ">
                            <thead class="bg-success pt-4 pb-4 text-center">
                                <tr>
                                    <th class="text-center"> Jornada en juego - {{$round->name}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @foreach ($round->games as $game)
                                            <game content="{{ json_encode($game) }}"
                                                type="readonly"
                                                current="{{ $round->current }}"
                                                date="{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y') }}"
                                                time="{{ \Carbon\Carbon::parse($game->time)->format('h:i A') }}"
                                            ></game>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if(Auth::user() && $round->active)
                        <div class="d-grid gap-2 col-6 mx-auto mb-4">
                            <a href="/jornada/{{ $round->slug }}/quiniela" class="btn btn-primary">Jugar</a>
                        </div>
                    @else
                        <div class="d-grid gap-2 col-6 mx-auto mb-4">
                            <a href="/quiniela/{{ $round->slug }}/participantes" class="btn btn-primary mb-4">Ver Quiniela</a>
                        </div>
                    @endif
                @endforeach

                <div class="row mt-4 mb-2">
                    <div class="col bg-warning pt-4 pb-4 text-center text-black">
                        Jornadas Previas
                    </div>
                </div>

                @foreach($rounds->where('current', 0)->all() as $index => $round)
                    <div class="row">
                        <table class="table bg-dark-blue text-white ">
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="text-center"> {{$round->name}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @foreach ($round->games as $game)
                                            <game content="{{ json_encode($game) }}"
                                                type="readonly"
                                                date="{{ \Carbon\Carbon::parse($game->date)->format('d/m/Y') }}"
                                                time="{{ \Carbon\Carbon::parse($game->time)->format('h:i A') }}"
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
                            <a href="/quiniela/{{ $round->slug }}/participantes" class="btn btn-primary mb-4">Ver Quiniela</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div-->
--}}
@endsection
