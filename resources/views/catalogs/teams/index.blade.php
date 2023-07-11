@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark-green text-center">Lista de Equipos</div>

            <div class="card-body bg-dark-blue">
                <div class="row">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Equipo</th>
                                    <th scope="col">Escudo</th>
                                    <th scope="col">Liga</th>
                                    <th scope="col">País</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($teams) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($teams as $index => $team)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $team->name }}</td>
                                        <td>
                                            <img src="{{ $team->logo }}" class="img-thumbnail" style="width: 3em;">    
                                        </td>
                                        <td>{{ $team->league->name }}</td>
                                        <td>{{ $team->league->country->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--div class="row">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="/teams/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
@endsection
