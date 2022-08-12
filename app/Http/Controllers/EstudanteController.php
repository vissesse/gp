<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudanteRequest; 
use App\Models\Curso;
use App\Models\CursoAnoAcademicoCadeira;
use App\Models\Estudante;
use App\Models\Turma;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\QueryException;
use App\factory\Factory;
class EstudanteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['showCadeiras']]);
    }
    public function index()
    {
        $estudante = Estudante::orderBY('nome')->paginate(5);

        return view('estudante.estudante', ['estudantes' => $estudante]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($estudante = Null)
    {
        $factory = new Factory();

        $turmas = $factory->turma()->all();#Turma::orderBy('ano_academico')->get();
        $row = [
            'turmas' => $turmas,
            'estudantes' => $estudante
        ];
        if (empty($turmas)) {
            return redirect()->route('turma_create');
        }
        return view('estudante.estudante-form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudanteRequest $request)
    {
        $estudante = $request->nome;
        $processo = $request->processo;
        $turma = $request->turma_id;

        $turma = Turma::find($turma);
        if (empty($turma))
            return redirect()->route('turma_create');
        try {

            $usuario = User::create([
                'nome' => $estudante,
                'email' => random_int(1, 100),
                'password' => bcrypt($processo)
            ]);

            $estudante = Estudante::create(
                [
                    'turma_id' => $turma->id,
                    'user_id' => $usuario->id,
                    'nome' => $estudante,
                    'processo' => $processo
                ]
            );
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // houston, we have a duplicate entry problem
                return redirect()->back()->withInput(['error'=>'Ja existe um estudante com este numero de processo '.$processo]);
            }
        }


        return redirect()->route('estudantes')->withInput(['add' => 'Estudante criado com sucesso!...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCadeiras()
    {
        $estudante = Estudante::where('user_id', Auth::user()->id)->first();
        $turma = Turma::where('id', $estudante->turma_id)->get()->first();
        $curso = Curso::where('id', $turma->curso_id)->first();
        $cadeiras = CursoAnoAcademicoCadeira::where('curso_id', $curso->id)->paginate(5);

        return view('estudante.cadeiras', ['rows' => $cadeiras]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudante = Estudante::find($id);
        if (empty($estudante)) {
            return $this->create();
        }
        return $this->create($estudante);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstudanteRequest $request, $id)
    {
        $turma = Turma::find($request->turma_id);
        if (empty($turma)) {
            return redirect()->route('turma_create');
        }
        $estudante = Estudante::find($id);
        $user = User::find($estudante->user_id)->update(
            [
                'nome' => $request->nome,
                'password' => bcrypt($request->processo)
            ]
        );

        $estudante->update(
            [
                'nome' => $request->nome,
                'processo' => $request->processo,
                'turma_id' => $turma->id

            ]
        );


        return redirect()->route('estudantes')->withInput(['add' => 'Estudante actualizado com sucesso!...']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudante = Estudante::find($id);
        $user = User::find($estudante->user_id);
        USer::destroy($user->id);
        Estudante::destroy($id);
        return redirect()->back()->withInput(['del' => 'Estudante eliminado com sucesso!..']);
    }
}
