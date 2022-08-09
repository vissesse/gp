@extends('_layout/base')

@section('tittle')
    Cadeiras
@endsection


@section('content')
    @if (!empty($rows) or !empty($rows[0]))
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold  "> <span>Curso: {{ $cabecalho['curso'] }}</span> <br>
                    <span class="text-"> Cadeira: {{ $cabecalho['cadeira'] }} </span>

                    @if (Auth::User()->categoria == 'Professor')
                        | <a
                            href="{{ route('pauta_turma', [$cabecalho['turma_id'], $cabecalho['cadeira_id'], $cabecalho['curso_id']]) }}">Adicionar
                            pauta</a>
                    @endif
                    <span class="right" style="float:right; color:green"><span>Ano lectivo:
                            {{ $cabecalho['ano_lectivo'] }}</span> |
                        <span>Ano Academico: {{ $cabecalho['ano_academico'] }}</span>| <span> Semestre:
                            {{ $cabecalho['semestre'] }}</span></span>
                </h6>
                @if (!empty(old('add')))
                    <div class="alert alert-success text-center">
                        <h4>{{ old('add') }}</h4>
                    </div>
                @elseif(!empty(old('del')))
                    <div class="alert alert-danger text-center">
                        <h4> {{ old('del') }} </h4>
                    </div>
                @endif
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
                                <th>AC</th>
                                <th>media</th>
                                <th>Exame</th>
                                <th>Recurso</th>
                                <th>Exame especial</th>
                                <th>Resultado Final</th>
                                <th>Observacao</th>
                                @if (Auth::user()->categoria == 'Professor')
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $row->estudanteProcesso() }}</td>
                                    <td>{{ $row->estudanteNome() }} </td>
                                    <td class="text-center">{{ $row->getP1() }} </td>
                                    <td class="text-center">{{ $row->getP2() }} </td>
                                    <td class="text-center">{{ $row->getAC() }} </td>
                                    <td class="text-center">{{ $row->getMedia() }} </td>
                                    <td class="text-center">{{ $row->getExame() }} </td>
                                    <td class="text-center">{{ $row->getRecurso() }} </td>
                                    <td class="text-center">{{ $row->getEXE() }}</td>
                                    <td class="text-center">{{ $row->resultado() }}</td>
                                    <td class="text-center">{{ $row->getObs() }}</td>
                                    @if (Auth::user()->categoria == 'Professor')
                                        <td>
                                            {!! Form::open(['route' => ['pauta_delete', $row->idPauta()], 'method' => 'delete']) !!}
                                            <a class="btn btn-secondary text-center"
                                                href="{{ route('cadeira_editar', $row->idPauta()) }}">
                                                editar
                                            </a>
                                            <button class="btn btn-danger" type="submit">delete</button>
                                            {!! Form::close() !!}

                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    @if (!(Auth::user()->categoria == 'Professor'))
                        <a href="{{ route('exportar_pauta', $cabecalho['cadeira_id'])}}" class="btn btn-primary">Gerar pauta</a>
                    @endif

                </div>
            </div>
        </div>
    @else
        <h3>Nenhuma pauta disponivel </h3>
    @endif
@endsection
