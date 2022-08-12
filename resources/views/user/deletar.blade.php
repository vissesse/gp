@extends('_layout/base')

@section('title')
Usuarios
@endsection
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Deletar Usuario</h5>
      <br>

      <p class="card-text">
        Você tem certeza que quer excluir o usuario: <b>{{ $usuario->nome }} {{ $usuario->sobrenome}}</b>?
      </p>

      <form method="post" action="{{ route('deletar_usuario',['id'=>$usuario->id]) }}">
        @csrf

        <hr />
        <div class="text-right">
          <a href="{{route('usuario')}}" class="btn btn-outline-danger">
            Cancelar
          </a>
          <button class="btn btn-danger">deletar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection