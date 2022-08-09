@extends('adminlte::page')

@section('title', 'Novo Cliente')

@section('content_header')
    <h1>Novo Cliente</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <div class="row align-center" >

        <div class="col-md-6">

            <div class="card card-primary">

                <form action="" method="post">

                    <div class="card-body">

                        {{ csrf_field() }}

                        <div class="card-header">
                            <h3 class="card-title">Cadastrar Cliente</h3>
                        </div>

                        <div class="form-group">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="nome_form" id="nme" placeholder=" seu nome">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email_form" id="email" placeholder=" seu email">
                        </div>

                        <div class="form-group">
                            <label for="">Telefne</label>
                            <input type="text" class="form-control" name="telefone_form" id="telf"
                                placeholder=" seu telefone">
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
