<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;


use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export()
    {
        // return (new InvoicesExport)->download('invoices.pdf',  Excel::MPDF);
       return Excel::download(new UsersExport, 'users-teste..xlsm');
    }

    public function perfil($id)
    {
        $usr = $this->User::find($id);

        return view('user.perfil')->with('usuario', $usr);
    }

    public function usuario()
    {
        return view('user.index');
    }

    public function formNovoUsuario()
    {
        // code...
        return view('user.registar');
    }

    public function criarUsuario(UserRequest $request)
    {
        // code...
        $msg = [];
        $senha = $request->password;
        $confirmar_senha = $request->confirmar_senha;

        if (!($senha == $confirmar_senha)) {
            $msg = ['tipo_msg' => 'senha', 'msg' => 'Senha não combina!'];
        } else {
            try {
                User::create([
                    'nome' => $request->nome, # 'sobrenome' => $request->sobrenome,
                    'email' => $request->email, 'password' => bcrypt($senha),
                ]);

                $msg = ['tipo_msg' => 'criado', 'msg' => 'Usuario criado com sucesso!'];

                return redirect()->route('usuarios', ['msg' => $msg]);
            } catch (Exception $e) {
                $msg = ['tipo_msg' => 'email', 'msg' => 'Já existe esse email!'];
            }
        }

        return redirect()->route('usuario')->withInput(['add' => 'Usuario Criado com sucesso']);
    }

    public function listagemUsuario()
    {
        // code...
        $usuarios = User::paginate(5);

        return view('user.listagem')->with('usuarios', $usuarios);
    }

    public function formEditarUsuario($id)
    {
        $usuario = User::find($id);

        return view('user.registar')->with('usuario', $usuario);
    }

    /**
     * @param request  \App\Http\UserRequest  
     * @param id identificador do usuario
     * @return \Illuminate\Http\Response 
     */
    public function actualizarUsuario(UserRequest $request, $id)
    {
        $msg = 'Erro inexperado!';
        $route = '';
        $nome = $request->nome;
        $email = $request->email;
        $senha = $request->password;
        $confirmar_senha = $request->password_confirm;

        $usuario = User::findOrFail($id);

        if ($senha == $confirmar_senha) {
            $usuario->update([
                'nome' => $nome,
                'email' => $email,
                'password' => bcrypt($senha),
            ]);
            $msg = "Usuario Actualizado com sucesso";
            $route = "usuarios";
        } else {
            $msg = "Upss!... A senha não combina";
            $route = "actualizar_usuario_form";
        }

        return redirect()->route($route, ['msg' => $msg])->withInput(['add' => 'Usuario actualizado com sucesso!..']);
    }



    public function deletarForm($id)
    {
        // code...
        $user = User::findOrFail($id);

        return view('user.deletar')->with('usuario', $user);
    }

    public function deletar($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('usuarios')->withInput(['del' => 'Usuario deletado som sucesso!..']);
    }
}
