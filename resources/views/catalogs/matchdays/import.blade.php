@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="btn bg-secondary text-black mt-4 mb-4 btn-md" role="button"
                href="{{ '/matchday/' . $matchday->slug . '/gamers' }}"
            > 
                < Regresar 
            </a>
            <div class="card">
                <div class="card-header bg-secondary text-center text-black">Importar Participantes</div>

                <div class="card-body bg-dark-blue">
                    <form action="{{ route('matchday.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="file">Importar</label>
                        </div>
                        <div class="form-group mb-4">
                            <input type="file" class="form-control-file" id="file" name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
