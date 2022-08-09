@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <p> Edite os dados do cliente que não estejam conforme.</p>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-primary">

                <form action="" method="post">

                    <div class="card-body">

                        {{ csrf_field() }}

                        <div class="card-header">
                            <h3 class="card-title">Editar Cliente</h3>
                        </div>
                        <div class="form-group">
                            <label for="">ID</label>
                            <input type="text" class="form-control" name="id_form" value="{{ $id }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="nome_form" id="nme" value="{{ $nome }}"
                                placeholder=" seu nome">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email_form" id="email"
                                value="{{ $email }}" placeholder=" seu email">
                        </div>

                        <div class="form-group">
                            <label for="">Telefne</label>
                            <input type="text" class="form-control" name="telefone_form" id="telf"
                                value="{{ $telefone }}" placeholder=" seu telefone">
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar Novo</button>
                        </div>

                    </div>

            </div>

        </div>
    </div>

    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
