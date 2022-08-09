<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pauta\Pauta;
use App\Http\Requests\PautaRequest;
use App\Model\Cadeira;
use App\Model\Classificacao;
use App\Model\Classificacoe;
use App\Model\Curso;
use App\Model\CursoAnoAcademicoCadeira;
use App\Model\Estudante;
use App\Model\Nota;
use App\Model\Professor;
use App\Model\ProfessorLecionaTurma;
use App\Model\TipoAvaliacao;
use App\Model\Turma;
use Exame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;
use SebastianBergmann\Type\ObjectType;
use SebastianBergmann\Type\TypeName;

use function PHPSTORM_META\type;

class PautaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function percenteagem($percentagem, $curso)
    {
        $estudantes = Estudante::join('turmas', 'turmas.id', '=', 'estudantes.turma_id')
            ->where('turmas.curso_id', '=', $curso)
            ->select('estudantes.nome')
            ->count();
        $p = $estudantes / 100;
        return $percentagem / $p;
    }

    public function index()
    {
        $cursos = Curso::all();
        $estatistica = [];
        foreach ($cursos as $curso_selecionado) {
            $pauta = [];
            $statistica = [];

            $curso_cadeiras = CursoAnoAcademicoCadeira::where('curso_id', '=', $curso_selecionado->id)->get();
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
        return view('admin.pautas.pautas_index', ['cursos' => $cursos, 'statistica' => $estatistica]);
    }

    public function pautaTurma($turma_id, $cadeira_id, $curso_id, $classificacao = null, $smg = null)
    {

        $estudantes = Estudante::where('turma_id', $turma_id)->get();
        $curso = CursoAnoAcademicoCadeira::where('cadeira_id', $cadeira_id)->first();
        $turma = Turma::find($turma_id);
        $tipo = TipoAvaliacao::all();
        $row = [
            'turma_id' => $turma_id,
            'turma' => $turma->nome,
            'cadeira_id' => $cadeira_id,
            'msg' => $smg,
            'pauta' => $classificacao,
            'estudantes' => $estudantes,
            'tipo_avaliacoes' => $tipo,
            'curso' => $curso
        ];
        #return $curso->cadeira;
        return view('professor.cadeira-pauta-form', ['row' => $row]);
    }

    public function pautaTurmaStore(PautaRequest $request)
    {
        $estudante = $request->estudante_id;
        $cursoano_academico_id = $request->curso;
        $cadeira_id = $request->cadeira_id;
        $turma_id = $request->turma_id;
        $professor = Professor::where('user_id', Auth::user()->id)->first()->id;
        $tipo_avaliacao = $request->tipo_avaliacao;
        $valor = $request->nota;
        $msg = [];
        $cadeira = CursoAnoAcademicoCadeira::where('cadeira_id', '=', $cadeira_id)->first();
        $estudante_classificacao = Classificacoe::where("estudante_id", '=', $estudante)
            ->where('curso_ano_academico_cadeira_id', '=', $cadeira->id)->first();

        if (empty($estudante_classificacao)) {

            $row = Classificacoe::create([
                'estudante_id' => $estudante,
                'curso_ano_academico_cadeira_id' => $cadeira->id,
                'professor_id' => $professor,
                'turma_id' => $turma_id
            ]);
            Nota::create([
                'classificacoe_id' => $row->id,
                'tipo_avaliacao' => $tipo_avaliacao,
                'nota' => $valor
            ]);
        } else {
            $notas = Nota::where('classificacoe_id', $estudante_classificacao->id)->get();
            $media = 0;
            foreach ($notas as $nota) {
                if ($nota->tipo_avaliacao == $tipo_avaliacao) {
                    $msg += ['aviso' => 'Este estudante ja possui: ' . Exame::getKeys()[$tipo_avaliacao]];
                    break;
                    # return $this->pautaTurma($request->turma_id, $request->cadeira_id, $estudante, $msg);
                } elseif (!($nota->nota == null)) {
                    $media += $nota->nota;
                }
            }
            if ((round($media / 3) >= 14)) {
                $msg += ['aviso' => 'Estudante já não pode ser avaliado'];

                #return $this->pautaTurma($request->turma_id, $request->cadeira_id, $estudante, $msg);

            } else {
                $nota = Nota::create([
                    'classificacoe_id' => $estudante_classificacao->id,
                    'tipo_avaliacao' => $tipo_avaliacao,
                    'nota' => $valor
                ]);
            }
        }
        $msg += ['sucesso' => ' Nota adicionada com sucesso'];
        return $this->pautaTurma($request->turma_id, $request->cadeira_id, null, $estudante, $msg);
        //
    }

    public function pautaTurmaEditar($id)
    {
        $pauta = Classificacoe::find($id);
        if (empty($pauta))
            return $this->pautaTurma($id, $id);

        return $this->pautaTurma($id, $pauta->cursoano_academico_id->cadeira_id, $pauta);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create($id, $pauta = null)
    {
        $professor = ProfessorLecionaTurma::find($id);
        $turma = Turma::find($professor->turma_id);
        $cadeira = Cadeira::find($professor->cadeira_id);
        $estudante = Estudante::where('turma_id', $turma->id)->get();
        $tipo_avalicao = TipoAvaliacao::all();
        $row = [
            'pauta' => $pauta,
            'turmas' => $turma,
            'cadeiras' => $cadeira,
            'estudantes' => $estudante,
            'tipo_avaliacoes' => $tipo_avalicao
        ];

        return view('admin.pauta-form', ['row' => $row]);
    }
 */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cadeira, $turma = null, $curso = null )
    {
        //640-937-838-3
        $c = Cadeira::find($cadeira);
        $cadeira = CursoAnoAcademicoCadeira::where('cadeira_id', $c->id)->first();
        $rows = Classificacoe::where('curso_ano_academico_cadeira_id', $cadeira->id)->orderBy('estudante_id')->paginate(5);
        $pauta = [];
        if (empty($rows[0])) {
            return view('info', ['msg' => "Pauta nao disponivel!..."]);
        }

        $cabecalho = [
            'cadeira_id' => $cadeira->cadeira_id,
            'curso_id' => $cadeira->curso_id,
            'curso' => $cadeira->curso->nome,
            'turma_id' => $rows[0]->turma_id,
            'cadeira' => $cadeira->cadeira->nome,
            'ano_academico' => $cadeira->ano_academico,
            'semestre' => $cadeira->semestre,
            'ano_lectivo' => $rows[0]->ano_lectivo

        ];
        foreach ($rows as $row) {
            $pauta1 = new Pauta($row->id, $row->estudante, $row->nota);
            array_push($pauta, $pauta1);
        }

        return view('professor.cadeira-pauta', ['cabecalho' => $cabecalho, 'rows' => $pauta, 'cadeira' => $cadeira, 'turma' => $turma]);
    }

    /**
     * 
     * 
     */

    public function showPautaEstudante($cadeira)
    {
        return $this->show($cadeira);
        #return view('professor.cadeira-pauta', ['rows' => $row]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //pauta/{turma_id}/{cadeira_id}/{pauta/}edit
    public function edit($turma_id, $cadeira_id, $pauta)
    {
        $pauta = Classificacoe::find($pauta);

        if (empty($pauta)) {
            return $this->pautaTurma($turma_id, $cadeira_id);
        }

        return $this->pautaTurma($turma_id, $cadeira_id, $pauta);
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
        # $pauta = Classificacoe:
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #$classificacao = Classificacoe::find($id);
        Classificacoe::destroy($id);
        return redirect()->back()->withInput(['del' => 'Pauta eliminada com sucesso!...']);
    }
}
