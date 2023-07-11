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
                href="{{ '/jugar/' . $matchday->league->slug . '/jornadas' }}"
            > 
                < Regresar 
            </a>
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Lista de Participantes</div>

                <div class="card-body bg-dark-blue">
                    <div class="table-responsive mt-2 mb-2">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Local</th>
                                    <th scope="col">Visita</th>
                                    <th scope="col">Resultado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($matchday->matches as $index => $match)
                                    <tr>
                                        <th scope="col">{{ $index+1 }}</th>
                                        <td>{{ $match->game->home->name }}</td>
                                        <td>{{ $match->game->away->name  }}</td>
                                        <td>{{ $match->result  }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th class="text-center" scope="col">Pagada</th>
                                    <th class="text-center" scope="col">Ganadora</th>
                                    @foreach($matchday->matches as $index => $match)
                                        <th class="text-center" scope="col">{{ $index+1 }}</th>
                                    @endforeach
                                    <th class="text-center" scope="col">Aciertos</th>
                                    <th scope="col">Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($matchday->userMatchdays()->count() == 0)
                                    <tr>
                                        <td colspan="3" class="text-center"> No hay registros </td>
                                    </tr>
                                @endif
                                @foreach($matchday->userMatchdays as $index => $userMatchday)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
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
                                                <td class="text-center bg-danger">{{$userMatch->prediction}}</td>
                                            @endif
                                        @endforeach
                                        <td class="text-center">{{ $userMatchday->userMatches()->where('success', 'S')->count() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($userMatchday->created_at)->format('d-M-Y h:i') }}</td>
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
@endsection
