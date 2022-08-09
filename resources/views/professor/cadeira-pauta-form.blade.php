@extends('_layout/base')

@section('title')
Pauta
@endsection


@section('content')

<div class="row">
    <div class="col-sm-6">
        <h6>
            Curso: {{ $row['curso']->curso->nome }}<br>
            Cadeira:{{ $row['curso']->cadeira->nome }}<br>
            Ano Academico: {{ $row['curso']->ano_academico }} <br>
            Turma: {{ $row['turma'] }}
        </h6>
    </div>
    <div class="col-sm-6">
        <div class="sucess">
        </div>
    </div>
</div>
<ul>
    @foreach($errors->all() as $error)
    <li style="color:red">{{ $error }}</li>

    @endforeach
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar de pautas
            <strong> {{ $row['curso']->cadeira->nome }}</strong>
        </h6>
        <h6 class="m-0 font-weight-bold text-primary"><a class="float-right" href="{{ route('pauta', [$row['cadeira_id'], $row['turma_id'], $row['curso'] ]) }}">ver pauta</a></h>
    </div>
    <div class="card-body">


        {!! Form::open(['route'=>['pauta_store'], 'method'=>'post']) !!}

        <input type="hidden" name="curso" value="{{ $row['curso']->id }}">
        <input type="hidden" name='cadeira_id' value="{{ $row['cadeira_id'] }}">
        <input type="hidden" name="turma_id" value="{{ $row['turma_id'] }}">

        @if($row['msg']) 
            @if(!empty($row['msg']['aviso']))
                <h3 class="alert-warning"> {{ $row['msg']['aviso'] }}</h3>
            @elseif(!empty($row['msg']['sucesso']))
                <h3 class="alert-success"> {{ $row['msg']['sucesso'] }} </h3>
            @endif
        @endif
       

        <div class="form-group row">
            <div class="col-md-4">
                <label for="estudante_id">Estudante:</label>
                <select class="form-control" name="estudante_id" id="estudante_id">
                    <option> Estudante... </option>
                    @foreach($row['estudantes'] as $estudante)
                    @isset($row['pauta'])
                    @if($estudante->id == $row['pauta'] )
                    <option selected value="{{ $estudante->id }}">{{ $estudante->processo }}-{{ $estudante->nome }} </option>
                    @else
                    <option value="{{ $estudante->id }}">{{ $estudante->processo }}-{{ $estudante->nome }} </option>
                    @endif
                    @else
                    <option value="{{ $estudante->id }}">{{ $estudante->processo }}-{{ $estudante->nome }} </option>
                    @endisset
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">

                <label for="tipo_avaliacao">Exame:</label>
                <select class="form-control" name="tipo_avaliacao" id="tipo_avaliacao">
                    @foreach(Exame::getKeys() as $exame)
                    <option value="{{ $loop->index }}"> {{ $exame }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">

                <label for="nota">Nota</label>
                <input class="form-control" type="number" placeholder="Nota..." step="0.1" name="nota" id="nota" max=20 min=0>
            </div>

        </div>

        <div class="row">

            <button class="btn btn-primary" type="submit">Registar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection