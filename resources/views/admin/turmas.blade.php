@extends('_layout/base')

@section('title')
    Turmas
@endsection


@section('content') 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Avaliacoes
                <span class="right" style="float:right; color:green"><a href="{{ route('turma_create') }}"> Novo
                        Criar</a></span>
            </h6>
        </div>

        @if (!empty(old('add')))
            <div class="alert alert-success text-center">
                <h4>{{ old('add') }}</h4>
            </div>
        @elseif(!empty(old('del')))
            <div class="alert alert-danger text-center">
                <h4> {{ old('del') }} </h4>
            </div>
        @endif
        <div class="card-body">
            @if (empty($rows[0]))
                <h3>Nenhuma turma cadastrada <a href="{{ route('turma_create') }}"> Cadatrar turma.</a></h3>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Ano Academico</th>
                                <th>curso</th>
                                <th>acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $row->nome }}</td>
                                    <td>{{ $row->ano_academico }}</td>
                                    <td>{{ $row->curso->nome }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['turma_deletar', $row->id], 'method' => 'delete']) !!}
                                        <a class="btn btn-secondary" href="{{ route('turma_editar', $row->id) }}">Editar</a>
                                        <button class="btn btn-danger" type="submit">excluir</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $rows->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
