@extends('_layout/base')

@section('tittle')
Cadeiras
@endsection


@section('content')

@unless($cadeira ?? '')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cadeiras a frequentar </h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cadeira</th>
                        <th>Ano academcio</th>
                        <th>Semestre</th>
                        <th>Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>

                        <td>{{ $row->cadeira->nome }}</td>
                        <td>{{ $row->ano_academico }} </td>
                        <td>{{ $row->semestre }}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('estudante_pauta', $row->cadeira->id ) }}">
                                    visualizar Pauta
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rows->links() }}
        </div>
    </div>
</div>

@endunless
@endsection