@extends('_layout/base')

@section('title')
Cdastrar Professor
@endsection


@section('content')
<h4>Cadastrar Professor</h4>
<ul>
    @foreach($errors as $erro)
    <li style="color:red">erro {{ $error }}</li>

    @endforeach
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar Professor</h6>

    </div>
    <div class="card-body">

        @unless($row['professor'] ?? '')
        {!! Form::open(['route'=>['professor_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['professor_update', $row['professor']->id], 'method'=>'put']) !!}
        <input type="hidden" name="professor_id" id="" value="{{ $row['professor']->professor->id }}">
        @endunless

        <div class="form-group row">
            <div class="col-md-4">

                <label for="Professor nome">Nome</label>
                <input class="form-control" type="text" placeholder="Nome do professor..." name="nome" id="nome" value="{{ $row['professor']->professor->nome ?? '' }}">

                <label for="Professor nome">Especialidade</label>
                <input class="form-control" type="text" placeholder="Professor do professor..." name="especialidae" id="especialidae" value="{{ $row['professor']->professor->especialidade ?? '' }}">

                <label for="Professor nome">Contacto</label>
                <input class="form-control" type="text" placeholder="Contacto do professor..." name="contacto" id="contacto" value="{{ $row['professor']->professor->contacto ?? '' }}">


                <label for="Professor nome">Email</label>
                <input class="form-control" type="email" placeholder="Email do professor..." name="email" id="email" value="{{ $row['professor']->professor->email ?? '' }}">
            </div>
            <div class="col-md-8">
                <div class="row">{{-- 57380698795-prepago-198-393-487-166-78549006 --}}

                    <div class="col-md-6">

                        <label for="turma">Leciona Turma</label>
                        <select class="form-control" name="turma[]"  size="12" multiple id="turma">
                            <option> Selecine a turma a lecionar....</option>
                            @foreach($row['turmas'] as $turma)
                                @isset($row['professor'])
                                    @foreach($row['professor']->professor->leciona as $leciona) 
                                        @if($turma->id == $leciona->turma_id )
                                                <option selected value="{{ $turma->id }}">{{ $turma->nome }}-{{ $turma->curso->nome }}- {{ $turma->ano_academico }}</option>
                                                @php 
                                                    $t = true;
                                                @endphp
                                        @endif 
                                    @endforeach
                                    
                                    @php 
                                            if(!($t ?? ''))
                                        echo "<option value='$turma->id '>".$turma->nome.'-'.$turma->curso->nome.'-'.$turma->ano_academico."</option>";
                                    @endphp  
                                @else
                                    <option value="{{ $turma->id }}">{{ $turma->nome }} -{{ $turma->curso->nome }}-{{ $turma->ano_academico }}</option>
                                @endisset
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <button class="btn btn-primary" type="submit">Registar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection