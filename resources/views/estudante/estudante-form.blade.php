@extends('_layout/base')

@section('title')
Cadastrar Estudante
@endsection


@section('content')
<h4>Criar Estudantes</h4>
@if(!empty(old('error')))
<div class="alert alert-warning text-center">
    <h4 class="">{{ old('error') }}</h4>
</div>
@endif
<ul>
    @foreach($errors as $error)
    <li style="color:red">erro {{ $error }}</li>

    @endforeach
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar Estudante</h6>

    </div>
    <div class="card-body">

        @unless($row['estudantes'] ?? '')
        {!! Form::open(['route'=>['estudante_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['estudante_update', $row['estudantes']->id], 'method'=>'put']) !!}
        @endunless
        <div class="form-group row">
            <div class="col-sm-4">

                <label for="nome">Esudante:</label>
                <input class="form-control" type="text" placeholder="Nomde do estudante..." name="nome" id="nome" value="{{ $row['estudantes']->nome ?? '' }}">

            </div>
            <div class="col-sm-4">

                <label for="processo">N*Processo:</label>
                <input class="form-control" type="text" placeholder="Numero de processo..." name="processo" id="processo" value="{{ $row['estudantes']->processo ?? '' }}">

            </div>

            <div class="col-sm-4">
                <label for="turma">Turma:</label>
                <select class="form-control" name="turma_id" id="turma">
                    <option>Selecione a devida turma...</option>
                    @foreach($row['turmas'] as $turma)
                    @isset($row['estudantes'])
                    @if($turma->id == $row['estudantes']->turma_id )
                    <option selected value="{{ $turma->id }}">{{ $turma->nome }}-{{ $turma->curso->nome }}</option>
                    @else
                    <option value="{{ $turma->id }}">{{ $turma->nome }}- {{ $turma->curso->nome }}</option>
                    @endif
                    @else
                    <option value="{{ $turma->id }}">{{ $turma->nome }}-{{ $turma->ano_academico }}-{{ $turma->curso->nome }}</option>
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