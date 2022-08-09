@extends('_layout/base')

@section('title')
Disciplinas
@endsection


@section('content')
<div class="container">
    <h4>Disciplinas por curso</h4>
    <hr>
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
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
        <br>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Nova disciplina</h5>
                    <a href="{{ route('cadeira_create') }}" class="btn btn-secondary col-md-12">
                        Cadastre aqui uma nova <code>Cadeira</code>.
                    </a>
                </div>
            </div>
        </div>
    </div>
 

</div>
@endsection