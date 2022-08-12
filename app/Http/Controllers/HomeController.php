<?php

namespace App\Http\Controllers;

use App\factory\Factory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $classificacao; 
     private $cursos;
    public function __construct()
    {
        $this->middleware('auth');
        $factorys = new Factory();
        $this->cursos = $factorys->curso();
        $this->classificacao = $factorys->classificacoes();
    }

    public function search(Request $request)
    {
        $row = "";
        return view('admin.search', ['rows' => $row]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $cursos = $this->cursos->all();
        $estatistica = $this->classificacao->clafissicacao();

        return view('index',  ['cursos' => $cursos, 'statistica' => $estatistica]);
    }
}
