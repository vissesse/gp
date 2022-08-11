@extends('_layout/base')

@section('title')
Pautas
@endsection


@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cursos
            <span class="right" style="float:right; color:green"><a href="{{ route('curso_create' ) }}"> Novo Criar</a></span>
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
        @if(empty($rows[0]))

        <h3><a href="{{ route('curso_create') }}">Cadastrar cursos</h3> </a>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Anos Academicos</th>
                        <th>Acoes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr>
                        <td>{{ $row->nome }}</td>
                        <td>{{ $row->anos_academicos }} </td>

                        <td><a class="btn btn-secondary" href="{{ route('curso_editar', $row->id ) }}">Editar</a> </td>
                        <td>
                            {!! Form::open(['route'=>['curso_delete', $row->id], 'method'=>'delete']) !!}
                            <button class="btn btn-danger" type="submit">delete</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>


@endsection