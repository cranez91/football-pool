@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header bg-dark-green text-center">Lista de Torneos</div>

                <div class="card-body bg-dark-blue">
                    <div class="row">
                        <div class="responsive-table">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Temporada</th>
                                        <th scope="col">Categoría</th>
                                        <th scope="col">País</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($tournaments) == 0)
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No hay registros
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($tournaments as $index => $tournament)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $tournament->name }}</td>
                                            <td>
                                                <img src="{{ $tournament->logo }}" class="img-thumbnail" style="width: 3em;">    
                                            </td>
                                            <td>{{ $tournament->season }}</td>
                                            <td>{{ $tournament->tournament_type }}</td>
                                            <td>{{ $tournament->country->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="/tournaments/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
