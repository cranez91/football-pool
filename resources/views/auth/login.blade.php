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

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    Correo Electrónico
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            --}}

                            <div class="row mb-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    @endif
                                </div>

                            </div>
                            <div class="row mb-0">
                                <div class="col-12">
                                    <p>
                                        ¿Aún no tienes cuenta?
                                    </p>

                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        Registrarme
                                    </a>
                                </div>
                            </div>
                            {{--
                            <div class="form-group mt-2 mb-2">
                                <div class="col-md-12">
                                    <a href="{{route('facebook.login')}}" class="btn btn-primary">
                                    Facebook
                                    </a>
                                </div>
                            </div>
                            --}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
