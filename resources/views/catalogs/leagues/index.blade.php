@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark-green text-center">Lista de Ligas</div>

            <div class="card-body bg-dark-blue">
                <div class="row">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">País</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($leagues) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($leagues as $index => $league)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $league->name }}</td>
                                        <td>
                                            <img src="{{ $league->logo }}" class="img-thumbnail" style="width: 3em;">    
                                        </td>
                                        <td>
                                            <img src="{{ $league->country->flag }}" class="img-thumbnail" style="width: 3em;">    
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
@endsection
