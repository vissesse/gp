@extends('_layout/base')

@section('tittle')
Cadeiras
@endsection


@section('content')

@unless($cadeira ?? '')
<h4><a href="{{ route('cadeira_create') }}">Criar</a></h4>
@else

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cadeiras <span class="right" style="float:right; color:green"> <a href="{{ route('cadeira_create') }}">Adiconar cadeira</a></span></h6>
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
                        <th>Cadeira</th>
                        <th>Ano academcio</th>
                        <th>Semestre</th>
                        <th>Curso</th>
                        <th>Acoes</th>
                        <th>deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadeira as $row)
                    <tr>

                        <td>{{ $row->cadeira->nome }}</td>
                        <td>{{ $row->ano_academico }} </td>
                        <th>{{ $row->semestre }}</th>
                        <td>{{ $row->curso->nome }}</td>

                        <td><a href="{{ route('cadeira_editar', $row->id ) }}">
                                <div class="icon-circle bg-success">editar
                                    <i class="fas fa-edit text-white"></i>

                            </a> </td>
                        <td>
                            {!! Form::open(['route'=>['cadeira_delete', $row->id], 'method'=>'delete']) !!}
                            <button class="btn btn-primary" type="submit">delete</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endunless

@endsection