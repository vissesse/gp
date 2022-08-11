@extends('_layout/base')

@section('title')
Controle de lanacemento de notas
@endsection


@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registar Curso</h6>
    </div>
    <div class="card-body">
        @unless($row ??'')
        {!! Form::open(['route'=>['curso_store'], 'method'=>'post']) !!}
        @else
        {!! Form::open(['route'=>['curso_update', $row->id], 'method'=>'put']) !!}
        @endunless
        @csrf

        <div class="form-group row">

            <div class="col-sm-6">

                <label for="nome">Curso</label>
                <input  placeholder="Nome do curso..." class="form-control" type="text" name="nome" id="nome" value="{{ $row->nome ?? '' }}">
            </div>
            <div class="col-sm-6">


                <label for="anos_academicos">Anos Academico</label>
                <input placeholder="Total de anos academicos..." class="form-control" type="text" name="anos_academicos" id="anos_academicos" value="{{ $row->anos_academicos ?? '' }}">
            </div>

        </div>
        <div class="row">
            <button class="btn btn-primary" type="submit">Registar</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection