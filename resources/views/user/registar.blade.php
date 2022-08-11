@extends('_layout/base')

@section('title')
Registar usuario
@endsection

@section('content')
<div class="container">
    <div class="card col-md-8" style="margin-left:15%">
        <div class='card-body'>
            <h4 class="card-title">Cadastrar usuario</h4>

            @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            @if(old('msg'))
            @if(old('criar_usuario')->tipo_msg)
            <ul class="alert alert-warning">
                <li>{{ old('$criar_usuario')->msg}}</li>
            </ul>
            @elseif(old('criar_usuario')->tipo_msg)
            <ul class="alert alert-success">
                <li>{{old('criar_usuario')->msg}}!</li>
            </ul>
            @elseif(old('criar_usuario')->tipo_msg=='email' )
            <ul class="alert alert-warning">
                <li>{{ old('$criar_usuario')->msg}}</li>
            </ul>
            @endif
            @endif
            @if($usuario->id ?? '')
            <form method="POST" action="{{ route('actualizar_usuario', ['id'=>$usuario->id]) }}">
                @method('PUT')
                @else
                <form method="POST" action="{{route('usuario_criado')}}">
                    @endif
                    @csrf
                    <label for="name">Nome:</label>
                    <input class="form-control" type="text" name="nome" required value="{{$usuario->nome ?? ''}}">


                    <label>email:</label>
                    <input class="form-control" type="email" name="email" placeholder="exempl@email.com" value="{{ $usuario->email ?? '' }}" />

                    <label>senha:</label>
                    <input class="form-control" type="password" name="password" />

                    <label for="confirmar_senha"> confirme a senha:</label>
                    <input class="form-control" type="password" name="confirmar_senha" />

                    <br>
                    <button class="btn btn-primary aling-center">@if($usuario->id ?? '') Actualizar @else Criar @endif usuario </button>
                    <a class="btn btn-danger aling-center" href="{{ route('usuario') }}"> cancelar</a>

                </form>
        </div>
    </div>
</div>
@endsection