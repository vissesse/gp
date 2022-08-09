@extends('_layout/base')

@section('title')
Pautas por disciplinas
@endsection


@section('content')
<div class="container">
    <h4>Disciplinas por curso</h4>
    <hr>
    <div class="row"> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Atribuir controle de lancamento de pautas</h5>

                    <a href="{{ route('controle_lancamento_create') }}" class="btn btn-secondary col-md-12">
                        Atribuir controle de lancamento de pautas
                    </a>
                </div>
            </div>
        </div> 
    </div>
    <br>
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $curso->nome }}</h5>

                    <a href="{{ route('cadeiras', $curso->id) }}" class="btn btn-secondary col-md-12">
                        Listar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div> 
</div>
@endsection