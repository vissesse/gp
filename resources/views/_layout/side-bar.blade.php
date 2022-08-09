<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GP<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <span>Menu</span>
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Menu</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if(Auth::check())
                @if(Auth::user()->status==true and Auth::user()->categoria== 'Admin')
                <h6 class="collapse-header">Admin:</h6>
                <a class="collapse-item" href="{{ route('cursos') }}">Curso</a>
                <a class="collapse-item" href="{{ route('cadeiras_index') }}">Disciplina</a>
                <a class="collapse-item" href="{{ route('turmas') }}">Turma</a>

                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Exame:</h6>
                <a class="collapse-item" href="{{ route('tipo_avaliacao') }}">Exame</a>
                <a class="collapse-item" href="{{ route('controle_lancamento_pauta') }}">Pautas</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Utente:</h6>
                <a class="collapse-item" href="{{ route('professores') }}">Professor</a>
                <a class="collapse-item" href="{{ route('estudantes') }}">Estudante</a>
                <a class="collapse-item" href="{{ route('usuario') }}">Usuarios</a>
                @elseif(Auth::user()->status==true and Auth::user()->categoria== 'Professor')
                <a class="collapse-item" href="{{ route('professor_turmas') }}">Professor-Cadeiras</a>

                @elseif(Auth::user()->status==true and Auth::user()->categoria== 'Estudante')
                <a class="collapse-item" href="{{ route('estudante_cadeiras') }}">Visualizar pauta</a>
                @endif
                @endif
            </div>
        </div>
    </li>




    <!-- Nav Item - Charts -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->