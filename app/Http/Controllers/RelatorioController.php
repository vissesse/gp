<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pauta\Pauta;
use App\Model\Cadeira;
use App\Model\CursoAnoAcademicoCadeira;
use App\Model\Classificacoe;
use App\RelatorioModel;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;


class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //

        $query = RelatorioModel::where('id', '=', 1);

        return Excel::create("relatorio-pauta-ativos", function ($excel) use($query) {
    
            $excel->setTitle('RelatorioModel')->sheet('RelatorioModel', function ($sheet) use($query) {
    
                $sheet->appendRow([
                    'media', 
                    'exame',
                    'recurso',
                ]);
    
                // Os dados são carregados de 50 em 50, para não sobrecarregar a memória
                $query->chunk(50, function ($usuarios) use ($sheet) {
    
                    foreach ($usuarios as $usuario) {
    
                        $sheet->appendRow([
                           $usuario->media,
                           $usuario->exame,
                           $usuario->recurso,
                        ]);                        
                    }
                });
    
                $sheet->row(1, function ($row) {
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });
            });
    
        })->download('xlsx');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function export($cadeira_id)
    {
        //640-937-838-3
        $c = Cadeira::find($cadeira_id);
        $cadeira = CursoAnoAcademicoCadeira::where('cadeira_id', $c->id)->first();
        $rows = Classificacoe::where('curso_ano_academico_cadeira_id', $cadeira->id)->orderBy('estudante_id')->paginate(5);
        $semestre =  $cadeira->semestre;
        $ano_lectivo = $rows[0]->ano_lectivo;
        $cadeira_id = $cadeira->cadeira_id;
        $cadeira_nome =  $cadeira->cadeira->nome;
        $curso_id =  $cadeira->curso_id;
        $curso_nome =  $cadeira->curso->nome;
        $turma_id =  $rows[0]->turma_id;
        $professor_id = $rows[0]->professor_id;
        $pauta = [];
        if (empty($rows[0])) {
            return view('info', ['msg' => "Pauta nao disponivel!..."]);
        }

        $cabecalho = [
            'cadeira_id' => $cadeira_id,
            'curso_id' => $curso_id,
            'curso' => $curso_nome,
            'turma_id' => $turma_id,
            'cadeira' => $cadeira_nome,
            'ano_academico' => $cadeira->ano_academico,
            'semestre' => $semestre,
            'ano_lectivo' => $ano_lectivo
        ];
        foreach ($rows as $row) {
            $pauta1 = new Pauta($row->id, $row->estudante, $row->nota);
            array_push($pauta, $pauta1);
            $data = array(
                'professor_id' => $professor_id,
                'turma_id' => $turma_id,
                'cadeira_id' => $cadeira_id,
                'curso' => $cadeira_nome,
                'semestre' => $semestre,
                'processo' => $pauta1->estudanteProcesso(),
                'estudante' => $pauta1->estudanteNome(),
                'p1' => $pauta1->getP1(),
                'p2' => $pauta1->getP2(),
                'ac' => $pauta1->getAC(),
                'media' => $pauta1->getMedia(),
                'exame' => $pauta1->getExame(),
                'recurso' => $pauta1->getRecurso(),
                'exame_especial' => $pauta1->getEXE(),
                'resultado_final' => $pauta1->resultado(),
                'observacao' => $pauta1->getObs(),

            );
           // RelatorioModel::create($data);
        }

        return Excel::download(new \App\Exports\RelatorioExport, 'relatorio-pautas.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
