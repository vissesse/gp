@extends('_layout/base')

@section('tittle')
Procurar
@endsection


@section('content')

@unless(empty($rows) or empty($rows[0]) )
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                    <tr>
                        <th>Processo</th>
                        <th>Estudante</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>media</th>
                        <th>Exame</th>
                        <th>Recurso</th>
                        <th>Exame especial</th>
                        <th>Resultado</th>
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>

                        <td>{{ $row->estudante->processo }}</td>
                        <td>{{ $row->estudante->nome }} </td>
                        <th>{{ $row->nota }}</th>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td> 
                        <td>Nada a declarar</td>
                        @if(!(Auth::user()->categoria == 'Professor'))
                        <td>
                            <a class="btn btn-secondary" href="{{ route('cadeira_editar', $row->id ) }}">
                                    editar
                            </a>
                        </td>
                        @endif
                  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rows->links() }}
        </div>
    </div>
</div>
@else
<h3>Nenhuma dado encontrado... </h3>
@endunless

@endsection