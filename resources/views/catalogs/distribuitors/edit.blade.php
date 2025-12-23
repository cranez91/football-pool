@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <a class="btn bg-light text-black mb-3 mt-3 btn-md" role="button"
                href="/distribuitors"
            > 
                < Regresar 
            </a>
            <create-distribuitor
                :editing="true"   {{-- $editing es una variable de Blade que indica si estás editando o creando --}}
                :initial-data="{{ json_encode($dist) }}"   {{-- $dist es una variable de Blade que contiene los datos iniciales cuando estás editando --}}
            ></create-distribuitor>
        </div>
    </div>
</div>
@endsection
