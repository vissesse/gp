@extends('_layout/base')

@section('title')
Usuarios
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">

        <h5 class="card-title">Usuario</h5>

        @if(old('nome'))
        <div class="alert alert-success">
            <h4 class="text-center">Usuario<strong> {{old('nome')}}</strong> Adicionado!<h4>
        </div>
        @endif

        @if(empty($usuarios[0]))
        <div class="alert alert-danger">
            <h4> Voce nao tem nenhum usuario cadastrado</h4>
            <a href="{{route('criar_usuario')}}" class="badge badge-secondary badge-pill"> cadastrar usuario</a>
        </div>
        @else
        <p class="card-text d-flex justify-content-between align-items-center mb-3">
            <span>Lista de <code>Usuarios</code> cadastrados.</span>
        </p>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scolp='col'>Nome</th>
                        <th scolp='col'>E-mail</th>
                        <th scolp='col'>Criado em:</th>
                        <th scolp='col'>Categoria</th>

                        <th scolp='col' class="text-center">Accoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr @if(Auth::User()->id==$usuario->id) class='alert-success' @endif >
                        <td>{{$usuario->nome}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->updated_at}}</td>
                        <td>{{$usuario->categoria }}</td>
                        <td class='text-center'>
                        @if(!(Auth::User()->id==$usuario->id))
                            <a class='btn btn-danger' href="{{ route('deletar_usuario_form', ['id'=>$usuario->id]) }}">Deletar</a>
                            @else
                            <a class='btn btn-outline-primary' href="{{ route('actualizar_usuario_form', ['id'=>$usuario->id]) }}">editar</a>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $usuarios->links() }}
           
        </div>
        @endif
    </div>
</div>
@endsection