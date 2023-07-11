@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 mt-4">
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Lista de Quinielas</div>

                <div class="card-body bg-dark-blue">
                    <div class="responsive-table">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Liga</th>
                                    <th scope="col">En Juego</th>
                                    <th scope="col">Activa</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Premio</th>
                                    <th scope="col">Juegos</th>
                                    <th scope="col">Participantes</th>
                                    <th scope="col"></th>
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
                                        <td>{{ $matchday->is_current }}</td>
                                        <td>{{ $matchday->is_active }}</td>
                                        <td>{{ $matchday->formatted_price }}</td>
                                        <td>
                                            ${{ $matchday->price * $matchday->userMatchdays()->where('paid', 1)->count() }}
                                        </td>
                                        <td>
                                            <a class="btn bg-light text-black btn-sm" role="button"
                                                href='{{ "/matchday/{$matchday->slug}/matches" }}'
                                            > 
                                                Ver 
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn bg-light text-black btn-sm" role="button"
                                                href='{{ "/matchday/{$matchday->slug}/gamers" }}'
                                            > 
                                                Ver 
                                            </a>
                                        </td>
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
