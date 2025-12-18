@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark-green text-center">Lista de Paises</div>

            <div class="card-body bg-dark-blue">
                <div class="row">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">País</th>
                                    <th scope="col">Bandera</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Jornadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($countries) == 0)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($countries as $index => $country)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $country->name }}</td>
                                        <td>
                                            <img src="{{ $country->flag }}" class="img-thumbnail" style="width: 3em;">    
                                        </td>
                                        <td>{{ $country->is_active }}</td>
                                        <td>
                                            <form
                                                action="{{ route('rounds.update') }}"
                                                method="POST"
                                                enctype="multipart/form-data"
                                            >
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                    Actualizar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--div class="row">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="/countries/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>
@endsection
