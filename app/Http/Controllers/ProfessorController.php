<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfessorRequest;
use App\Models\Cadeira;
use App\Models\Professor;
use App\Models\ProfessorLecionaTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        #$this->middleware('admin');
    }


    public function professorTurmas()
    {
        $id = Auth::user()->id;
        $professor = Professor::where('user_id', $id)->first();
        $lecionaTurmaCadeira = ProfessorLecionaTurma::where('professor_id', $professor->id)->paginate(5);
        return view('professor.turmas', ['rows' => $lecionaTurmaCadeira]);
    }

    public function index()
    {
        $professor = Professor::orderBy('nome', 'asc')->paginate(5);
        if (empty($professor)) {
            return redirect()->route('professor_create');
        }
        return view('professor.professor', ['professores' => $professor]);
        #return view('teste', ['rows'=>$professor]);
        #return $professor;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($professor = Null)
    {
        $turma = Turma::all();
        $cadeira = Cadeira::all();
        $row = [
            'professor' => $professor,
            'cadeiras' => $cadeira,
            'turmas' => $turma
        ];
        if (empty($turma)) {
            return redirect()->route('turma_create');
        } elseif (empty($cadeira)) {
            return redirect()->route('cadeira_create');
        }

        return view('professor.professor-form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorRequest $request)
    {
        $professor = $request->nome;
        //$cadeiras = $request->cadeira;
        $especialidade = $request->especialidade;
        $contacto = $request->contacto;
        $email = $request->email;
       // $turmas = $request->all()['turma'];

        #$id_cadeira = Cadeira::find($cadeira);
    

        $user = User::create([
            'nome' => $professor,
            'password' => bcrypt($professor),
            'email' => $email,
            'categoria' => 'Professor',

        ]);
        $professor = Professor::create([
            'nome' => $professor,
            'contacto' => $contacto,
            'user_id' => $user->id,
            'email' => $email,
            'especialidade' => $especialidade
        ]);

       /* 
       foreach ($turmas as $turma) {
            # code...
            $professor_leciona = ProfessorLecionaTurma::create([
                'professor_id' => $professor->id,
                'turma_id' => $turma, 
                'cadeira_id'=>1
            ]);
        }
        //
*/
       
        return redirect()->route('professores')->withInput(['add' => 'Professor adicionado com sucesso!...']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $professor = ProfessorLecionaTurma::find($id);
        if (empty($professor)) {
            return $this->create();
        }
        return $this->create($professor);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessorRequest $request, $id)
    {
        $turma = Turma::find($request->turma);
        $cadeira = Cadeira::find($request->cadeira_id);

        $professor = Professor::find($request->professor_id);
        $professor->update([
            'nome' => $request->nome,
            'contacto' => $request->contacto,
            'email' => $request->email,
            'especialidade' => $request->especialidade
        ]);

        $user = User::find($professor->user_id);
        $user->update([
            'nome' => $professor->nome,
            'password' => bcrypt($professor->nome),
            'email' => $professor->email,

        ]);
        $professor_leciona = ProfessorLecionaTurma::find($id)->update(
            [
                'turma_id' => $turma->id,
                'cadeira_id' => $cadeira->id,
                'professor_id' => $professor->id
            ]
        );
        return redirect()->route('professores')->withInput(['add' => 'professor actualizado com sucesso!...']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professor = Professor::find($id);
        $usuario = User::find($professor->user_id);
        User::destroy($usuario->id);
        ProfessorLecionaTurma::destroy($id);

        return redirect()->back()->withInput(['del' => 'Professor elinando com sucesso!..']);
    }
}
