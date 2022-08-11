@extends('_layout/base')

@section('title')
Avaliacaoes
@endsection


@section('content')
<h4>Tipo de valiacao</h4>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">TIpo de avaliacao</h6>
    </div>
    <div class="card-body">


        @unless($row['tipo_avaliacao'] ?? '')
        {!! Form::open(['route'=>['tipo_avaliacao_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['tipo_avaliacao_update', $row['tipo_avaliacao']->id], 'method'=>'put']) !!}
        @endunless
        <div class="form-group row">
            <div class="col-sm-6">

                <label for="nome">TIpo de avalicao</label>
                <select class="form-control" name="nome" id="">
                    @foreach(Exame::getKeys() as $exame)
                    <option value="{{ $exame }}"> {{$exame}} </option>
                    @endforeach
                </select>{{--
                    
                <input class="form-control" type="text" placeholder="Exame de epoca normal, de Recurso, etc" name="nome" id="nome" value="{{ $row['tipo_avaliacao']->nome ?? '' }}">
                --}}
            </div>

            <div class="col-sm-6">

                <label for="curso_id">Curso</label>
                <select class="form-control" name="curso_id" id="curso_id">
                    <option> Selecione o curso...</option>
                    @foreach( $row['cursos'] as $curso )
                    @isset($row['tipo_avaliacao'])
                    @if($curso->id == $row['tipo_avaliacao']->curso_id )
                    <option selected value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @else
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endif
                    @else
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endisset
                    @endforeach
                </select>
            </div>
        </div>
        <div class="bt-group row">

            <button class="btn btn-primary" type="submit">Registar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection