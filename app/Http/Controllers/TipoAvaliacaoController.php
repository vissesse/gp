<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\TipoAvaliacao;
use Illuminate\Http\Request;

class TipoAvaliacaoController extends Controller
{
    //

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

        $tipo_avalicao = TipoAvaliacao::paginate(5);
        if (empty($tipo_avalicao)) {
            return redirect()->route('tipo_avaliacao_create');
        }
        return view('admin.tipo-avaliacao', ['tipo_avalicao' => $tipo_avalicao]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tipo_avalicao = Null)
    {
        $cursos = Curso::all();
        $row = [
            'tipo_avaliacao' => $tipo_avalicao,
            'cursos' => $cursos,
        ];

        if (empty($cursos)) {
            return redirect()->route('curso_create');
        }
        return view('admin.tipo-avaliacao-form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome_avaliacao = $request->nome;
        $curso = $request->curso_id;
        $curso = Curso::find($curso);
        if (empty($curso))
            return redirect()->route('curso_create');

        $tipo_avaliacao = TipoAvaliacao::create(
            [
                'curso_id' => $curso->id,
                'nome' => $nome_avaliacao
            ]
        );

        return redirect()
            ->route('tipo_avaliacao')
            ->with('avalicao', $tipo_avaliacao);
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
        $avaliacao = TipoAvaliacao::find($id);
        if (empty($avaliacao)) {
            return $this->create();
        }
        return $this->create($avaliacao);
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
        $curso = Curso::find($request->curso_id);
        if (empty($curso)) {
            return redirect()->route('curso_create');
        }
        $tipo_avalicao = TipoAvaliacao::find($id)->update(
            [
                'curso_id' => $curso->id,
                'nome' => $request->nome
            ]
        );
        return redirect()->route('tipo_avaliacao')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipoAvaliacao::destroy($id);
        return redirect()->route('tipo_avaliacao');
    }
}
