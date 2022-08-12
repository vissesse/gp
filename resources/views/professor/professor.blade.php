@extends('_layout/base')

@section('title')
Professores
@endsection


@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Professor <span class="right" style="float:right; color:green">
                <a href="{{ route('professor_create') }}">Criar</a></span>
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
        @if(empty($professores[0]))
        <h3>Nenhuma professor cadatrado. <a href="{{ route('professor_create') }}">Cadatrar Professor</a></span></h3>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr> 
                        <th>Nome</th>
                        <th>Cadeira a lecionar</th>
                        <th>Turma a lecionar</th>
                        <th>Ano Academico a lecionar</th>
                        <th>Curso a lecionar</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($professores as $row)
                    <tr> 
                        <td>{{ $row->nome }} </td>
                        <td>
                            @foreach($row->leciona as $leciona)
                            {{ $leciona->cadeira->nome }} @if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($row->leciona as $leciona)
                            {{ $leciona->turma->nome }} @if(!$loop->last) , @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($row->leciona as $leciona)
                            {{ $leciona->turma->ano_academico }} @if(!$loop->last) , @endif
                            @endforeach

                        </td>
                        <td>
                            @foreach($row->leciona as $leciona)
                            {{ $leciona->turma->curso->nome }} @if(!$loop->last) , @endif ()
                            @endforeach
                        </td>

                        <td><a class="btn btn-secondary" href="{{ route('professor_editar', $row->id ) }}">Editar</a> </td>
                        <td>
                            <form action="{{ route('professor_delete', $row->id) }}" method="POST">
                                @csrf
                                @method('DELETE') 
                                <button class="btn btn-danger" type="submit">delete</button>
                                
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $professores->links() }}
        </div>
        @endif
    </div>
</div>
@endsection