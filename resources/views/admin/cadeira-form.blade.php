@extends('_layout/base')

@section('title')
    Cadeiras
@endsection


@section('content')
    <h4>Criar Cadeira</h4>
    <ul>
        @foreach ($errors as $erro)
            <li style="color:red">erro {{ $erro }}</li>
        @endforeach
    </ul>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registar Cadeiras</h6>

        </div>
        <div class="card-body">

            @unless($row['cadeira'] ?? '')
                {!! Form::open(['route' => ['cadeira_store'], 'method' => 'post']) !!}
            @else
                {!! Form::open(['route' => ['cadeira_update', $row['cadeira']->id], 'method' => 'put']) !!}
                <input type="hidden" name="cadeira_id" value="{{ $row['cadeira']->id ?? '' }}">
            @endunless
            <div class="form-group row">
                <div class="col-sm-6">

                    <label for="nome">Cadeira</label>
                    <input class="form-control" type="text" placeholder="Nome da cadeira..." name="nome"
                        id="nome" value="{{ $row['cadeira']->cadeira->nome ?? '' }}">

                    <label for="ano_academico">Ano Academico</label>
                    <select class="form-control" name="ano_academico" id="ano_academico">
                        @php
                            for ($i = 1; $i <= 5; $i++) {
                                if (str_contains($row['cadeira']->ano_academico ?? '', $i)) {
                                    echo "<option value='$i-ano' selected >$i-ano</option>";
                                } else {
                                    echo "<option value='$i-ano'>$i-ano</option>";
                                }
                            }
                        @endphp
                    </select>

                    {{-- <input type="text" placeholder="Respectivo ano academico " name="ano_academico" id="ano_academico" value="{{ $row['cadeira']->ano_academico ?? '' }}"> --}}

                </div>
                <div class="col-sm-6">

                    <label for="semestre">Semestre</label>
                    <select class="form-control"  id="semestre" name="semestre">
                        @php
                            $semestre = '1-semestre';
                            $semestre_2 = '2-semestre';
                            
                            if ($row['cadeira']->semestre ?? '') {
                                $semestres_old = $row['cadeira']->semestre;
                                echo "<option value='$semestres_old' selected>$semestres_old</option>";
                                if (str_contains($semestres_old, '1')) {
                                    echo "<option value='$semestre'>2-semestre</option>";
                                } else {
                                    echo "<option value='$semestre_2'>1-semestre</option>";
                                }

                            } else {
                                echo "<option value='$semestre'>1 semestre</option>";
                                echo "<option value='$semestre_2'>2 semestre</option>";
                            }
                        @endphp
                    </select>
                    {{-- <input class="form-control" type="text" placeholder="Respectivo semestre..." name="semestre" id="semestre" value="{{ $row['cadeira']->semestre ?? '' }}"> --}}


                    <label for="curso_id">Curso</label>
                    <select name="curso_id" id="curso_id" class="form-control">
                        <option>Selecioe o curso...</option>
                        @foreach ($row['cursos'] as $curso)
                            @isset($row['cadeira'])
                                @if ($curso->id == $row['cadeira']->curso_id)
                                    <option selected value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                @else
                                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                @endif
                            @else
                                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                            @endisset
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-primary col-lg-2 float-right" type="submit">Registar</button>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
