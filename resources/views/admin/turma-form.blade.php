@extends('_layout/base')

@section('title')
Avaliacaoes
@endsection


@section('content')

<h4>Criar turmas</h4>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar Cadeiras</h6>

    </div>
    @if(!empty(old('add')))
    <div class="alert alert-success">
        <h4>{{ old('add') }}</h4>
    </div>
    @elseif(!empty(old('del')))
    <div class="alert alert-danger">
        <h4> {{ old('del')}} </h4>
    </div>
    @endif
    <div class="card-body">

        @unless($row['turma'] ?? '')
        {!! Form::open(['route'=>['turma_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['turma_update', $row['turma']->id], 'method'=>'put']) !!}
        @endunless

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="nome">Turma</label>
                <input class="form-control" type="text" placeholder="Nome da turma..." name="nome" id="nome" value="{{ $row['turma']->nome ?? '' }}">
            </div>
            <div class="col-sm-4">
                <label for="ano_academico">Ano Academico</label>
                <input class="form-control" type="text" placeholder="Ano academico da respectiva turma..." name="ano_academico" id="ano_academico" value="{{ $row['turma']->ano_academico ?? '' }}">

            </div>
            <div class="col-sm-4">
                <label for="curso_id">Curso</label>
                <select class="form-control" name="curso_id" id="curso_id">
                    <option> Selecione o curso...</option>
                    @foreach($row['cursos'] as $curso)
                    @isset($row['turma'])
                    @if($curso->id == $row['turma']->curso_id )
                    <option selected value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @else
                    <option value="{{ $curso->id  }}">{{ $curso->nome }}</option>
                    @endif
                    @else
                    <option value="{{ $curso->id  }}">{{ $curso->nome }}</option>
                    @endisset
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">

            <button class="btn btn-primary" type="submit">Registar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection