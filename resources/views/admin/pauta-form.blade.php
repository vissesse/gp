@extends('_layout/base')

@section('title')
Pauta
@endsection


@section('content')
<h4>Pauas</h4>
<ul>
    @foreach($errors as $erro)
    <li style="color:red">erro {{ $error }}</li>

    @endforeach
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar de pautas</h6>

    </div>
    <div class="card-body">

        @unless($row['professor'] ?? '')
        {!! Form::open(['route'=>['professor_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['professor_update', $row['professor']->id], 'method'=>'put']) !!}
        <input type="hidden" name="professor_id" id="" value="{{ $row['professor']->professor->id }}">
        @endunless

        <div class="form-group row">
            <div class="col-sm-4">

                <label for="">Estudante:</label>
                <select class="form-control" name="cadeira_id" id="cadeira_id">
                    <option> Estudante... </option>
                    @foreach($row['estudantes'] as $estudante)
                        @isset($row['pauta'])
                            @if($estudante->id == $row['pauta']->estudante_id )
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
            <div class="col-sm-4">

                <label for="curso_id">Curso</label>
                <select class="form-control" name="curso_id" id="tipo_avaliacao_id">
                   <option > Selecione o curso...</option>
                   @foreach( $row['tipo_avaliacoes'] as $tipo_avaliacao )
                        @isset($row['pauta'])
                            @if($tipo_avaliacao->id == $row['pauta']->tipo_avaliacao_id )
                                <option selected value="{{ $tipo_avaliacao->id }}">{{ $curso->nome }}</option>
                            @else
                                <option value="{{ $tipo_avaliacao->id }}">{{ $curso->nome }}</option>
                            @endif
                        @else
                            <option value="{{ $tipo_avaliacao->id }}">{{ $curso->nome }}</option>
                        @endisset
                   @endforeach
                </select>
            </div>
            <div class="col-sm-4">

                <label for="Professor nome">Nota</label>
                <input class="form-control" type="number" placeholder="Nome do professor..." name="contacto" id="contacto" value="{{ $row['professor']->professor->user->contacto ?? '' }}">
            </div>
            <div class="col-sm-4">

                <label for="Professor nome">Ano lectivo</label>
                <input class="form-control" type="email" placeholder="Nome do professor..." name="email" id="email" value="{{ $row['professor']->professor->user->email ?? '' }}">
            </div>
            <div class="col-sm-4">

                <label for="turma">turma</label>
                <select class="form-control" name="cursoano_academico_id" id="turma">
                    <option> Selecine a turma a lecionar....</option>
                    @foreach($row['turmas'] as $turma)
                        @isset($row['pauta'])
                            @if($turma->id == $row['pauta']->professor->turma_id )
                                <option selected value="{{ $turma->id }}">{{ $turma->nome }}-{{ $turma->curso->nome }}- {{ $turma->ano_academico }}</option>
                            @else
                                <option value="{{ $turma->id }}">{{ $turma->nome }}- {{ $turma->curso->nome }}-{{ $turma->ano_academico }}</option>
                            @endif
                        @else
                             <option value="{{ $turma->id }}">{{ $turma->nome }} -{{ $turma->curso->nome }}-{{ $turma->ano_academico }}</option>
                        @endisset
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">

                <label for="">Cadeira:</label>
                <select class="form-control" name="cadeira_id" id="cadeira_id">
                    <option> Selecione a cadeira a lecionar... </option>
                    @foreach($row['cadeiras'] as $cadeira)
                    @isset($row['pauta'])
                    @if($cadeira->id == $row['pauta']->professor->cadeira_id )
                    <option selected value="{{ $cadeira->id }}">{{ $cadeira->nome }}</option>
                    @else
                    <option value="{{ $cadeira->id }}">{{ $cadeira->nome }}- </option>
                    @endif
                    @else
                    <option value="{{ $cadeira->id }}">{{ $cadeira->nome }} </option>
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