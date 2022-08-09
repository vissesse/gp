<?php

namespace App\Http\Controllers;

use App\Http\Requests\ControleLancamentoRequest;
use App\Models\Curso;
use App\Models\TipoAvaliacao;
use Illuminates\Http\Request;
use App\Models\ControleLancamento;

class ControleLancacemnto extends Controller
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
        $cursos = Curso::orderBy('nome')->paginate(5);
        if (empty($cursos)) {
            return redirect()->route('cadeira_create');
        }

        
        return view('admin.pautas.index', ['cursos' => $cursos]);
    }

    public function atribuir(){ 
        
        $controle_lancamento = ControleLancamento::all();
        return view('admin.controle-lancamento')->with('rows', $controle_lancamento);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($controle_lancamento = null)
    {
        $tipo_avalicao = TipoAvaliacao::all();

        $row = [
            'controle_lancamento' => $controle_lancamento,
            'tipo_avaliacao' => $tipo_avalicao
        ];

        if (empty($tipo_avalicao)) {
            return redirect()->route('tipo_avaliacao_create');
        }

        return view('admin.controle-lancamento-form', ['row' => $row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ControleLancamentoRequest $request)
    {
        $data_inico = $request->data_inicio;
        $data_fim = $request->data_fim;
        $tipo_avaliacao_id = $request->tipo_avaliacao_id;

        $tipo_avaliacao = TipoAvaliacao::find($tipo_avaliacao_id);

        if (empty($tipo_avaliacao)) {
            return redirect()->route('tipo_avaliacao_create');
        }

        $controle_lancamento = ControleLancamento::create([
            'tipo_avaliacao_id' => $tipo_avaliacao->id,
            'data_inicio' => $data_inico,
            'data_fim' => $data_fim
        ]);

        return redirect()->route('controle_lancamento')->with('controle_lancamento', $controle_lancamento);
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
        $controle_lancamento = ControleLancamento::find($id);
        if (empty($controle_lancamento)) {
            return $this->create();
        }

        return $this->create($controle_lancamento);
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
        $tipo_avaliacao = TipoAvaliacao::find($request->tipo_avaliacao_id);

        $controle_lancamento = ControleLancamento::find($id);
        $controle_lancamento->update($request->all());

        return redirect()->route('controle_lancamento')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_SESSION  = ControleLancamento::destroy($id);
        $row = "dados eliminado";

        return redirect()->route('controle_lancamento')->with('info', $row);
    }
}
