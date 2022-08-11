@extends('_layout/base')

@section('title')
Pautas-estatisticas
@endsection


@section('content')
<div class="container">
    <h4>Estastisticas</h4>
    <hr>
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $curso->nome }}</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card alert-success">
                                <h6 class="card-title text-primary text-center">
                                    <span>Estudante aptos</span>
                                </h6>
                                <div class="card-body text-center">
                                    <a href="#"><span>{{ $statistica[$loop->index]['aptos'] }}%</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card alert-danger">
                                <h6 class="card-title text-center">
                                    <span>N aptos</span>
                                </h6>
                                <div class="card-body text-center">
                                    <a class="" href="#"><span>{{ $statistica[$loop->index]['naptos'] }}%</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card alert-warning">
                                <h6 class="card-title text-center">
                                    <span>Pendente</span>
                                </h6>
                                <div class="card-body text-danger text-center">
                                    <a href="#"><span>{{ $statistica[$loop->index]['pendente'] }}%</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br> 
                </div>
            </div>
        </div>
        @endforeach
        <br>
    </div>
    <br>

    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $curso->nome }}</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card alert-success">
                                <h6 class="card-title text-center">
                                    <span>Cadeiras com aptos</span>
                                </h6> 
                                <div class="card-body">
                                    <a href="#"><span>50% aptos</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card alert-danger">
                                <h6 class="card-title text-center">
                                    <span>N aptos</span>
                                </h6>
                                <div class="card-body">
                                    <a href="#"><span>50 estudantes</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card alert-warning">
                                <h6 class="card-title text-center">
                                    <span>Pendente</span>
                                </h6>
                                <div class="card-body text-danger">
                                    <a href="#"><span>50 estudantes</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection