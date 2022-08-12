@extends('_layout/base')

@section('title')
Controle de lanacemento de notas
@endsection


@section('content')


@if($info ?? '')

<h4 style="color: green;">
    @old('data_inicio')
</h4>

<h5 style="color:red">{{ _SESSION }} - Eliminado com sucesso</h5>
@endif


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Controle de lancamento de nota <span class="right" style="float:right; color:green"><a href="{{ route('controle_lancamento_create' ) }}"> Novo Criar</a></span></h6>

    </div>
    <div class="card-body">
    @unless(!empty($rows[0]))
    <h3>Pautas sem data de controle. <a href="{{ route('controle_lancamento_create' ) }}"> Atribuir controle de lancamento de pautas</a></h3>
    @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Exame</th>
                        <th>Data de inicio</th>
                        <th>Data de termino</th>
                        <th>Curso</th>
                        <th>Acoes</th>
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
        </div>
    @endunless
    </div>
</div>


@endsection