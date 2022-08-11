@extends('_layout/base')

@section('tittle')
Cadeiras
@endsection


@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> {{$cadeira[0]->curso->nome }} - Cadeiras Filtros
            <span class="right" style="float:right; color:green"> <a href="{{ route('cadeira_create') }}">Buscar</a></span>
        </h6>
    </div>
    <div class="card-body">
       <form action="">
        <div class="row py-2">
            <div class="col-4">
                <label for="select_ano_academico">Ano Academico</label>
                <select class="form-control" name="select_ano_academico" id="select_ano_academico">
                    <option value="1">1-ano</option>
                    <option value="2">2-ano</option>
                    <option value="4">3-ano</option>
                    <option value="4">4-ano</option>
                    <option value="5">5-ano</option>
                </select>
            </div>

            <div class="col-4">
                <label for="select_semestre">Semestre</label>
                <select class="form-control" name="select_semestre" id="select_semestre">
                    <option value="1">1-semestre</option>
                    <option value="2">2-semestre</option>
                </select>
            </div>

            <div class="col-4">
                <label for="select_turma">Turma</label>
                <select class="form-control" name="select_turma" id="select_turma">
                    @foreach($turmas as $turma )
                    <option value="select_ano_academico">{{ $turma->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="col-12 btn btn-outline-primary" type="submit">buscar</button>
</form>
    </div>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
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
                            <form action="{{ route('cadeira_delete', $row->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                
                                <a class="btn btn-primary" href="{{ route('Admin_cadeira_pauta', [$row->cadeira->id, $turma ?? '$turmas[0]->id']) }}">
                                    visualizar pauta </a>
                                @if(empty($pauta ?? ''))
                                <a class="btn btn-secondary" href="{{ route('cadeira_editar', $row->id ) }}">
                                    Editar Cadira
                                </a>
                                <button class="btn btn-danger" type="submit">delete Cadeira</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
            <div class="row" width=24 heigth=24>
                {{ $cadeira->links()}}
            </div>
        </div>
    </div>  
</div>

@endunless

@endsection