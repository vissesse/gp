@extends('_layout/base')

@section('title')
Cursos
@endsection


@section('content')
<h4><a href="{{ route('pauta_create' ) }}"> Nova Pauta</a></h4>


@unless(empty($rows))
@if(!empty(old('add')))
<div class="alert alert-success text-center">
    <h4>{{ old('add') }}</h4>
</div>
@elseif(!empty(old('del')))
<div class="alert alert-danger text-center">
    <h4> {{ old('del')}} </h4>
</div>
@endif
<table>
    <thead>
        <tr>
            <th>Curso: </th>
            <th>Exame: </th>
        </tr>
        <tr>
            <th>Disciplina</th>
            <th>Ano Academico</th>
            <th>Ano lectivo</th>
            <th>Professor</th>
            <th>turma</th>
            <th></th>
            <th></th>
        </tr>

    </thead>

    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{ $row->tipoAvaliacao->nome }}</td>
            <td>{{ $row->data_inicio }} </td>
            <td>{{ $row->data_fim }}</td>
            <td>{{ $row->tipoAvaliacao->curso->nome }}</td>

            <td><a href="{{ route('controle_lancamento_editar', $row->id ) }}">Editar</a> </td>
            <td>
                {!! Form::open(['route'=>['controle_lancamento_delete', $row->id], 'method'=>'delete']) !!}
                <button type="submit">delete</button>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h5> Sem data prevista </h5>

@endunless

@ensection