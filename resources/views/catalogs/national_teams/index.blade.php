@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header bg-dark-green text-center">Lista de Selecciones</div>

                <div class="card-body bg-dark-blue">
                    <div class="row">
                        <div class="responsive-table">
                            <table class="table table-secondary table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">País</th>
                                        <th scope="col">Escudo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nations as $index => $team)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $team->name }}</td>
                                            <td>
                                                <img src="{{ $team->full_logo_src }}" class="img-thumbnail" style="width: 3em;">    
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="/national_teams/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
