@extends('_layout/base')

@section('title')
Login
@endsection


@section('login')

<div style="margin-left: 35%; margin-top: 5%;">
    <div class="container">
        <div class="card col-sm-4">
            <div class="card-title center">
                <h5 class="title text-center text-primary"><b>GP-Login</b></h5>
                @if(!empty(old('smg')))
                <div class="alert alert-danger">
                    {{ old('smg')}}
                </div>
                @endif
            </div>
            <div class="card-body ">
                <div class="form-group">
                       <form action="{{ route('post_login') }}" method="post">
                        @csrf
                    <div class="row">
                        <label for="nome">Usuario</label>
                        <input class="form-control" type="text" name="nome" id="nome">
                        @error('nome')
                        <span class='text-danger'>{{ $message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="password">Senhar</label>
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                        <span class='text-danger'>{{ $message}}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="row">
                        <button class="btn btn-primary col-sm-12" type="submit">logar</button>
                    </div>
                       </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection