@extends('_layout/base')

@section('title')
Avaliacaoes
@endsection


@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Estudante <span class="right" style="float:right; color:green">
                <a href="{{ route('estudante_create') }}">Criar</a></span>
        </h6>
        @if(!empty(old('add')))
        <div class="alert alert-success text-center">
            <h4 class="">{{ old('add') }}</h4>
        </div>
        @elseif(!empty(old('del')))
        <div class="alert alert-danger text-center">
            <h4> {{ old('del')}} </h4>
        </div>
        @endif
    </div>
    <div class="card-body">
        @if(empty($estudantes[0]))
        <h3>Nenhum estudante cadatrado. <a href="{{ route('estudante_create') }}">Cadastrar estudante</a></span></h3>
        @else
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Processo</th>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Curso</th>
                        <th>Ano Academico</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($estudantes as $row)
                    <tr>

                        <td>{{ $row->processo}}</td>
                        <td>{{ $row->nome }} </td>
                        <td>{{ $row->turma->nome }}</td>
                        <td>{{ $row->turma->curso->nome }}</td>
                        <th>{{ $row->turma->ano_academico }}</th>

                        <td><a class="btn btn-secondary" href="{{ route('estudante_editar', $row->id ) }}">Editar</a> </td>
                        <td>
                            <form action="{{ route('estudante_delete', $row->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">delete</button>
                                
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            {{ $estudantes->links()}}
        </div>
        @endif
    </div>
</div>

@endsection