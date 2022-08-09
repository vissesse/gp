<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadeiraRequest;
use Illuminate\Http\Request;
use App\Model\Curso;
use App\Model\Cadeira;
use App\Model\CursoAnoAcademicoCadeira;

class CadeiraController extends Controller
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
        // 
        $cursos = Curso::orderBy('nome')->paginate(5);
        if (empty($cursos)) {
            return redirect()->route('cadeira_create');
        }


        return view('admin.cadeira-index', ['cursos' => $cursos]);
    }

    public function cadeirasList($curso)
    {
        $cadeira = CursoAnoAcademicoCadeira::where('curso_id', '=', $curso)
            ->orderBy('ano_academico','asc')
            ->orderBy('semestre', 'asc')
            ->paginate(5);


        if (empty($cadeira)) {
            return redirect()->route('cadeira_create');
        }
        return view('admin.cadeira', ['cadeira' => $cadeira]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cadeira = Null)
    {
        $cursos = Curso::all();
        $row = [
            'cadeira' => $cadeira,
            'cursos' => $cursos
        ];
        if (empty($cursos)) {
            return redirect()->route('curso_create');
        }
        return view('admin.cadeira-form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadeiraRequest $request)
    {
        $cadeira = $request->nome;
        $curso = $request->curso_id;
        $ano_academico = $request->ano_academico;
        $semestre = $request->semestre;
        $curso = Curso::find($curso);
        if (empty($curso))
            return redirect()->route('curso_create');
        $cadeira = Cadeira::create(['nome' => $cadeira]);

        try {
            //code...
            $curso_cadeira_ano_academico = CursoAnoAcademicoCadeira::create(
                [
                    'curso_id' => $curso->id,
                    'cadeira_id' => $cadeira->id,
                    'ano_academico' => $ano_academico,
                    'semestre' => $semestre
                ]
            );
            echo ($curso_cadeira_ano_academico);
        } catch (\Throwable $th) {
            echo 'cadeira:' . $cadeira . 'semestre:' . $semestre . 'ano academico:' . $ano_academico;

            return;
        }
        return redirect()->route('cadeiras', $curso->id)->withInput(['add' => 'Cadeira adiconada com sucesso!...']);
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
        $cadeira = CursoAnoAcademicoCadeira::find($id);
        if (empty($cadeira)) {
            return $this->create();
        }
        return $this->create($cadeira);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CadeiraRequest $request, $id)
    {
        $cadeira = Cadeira::find($request->cadeira_id);
        if (empty($cadeira)) {
            return redirect()->route('cadeira_create');
            # code...
        }
        $curso_id = $request->curso_id;
        $cadeira->update(['nome' => $request->nome]);
        $cadeira = CursoAnoAcademicoCadeira::find($id)->update(
            [
                'curso_id' => $curso_id,
                'cadeira_id' => $cadeira->id,
                'ano_academico' => $request->ano_academico,
                'semestre' => $request->semestre
            ]
        );
        return redirect()->route('cadeiras', $curso_id)->withInput(['add' => 'Cadeira actualizado com sucesso!..']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cadeira::destroy($id);
        return redirect()->back()->withInput(['del' => 'Cadeira deletada com sucesso!..']);
    }
}
