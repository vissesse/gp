@extends('_layout/base')

@section('title')
Professores
@endsection


@section('content')
<div class="container">
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Professores de {{ $curso->nome }}</h5>

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
                    <h5 class="card-title text-center">Novo Professor</h5>
                    <a href="{{ route('cadeira_create') }}" class="btn btn-secondary col-md-12">
                        Cadastre aqui uma nova <code>Cadeira</code>.
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection