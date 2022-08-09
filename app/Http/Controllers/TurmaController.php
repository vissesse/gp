<?php

namespace App\Http\Controllers;

use App\Http\Requests\TurmaRequest;
use Illuminate\Http\Request;
use App\Model\Turma;
use App\Model\Curso;
use phpDocumentor\Reflection\Types\True_;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $turma = Turma::paginate(5);

        return view('admin.turmas', ['rows' => $turma]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($turma = null)
    {
        $cursos =  Curso::all();
        $row = [
            'turma' => $turma,
            'cursos' => $cursos
        ];
        if (empty($cursos)) {
            return redirect()->route('curso_create');
        }
        return view('admin.turma-form', ['row' => $row]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaRequest $request)
    {
        $turma = $request->all();
        $turma = Turma::create($turma);

        return  redirect()->route('turmas')->withInput(['add'=>'Turma adicionada com sucesso!..']);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $turma = Turma::find($id);
        return $this->create($turma);
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
        $turma = Turma::find($id);
        if (empty($turma)) {
            return $this->create();
        }
        $turma->update($request->all());

        return redirect()->route('turmas')->withInput(['add'=>'Turma actualozada com sucesso!..']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $turma = Turma::find($id);
        Turma::destroy($id);
        return redirect()->route('turmas')->withInput(['del'=>'Turma deletada com sucesso!...']);
    }
}
