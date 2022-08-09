@extends('_layout/base')

@section('tittle')
Cadeiras
@endsection


@section('content')
<h4>Duracao de lancamento de pautas</h4>
<ul>
    @foreach($errors as $erro)
    <li style="color:red">erro {{ $error }}</li>

    @endforeach
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar Cadeiras</h6>

    </div>
    <div class="card-body">


        @unless($row['controle_lancamento'] ?? '')
        {!! Form::open(['route'=>['controle_lancamento_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['controle_lancamento_update', $row['controle_lancamento']->id], 'method'=>'put']) !!}
        @endunless
        <div class="form-group row">
            <div class="col-sm-4">


                <label for="data_inicio">Data inicio:</label>
                <input class="form-control" type="date" name="data_inicio" id="data_inicio" value="{{ $row['controle_lancamento']->data_inicio ?? '' }}">
            </div>
            <div class="col-sm-4">


                <label for="data_fim">Data termino:</label>
                <input class="form-control" type="date" name="data_fim" id="data_termino" value="{{ $row['controle_lancamento']->data_fim ?? '' }}">
            </div>
            <div class="col-sm-4">


                <label for="tipo_avaliacao_id">Exame</label>
                <select class="form-control" name="tipo_avaliacao_id" id="tipo_avaliacao_id">
                    <option> Selecione o exame...</option>
                    @foreach( $row['tipo_avaliacao'] as $avaliacao )
                    @isset($row['controle_lancamento'])
                    @if($avaliacao->id == $row['controle_lancamento']->tipo_avaliacao_id )
                    <option selected value="{{ $avaliacao->id }}">{{ $avaliacao->nome }}</option>
                    @else
                    <option value="{{ $avaliacao->id }}">{{ $avaliacao->nome }} - {{ $avaliacao->curso->nome}}</option>
                    @endif
                    @else
                    <option value="{{ $avaliacao->id }}">{{ $avaliacao->nome }}- {{ $avaliacao->curso->nome}}</option>
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