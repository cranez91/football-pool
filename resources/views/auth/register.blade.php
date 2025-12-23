@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row">
            <div class="col-12 ">
                <div class="card border-dark mb-1">
                    <img src="/img/assets/banner_soccer.jpg" class="card-img-top" alt="...">
                    <div class="card-body bg-dark-blue bg-gradient text-white text-center">
                        <p class="card-text">¡Únete a la diversión!</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">
                                    Nombre
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        placeholder="Nombre completo"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        autocomplete="name"
                                        autofocus
                                    >

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="whatsapp" class="col-md-4 col-form-label text-md-end">
                                    Whatsapp
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="whatsapp"
                                        type="text"
                                        placeholder="Número a 10 dígitos"
                                        class="form-control @error('whatsapp') is-invalid @enderror"
                                        name="whatsapp"
                                        value="{{ old('whatsapp') }}"
                                        required
                                        autocomplete="whatsapp"
                                        autofocus
                                    >

                                    @error('whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    Correo Electrónico
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autocomplete="email"
                                        autofocus
                                    >

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    Contraseña
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        placeholder="Almenos 8 caracteres"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                    Confirmar Contraseña
                                </label>

                                <div class="col-md-6">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        Registrarme
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
