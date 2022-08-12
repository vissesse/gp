@extends('_layout/base')

@section('title')
Home
@endsection

@section('content')

<div class="row">
    @foreach($cursos as $curso)
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        @if($curso->id ==1)
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            @else
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            @endif
                            {{ $curso->nome }}
                        </div>
                        <div class="row no-gutters align-items-center">

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    @foreach($cursos as $curso)
    <div class="col-6 d-flex">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Aptos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="#"><span>{{ $statistica[$loop->index]['aptos'] }}%</span></a>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $statistica[$loop->index]['aptos'] }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Estudantes Não aptos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a class="" href="#"><span>{{ $statistica[$loop->index]['naptos'] }}%</span></a>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $statistica[$loop->index]['naptos'] }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Estudantes pendente
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <a href="#"><span>{{ $statistica[$loop->index]['pendente'] }}%</span></a>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $statistica[$loop->index]['pendente'] }} %" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>






<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pautas</h5>
                <p class="card-text">
                    Ver todas as pautas
                </p>
                <a href="{{ route('controle_lancamento_pauta') }}" class="btn btn-primary col-12">
                    ver pautas
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Professores</h5>
                <p class="card-text">
                    Veja aqui a lista de <code>professores</code> cadastrados.
                </p>
                <a href="{{ route('professores') }}" class="btn btn-primary col-12">
                    Vá para Lista de professores
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Estudantes</h5>
                <p class="card-text">
                    Veja aqui a lista de <code>estudantes</code> cadastrados.
                </p>
                <a href="{{ route('estudantes') }}" class="btn btn-primary col-12">
                    Vá para Lista de estudantes
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">cadeiras</h5>
                <p class="card-text">
                    Veja aqui a lista de <code>cadeiras</code> e suas respectivas pautas.
                </p>
                <a href="{{ route('cadeiras_index') }}" class="btn btn-primary col-12">
                    Vá para Lista de cadeiras
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>