@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark-green text-center">Lista de Temporadas</div>

            <div class="card-body bg-dark-blue">
                <div class="row">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Temporada</th>
                                    <th scope="col">Actual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($seasons) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($seasons as $index => $season)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $season->year }}</td>
                                        <td>{{ $season->is_current }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--div class="row">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="/seasons/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
@endsection
