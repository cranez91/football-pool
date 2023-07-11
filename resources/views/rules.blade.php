@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header bg-dark-blue text-center">¡Conoce nuestro competencia!</div>

                <div class="card-body bg-dark-blue">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <img style="width: 100%" src="/img/assets/banner.jpg" class="img-fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <table class="table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sigue los pasos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1.-</th>
                                            <td>Solo ingresa a esta plataforma para tener la oportunidad de participar</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2.-</th>
                                            <td>Selecciona el torneo en el cual quieres participar</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3.-</th>
                                            <td>Busca la quiniela disponible del torneo que seleccionaste</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4.-</th>
                                            <td>Llena tu quiniela (una vez ingresada, no podrá ser modificada)</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5.-</th>
                                            <td>Al finalizar la jornada, ¡revisa la tabla de posiciones!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-4">
                                <table class="table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Premios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1.-</th>
                                            <td>Premio en efectivo de la jornada: Quien tenga el mayor número de aciertos en la quiniela/jornada será el ganador. La cantidad dependerá del número de participantes; invita a tus familiares y amigos, ¡entre más participantes, mayor será el premio!</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2.-</th>
                                            <td>Premio en efectivo acumulado: No te preocupes si no sales ganador de la quiniela/jornada; tus aciertos se irán acumulando y podrás ser el ganador del premio acumulado una vez que haya finalizado el torneo. Así que, ¡Sigue participando!</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3.-</th>
                                            <td>¡Premios sorpresa al finalizar el torneo!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-4">
                                <table class="table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Criterios de desempate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1.-</th>
                                            <td>Premio en efectivo de la jornada: En caso de un empate entre dos o más participantes en el primer lugar, el premio acumulado de la jornada se repartirá.</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2.-</th>
                                            <td>Premio en efectivo acumulado: En caso de un empate entre dos o más participantes en el primer lugar, el premio acumulado del torneo se repartirá.</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3.-</th>
                                            <td>Premios sorpresa al finalizar el torneo: Al finalizar el torneo, de la posición 2 al 8, participarán en una rifa en donde se sortearán los premios sorpresa.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
