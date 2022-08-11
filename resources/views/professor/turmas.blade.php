@extends('_layout/base')

@section('title')
Turmas
@endsection


@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cadeiras e turmas a ministrar
        </h6>
        @if(!empty(old('add')))
        <div class="alert alert-success text-center">
            <h4>{{ old('add') }}</h4>
        </div>
        @elseif(!empty(old('del')))
        <div class="alert alert-danger text-center">
            <h4> {{ old('del')}} </h4>
        </div>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ano Academico</th>
                        <th>Cadeira</th>
                        <th>Turma</th>
                        <th>curso</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>

                        <td>{{ $row->turma->ano_academico }}</td>
                        <td>{{ $row->cadeira->nome }}</td>
                        <td>{{ $row->turma->nome }}</td>
                        <td>{{ $row->turma->curso->nome }}</td>
                        <td>
                            <a href="{{ route('pauta_turma', [$row->turma_id, $row->cadeira_id, $row->turma->curso->id] ) }}">adicionar pauta</a>
                        </td>
                        <th><a href="{{ route('pauta', [$row->cadeira_id, $row->turma_id, $row->turma->curso->id] ) }}">ver pauta</a></th>
                        {{--
                        <td>
                            {{ $row}}
                        </td>
                        --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $rows->links() }}
        </div>
    </div>
</div>
@endsection