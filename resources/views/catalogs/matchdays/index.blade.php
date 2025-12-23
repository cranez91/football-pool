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
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Lista de Quinielas</div>

                <div class="card-body bg-dark-blue">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead class="table-sticky">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jornada</th>
                                    <th scope="col">Liga</th>
                                    <th scope="col">En Juego</th>
                                    <th scope="col">Activa</th>
                                    <th scope="col">Visible</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Premio</th>
                                    @if(Auth::user()->type == 'S')
                                        <th scope="col">Juegos</th>
                                    @endif
                                    <th scope="col">Participantes</th>
                                    @if(Auth::user()->type == 'S')
                                        <th scope="col">Activar</th>
                                        <th scope="col">Mostrar</th>
                                        <th scope="col">Aciertos</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($matchdays) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No hay registros
                                        </td>
                                    </tr>
                                @endif
                                @foreach($matchdays as $index => $matchday)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $matchday->name }}</td>
                                        <td>{{ $matchday->league->name }}</td>
                                        <td>
                                            @if($matchday->is_current == 'Si')
                                                <a class="btn bg-success text-black btn-sm" role="button">
                                                    En Juego
                                                </a>
                                            @else
                                                <span class="text-center"> - </td>
                                            @endif
                                        </td>
                                        <td>
                                            @if($matchday->is_active == 'Si')
                                                <a class="btn bg-success text-black btn-sm" role="button">
                                                    Activa
                                                </a>
                                            @else
                                                <span class="text-center"> - </td>
                                            @endif
                                        </td>
                                        <td>
                                            @if($matchday->is_visible == 'Si')
                                                <a class="btn bg-success text-black btn-sm" role="button">
                                                    Visible
                                                </a>
                                            @else
                                                <span class="text-center"> - </td>
                                            @endif
                                        </td>
                                        <td>{{ $matchday->formatted_price }}</td>
                                        <td>
                                            ${{ $matchday->price * $matchday->userMatchdays()->where('paid', 1)->count() }}
                                        </td>
                                        @if(Auth::user()->type == 'S')
                                            <td>
                                                <a class="btn bg-light text-black btn-sm" role="button"
                                                    href='{{ "/matchday/{$matchday->slug}/matches" }}'
                                                > 
                                                    Ver 
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            <a class="btn bg-light text-black btn-sm" role="button"
                                                href='{{ "/matchday/{$matchday->slug}/gamers" }}'
                                            > 
                                                Ver 
                                            </a>
                                        </td>
                                        @if(Auth::user()->type == 'S')
                                            <td>
                                                @if($matchday->is_active == 'Si')
                                                    <form action="{{ route('matchdays.update', $matchday->id) }}" method="POST">
                                                        @method('PUT')
                                                        <input type="hidden" name="active" value="0">
                                                        <input type="submit" class="btn bg-light text-black btn-sm" value="Cerrar">
                                                    </form>
                                                @elseif($matchday->is_current == 'Si' && $matchday->is_active == 'No')
                                                    <form action="{{ route('matchdays.update', $matchday->id) }}" method="POST">
                                                        @method('PUT')
                                                        <input type="hidden" name="active" value="1">
                                                        <input type="submit" class="btn bg-light text-black btn-sm" value="Activar">
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($matchday->is_visible == 'Si')
                                                    <form action="{{ route('matchdays.update', $matchday->id) }}" method="POST">
                                                        @method('PUT')
                                                        <input type="hidden" name="visible" value="0">
                                                        <input type="submit" class="btn bg-danger text-black btn-sm" value="Ocultar">
                                                    </form>
                                                @else
                                                    <form action="{{ route('matchdays.update', $matchday->id) }}" method="POST">
                                                        @method('PUT')
                                                        <input type="hidden" name="visible" value="1">
                                                        <input type="submit" class="btn bg-success text-black btn-sm" value="Mostrar">
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if($matchday->is_current == 'Si' && $matchday->is_active == 'No')
                                                    <form
                                                        action="{{ route('successes.update') }}"
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
                                                @endif
                                            </td>
                                        @endif
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
