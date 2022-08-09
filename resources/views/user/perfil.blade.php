@extends('_layout/base')

@section('title')
Perfil
@endsection

@section('content')
<div class="container">
    <div class="card col-md-8" style="margin-left:15%">
        <div class='card-body row'>
            <div class="card col-md-4 order-md-2 mb-4">
                <div class="usuario-perfil">
                    <img class="" src="/img/carlos.png" alt="img">
                </div>
                <a href="" class="btn btn-lg btn-secondary">mudar foto</a>
            </div>
            <div class="col-md-8 order-md-2 mb-4">
                <h4 class="card-text">Nome: <strong>{{$usuario->nome}}</strong> </h4>
                <h4 class="card-text">Email: <strong>{{$usuario->email}}</strong></h4>
            </div>
        </div>
        <a href="{{ route('actualizar_usuario_form', ['id'=>$usuario->id])}}" class="btn btn-lg btn-secondary btn-block">Editar</a>
    </div>
</div>

@endsection