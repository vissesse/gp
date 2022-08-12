<?php

namespace App\UseCases\ClassificacaoUseCase;

use App\Models\Classificacoe;
use App\repository\implemetions\ClassificacoesRepository;
use \App\Http\Controllers\Pauta\Pauta;
class ClassificacaoUseCase extends ClassificacoesRepository{
     
    function __construct(Classificacoe $model){
        $this->model = $model;
    }




    public function percenteagem($percentagem, $curso)
    {
        $estudantes = \App\Models\Estudante::join('turmas', 'turmas.id', '=', 'estudantes.turma_id')
            ->where('turmas.curso_id', '=', $curso)
            ->select('estudantes.nome')
            ->count();
        $p = $estudantes / 100;
        return $percentagem / $p;
    }

    public function clafissicacao()
    {
        $cursos = \App\Models\Curso::all();
        $estatistica = [];
        foreach ($cursos as $curso_selecionado) {
            $pauta = [];
            $statistica = [];

            $curso_cadeiras = \App\Models\CursoAnoAcademicoCadeira::where('curso_id', '=', $curso_selecionado->id)->get();
            foreach ($curso_cadeiras as $cadeira) {
                $rows = Classificacoe::where('curso_ano_academico_cadeira_id', $cadeira->id)->orderBy('estudante_id')->get();
                foreach ($rows as $row) {
                    $pauta1 = new Pauta($row->id, $row->estudante, $row->nota);
                    array_push($pauta, $pauta1);
                }
            }
            $aprovados = 0;
            $reprovados = 0;
            $pendente = 0;
            foreach ($pauta as $value) {
                if (is_numeric($value->resultado())) {
                    if ($value->resultado() >= 10)
                        $aprovados++;
                    if ($value->resultado() < 10)
                        $reprovados++;
                } else {
                    $pendente++;
                }
            }
            $statistica = [
                'aptos' => round($this->percenteagem($aprovados, $curso_selecionado->id), 1),
                'naptos' => round($this->percenteagem($reprovados, $curso_selecionado->id), 1),
                'pendente' => round($this->percenteagem($pendente, $curso_selecionado->id), 1)
            ];
            array_push($estatistica, $statistica);
        }
        return $estatistica;

        
    }
}
