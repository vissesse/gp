@extends('_layout/base')

@section('title')
Usuarios
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Cadastrar Usuario</h5>
          <p class="card-text">
            Cadastre aqui um novo <code>Usuario</code>.
          </p>
          <a href="{{ route('criar_usuario_form')}}" class="btn btn-secondary">
            Novo usuario
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Lista de usuarios</h5>
          <p class="card-text">
            Veja aqui a lista de <code>usuario</code> cadastrados.
          </p>
          <a href="{{ route('usuarios')}}" class="btn btn-secondary">
            Vá para Lista
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection