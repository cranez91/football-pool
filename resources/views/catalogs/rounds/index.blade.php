@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark-green text-center">Lista de Jornadas</div>

            <div class="card-body bg-dark-blue">
                <div class="row">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jornada</th>
                                    <th scope="col">Activa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($rounds) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($rounds as $index => $round)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $round->name }}</td>
                                        <td>{{ $round->is_active }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--div class="row">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="/rounds/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
@endsection
