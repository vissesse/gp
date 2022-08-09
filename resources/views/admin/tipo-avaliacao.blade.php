@extends('_layout/base')

@section('title')
Avaliacaoes
@endsection


@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Exames
            <span class="right" style="float:right; color:green"><a href="{{ route('tipo_avaliacao_create') }}"> Novo Criar</a></span>
        </h6>
    </div>
    <div class="card-body">
        @unless($tipo_avalicao[0])
        <h3>Nenhuma tipo de exame registado. <a href="{{ route('tipo_avaliacao_create') }}"> Registar Exame</a></h3>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Avaliacao</th>
                        <th>Curso</th>
                        <th>Acoes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($tipo_avalicao as $row)
                    <tr>


                        <td>{{ $row->nome }} </td>
                        <td>{{ $row->curso->nome }}</td>

                        <td><a class="btn btn-secondary" href="{{ route('tipo_avaliacao_editar', $row->id ) }}">Editar</a> </td>
                        <td>
                            {!! Form::open(['route'=>['tipo_avaliacao_delete', $row->id], 'method'=>'delete']) !!}
                            <button class='btn btn-danger' type="submit">delete</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tipo_avalicao->links() }}
        </div>
        @endunless
    </div>
</div>
@endsection