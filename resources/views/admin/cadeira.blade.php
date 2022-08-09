@extends('_layout/base')

@section('tittle')
Cadeiras
@endsection


@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{$cadeira[0]->curso->nome }} - Cadeiras
            <span class="right" style="float:right; color:green"> <a href="{{ route('cadeira_create') }}">Adiconar cadeira</a></span>
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
        @unless($cadeira[0])
        <h3>Nenhuma disciplina cadastrada. <a href="{{ route('cadeira_create') }}">Cadastrar disciplina</h3></a>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cadeira</th>
                        <th>Ano academcio</th>
                        <th>Semestre</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadeira as $row)
                    <tr>

                        <td>{{ $row->cadeira->nome }}</td>
                        <td>{{ $row->ano_academico }} </td>
                        <td>{{ $row->semestre }}</td>
                        <td class="text-center">
                            {!! Form::open(['route'=>['cadeira_delete', $row->id], 'method'=>'delete']) !!}
                            <a class="btn btn-primary" href="{{ route('Admin_cadeira_pauta', $row->cadeira->id ) }}">
                                visualizar pauta </a>
                            @if(empty($pauta ?? ''))
                            <a class="btn btn-secondary" href="{{ route('cadeira_editar', $row->id ) }}">
                                Editar Cadira
                            </a>
                            <button class="btn btn-danger" type="submit">delete Cadeira</button>
                            @endif
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $cadeira->links()}}
        </div>
    </div>
</div>

@endunless

@endsection