<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cliente;
use App\Exports\ClienteExport;
use App\Models\clientes;
use GrahamCampbell\ResultType\Success;

use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    //

    public function index()
    {

        $cliente = clientes::all();  // Lista todos os clientes

        $array_clientes = array(

            'clientes' => $cliente

        ); // Um array de clientes

        return view('home', $array_clientes); // retorna uma views e passa nela todos os clientes

        //dd($cliente);

    }

    public function export(){
        return Excel::download(new ClienteExport, 'cliente.xlsx');
    }

    public function novo()
    {

        return view('novo');
    }

    public function adicionar(Request $request)
    {

        //dd($request->all());
        $cliente = new clientes();
        // Request rece uma requisção do formulário, os dados do fromulário 
        $cliente->nome = $request->nome_form;
        $cliente->email = $request->email_form;
        $cliente->telefone = $request->telefone_form;

        $cliente->save();

        return back() ->with('succes', 'Cliente Salvo com sucesso!');
    }

    public function editar($id)
    {

        $cliente = clientes::find($id);

        return view('editar', $cliente);
    }




    public function update(Request $request)
    {

        $cliente = clientes::find($request->id_form);
        $cliente->nome = $request->nome_form;
        $cliente->email = $request->email_form;
        $cliente->telefone = $request->telefone_form;

        $cliente->save();

        return redirect('/');
    }

    public function excluir($id)
    {
        $cliente = new clientes();
        $cliente = clientes::find($id);

         $cliente->delete();
        return redirect('/');


    }
}
