@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 mt-4">
            <a class="btn bg-secondary text-black mb-2 btn-md" role="button"
                href="/matchdays"
            > 
                < Regresar 
            </a>
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Lista de Participantes</div>

                <div class="card-body bg-dark-blue">
                    <div class="row">
                        @foreach ($matchday->matches as $index => $match)
                            <div class="col-12 col-md-4 pt-4">
                                <div class="card bg-dark-blue border-light">
                                    <div class="card-header text-center">
                                        <img src="{{ $match->game->home->broadcaster->full_logo_src }}"
                                            class="img-thumbnail ml-2 mt-2"
                                            style="max-width: 3em;">
                                        <span class="text-center"> {{ \Carbon\Carbon::parse($match->game->date)->format('d/m/Y') }} </span>
                                        <span class="text-center"> {{ \Carbon\Carbon::parse($match->game->time)->format('h:i') }} </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 offset-1 text-center">
                                            <span class="fs-6 text-center mb-2"> {{ $match->game->home->nickname }} </span>
                                            <img src="{{ $match->game->home->logo }}"
                                                class="card-img-top mt-2" 
                                                tyle="width:80%;margin-left: 10%;margin-top: 10%;"
                                            >
                                            <span class="fs-4 text-center"> {{ $match->game->home_score }} </span>
                                        </div>
                                        <div class="col-4 pt-5 text-center">
                                            <h3>vs</h3>
                                        </div>
                                        <div class="col-3 text-center">
                                            <span class="text-center mb-2"> {{ $match->game->away->nickname }} </span>
                                            <img src="{{ $match->game->away->logo }}" 
                                                class="card-img-top mt-2" 
                                                tyle="width:80%;margin-left: 10%;margin-top: 10%;"
                                            >
                                            <span class="fs-4 text-center"> {{ $match->game->away_score }} </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-8 offset-md-2">
                                            <div class="row text-white">
                                                <div class="col-12 mb-4 text-center"> 
                                                    <span>{{ $match->game->home->stadium }}</span>
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-primary btn-sm ml-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="{{ '#modal' . $match->game->home->id }}" >
                                                        Ver
                                                    </button>

                                                    <div 
                                                        class="modal fade" 
                                                        id="{{ 'modal' . $match->game->home->id }}" 
                                                        tabindex="-1" 
                                                        aria-labelledby="modalLabel" 
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-dark-blue">
                                                                <div class="modal-header">
                                                                    <h5 
                                                                        class="modal-title text-white" 
                                                                        id="modalLabel">{{ $match->game->home->stadium }}</h5>
                                                                    <button 
                                                                        type="button" 
                                                                        class="btn-close text-white" 
                                                                        data-bs-dismiss="modal" 
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-white">
                                                                    <img src="{{ $match->game->home->stadium_image }}" class="img-thumbnail">
                                                                    <div>Ciudad: {{ $match->game->home->city }}</div>
                                                                    <div>Domicilio: {{ $match->game->home->stadium_address }}</div>
                                                                    <div>Capacidad: {{ $match->game->home->stadium_capacity }}</div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($match->result)
                                        <div class="card-body text-center">
                                            <div class="row">
                                                <div class="col-6 offset-3 text-center">
                                                    <select class="form-select" disabled>
                                                        @if($match->result == 'L')
                                                            <option value="L">Local</option>
                                                        @elseif($match->result == 'E')
                                                            <option value="L">Empate</option>
                                                        @elseif($match->result == 'V')
                                                            <option value="L">Visita</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($matchday->current && $matchday->active)
                        <div class="row mt-2 mb-2">
                            <div class="col-12">
                                <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                    <a 
                                        href="{{route('matchday.import', ['slug' => $matchday->slug])}}" 
                                        class="btn btn-success"
                                    >
                                        Importar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-2 mb-2">
                        <div class="col-12">
                            <div class="table-responsive table-sticky">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Folio</th>
                                            <th scope="col">Participante</th>
                                            <th class="text-center" scope="col">Pagada</th>
                                            <th class="text-center" scope="col">Ganadora</th>
                                            @foreach($matchday->matches as $index => $match)
                                                <th class="text-center" scope="col">{{ $index+1 }}</th>
                                            @endforeach
                                            <th class="text-center" scope="col">Aciertos</th>
                                            <th scope="col">Registro</th>
                                            <th scope="col">Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($matchday->userMatchdays()->count() == 0)
                                            <tr>
                                                <td colspan="15" class="text-center"> No hay participantes </td>
                                            </tr>
                                        @endif
                                        @foreach($matchday->userMatchdays as $index => $userMatchday)
                                            <tr>
                                                <th scope="row">{{ ++$index }}</th>
                                                <td>{{ $userMatchday->uuid }}</td>
                                                <td>{{ $userMatchday->user->name }}</td>
                                                <td class="text-center">{{ $userMatchday->is_paid }}</td>
                                                @if($userMatchday->winner)
                                                    <td class="text-center bg-warning text-black">{{ $userMatchday->is_winner }}</td>
                                                @else
                                                    <td class="text-center">{{ $userMatchday->is_winner }}</td>
                                                @endif
                                                
                                                @foreach($userMatchday->userMatches as $userMatch)
                                                    @if($userMatch->success == 'S')
                                                        <td class="text-center bg-success">{{$userMatch->prediction}}</td>
                                                    @elseif($userMatch->success == 'N')
                                                        <td class="text-center">{{$userMatch->prediction}}</td>
                                                    @endif
                                                @endforeach
                                                <td class="text-center">{{ $userMatchday->userMatches()->where('success', 'S')->count() }}</td>
                                                <td>{{ \Carbon\Carbon::parse($userMatchday->created_at)->format('d-M-Y h:i') }}</td>
                                                <td>
                                                    @if($userMatchday->is_paid == 'No')
                                                        <form action="{{ route('user_matchdays.update', $userMatchday->id) }}" method="POST">
                                                            @method('PUT')
                                                            <input type="hidden" name="paid" value="1">
                                                            <input type="hidden" name="winner" value="0">
                                                            @if(Auth::user()->type == 'D')
                                                                <input type="hidden" name="distribuitor" value="{{ Auth::user()->name }}">
                                                            @endif
                                                            <input type="submit" class="btn bg-light text-black btn-sm" value="Agregar">
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
