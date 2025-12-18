@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mt-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn bg-success text-white mb-2 btn-md" role="button"
                    href="{{ route('distribuitors.create') }}"
                > 
                    Agregar Nuevo +
                </a>
            </div>
            
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Lista de Distribuidores</div>

                <div class="card-body bg-dark-blue">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead class="table-sticky">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Domicilio</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">% Comisión</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($distribuitors) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($distribuitors as $index => $dist)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $dist->name }}</td>
                                        <td>{{ $dist->address }}</td>
                                        <td>{{ $dist->city }}</td>
                                        <td>{{ $dist->state }}</td>
                                        <td>{{ $dist->commission_pct }}</td>
                                        <td>{{ $dist->is_active }}</td>
                                        <td>
                                            <a class="btn bg-light text-black btn-sm" role="button"
                                                href="{{ route('distribuitors.edit', $dist->id) }}"
                                            > 
                                                Editar 
                                            </a>
                                        </td>
                                        <td>
                                            @if($dist->is_active == 'Si')
                                                <form action="{{ route('distribuitors.update', $dist->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="active" value="0">
                                                    <input type="submit" class="btn bg-danger text-black btn-sm" value="Desactivar">
                                                </form>
                                            @else
                                                <form action="{{ route('distribuitors.update', $dist->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="active" value="1">
                                                    <input type="submit" class="btn bg-success text-black btn-sm" value="Activar">
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="/matchdays/create" class="btn btn-success btn-lg" role="button">Agregar Nuevo</a>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
