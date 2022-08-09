<?php

use Illuminate\Support\Facades\Route; 
use App\Models\Classificacoe; 
use App\Http\Controllers\RelatorioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('teste', function(){
    $row =Classificacoe::groupBy('nota', 'id')->get();
    return view('teste', ['rows'=>$row]);
});

Route::get('date', function(){
    $date = date("Y");
    return "<h2>".$date.'</h2>';
});


Route::get('/{cadeira_id}/export', [RelatorioController::class, 'export'])->name('exportar_pauta');

Route::prefix('usuario')->group(function () {
   
    Route::get('/{id}/perfil', ['as' => 'usuario_perfil', 'uses' => 'UserController@perfil',]);

    Route::get('/', ['as' => 'usuario', 'uses' => 'UserController@usuario',]);

    Route::get('/criar', ['as' => 'criar_usuario_form', 'uses' => 'UserController@formNovoUsuario']);

    Route::post('/criar', ['as' => 'usuario_criado', 'uses' => 'UserController@criarUsuario',]);

    Route::get('/lista', ['as' => 'usuarios', 'uses' => 'UserController@listagemUsuario',]);

    route::get('/{id}/actualizar', ['as' => 'actualizar_usuario_form', 'uses' => 'UserController@formEditarUsuario',]);

    Route::put('/{id}/actualizar', ['as' => 'actualizar_usuario', 'uses' => 'UserController@actualizarUsuario',]);

    Route::get('/{id}deletar', ['as' => 'deletar_usuario_form', 'uses' => 'UserController@deletarForm',]);

    Route::post('/{id}/deletar', ['as' => 'deletar_usuario', 'uses' => 'UserController@deletar',]);
});



Route::get('pautas', [App\Http\Controllers\PautaController::class, 'index'])->name('pauta_index');

Route::get("/", [App\Http\Controllers\HomeController::class, "index"])->name('home');
Route::post("procurar", [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::get('auth/login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
Route::post('auth/login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin'])->name('post_login');
Route::get('auth/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');


   //ROUTA DA TURMA 
   
Route::group(['prefix' => 'turma'], function () {
    Route::get('', [App\Http\Controllers\TurmaController::class, 'index'])->name('turmas');
    Route::get('create', [App\Http\Controllers\TurmaController::class, 'create'])->name('turma_create');

    Route::post('store', [App\Http\Controllers\TurmaController::class, 'store'])->name('turma_store');

    Route::get('{id}/editar', [App\Http\Controllers\TurmaController::class, 'edit'])->name('turma_editar');

    Route::put('{id}/update', [App\Http\Controllers\TurmaController::class, 'update'])->name('turma_update');

    Route::delete('{id}/delete', [App\Http\Controllers\TurmaController::class, 'destroy'])->name('turma_deletar');
});

   //ROUTA DA CADEIRA

Route::group(['prefix' => 'cadeira'], function () {
    Route::get('', [App\Http\Controllers\CadeiraController::class, 'index'])->name('cadeiras_index');
    Route::get('curso/{curso}', [App\Http\Controllers\CadeiraController::class, 'cadeirasList'])->name('cadeiras');
    Route::get('create', [App\Http\Controllers\CadeiraController::class, 'create'])->name('cadeira_create');
    Route::post('store', [App\Http\Controllers\CadeiraController::class, 'store'])->name('cadeira_store');

    Route::get('{id}/editar', [App\Http\Controllers\CadeiraController::class, 'edit'])->name('cadeira_editar');
    Route::put('{id}/update', [App\Http\Controllers\CadeiraController::class, 'update'])->name('cadeira_update');

    Route::delete('{id}/delete', [App\Http\Controllers\CadeiraController::class, 'destroy'])->name('cadeira_delete');

    Route::get('{cadeira}/pauta', [App\Http\Controllers\PautaController::class, 'show'])->name('Admin_cadeira_pauta');
    
});



Route::group(['prefix' => 'tipo-avaliacao'], function () {
    Route::get('', [App\Http\Controllers\TipoAvaliacaoController::class, 'index'])->name('tipo_avaliacao');
    Route::get('create', [App\Http\Controllers\TipoAvaliacaoController::class, 'create'])->name('tipo_avaliacao_create');
    Route::post('store', [App\Http\Controllers\TipoAvaliacaoController::class, 'store'])->name('tipo_avaliacao_store');

    Route::get('{id}/editar', [App\Http\Controllers\TipoAvaliacaoController::class, 'edit'])->name('tipo_avaliacao_editar');
    Route::put('{id}/update', [App\Http\Controllers\TipoAvaliacaoController::class, 'update'])->name('tipo_avaliacao_update');

    Route::delete('{id}/delete', [App\Http\Controllers\TipoAvaliacaoController::class, 'destroy'])->name('tipo_avaliacao_delete');
});



Route::group(['prefix' => 'estudante'], function () {
    Route::get('', [App\Http\Controllers\EstudanteController::class, 'index'])->name('estudantes');
    Route::get('create', [App\Http\Controllers\EstudanteController::class, 'create'])->name('estudante_create');
    Route::post('store', [App\Http\Controllers\EstudanteController::class, 'store'])->name('estudante_store');

    Route::get('{id}/editar', [App\Http\Controllers\EstudanteController::class, 'edit'])->name('estudante_editar');
    Route::put('{id}/update', [App\Http\Controllers\EstudanteController::class, 'update'])->name('estudante_update');

    Route::delete('{id}/delete', [App\Http\Controllers\EstudanteController::class, 'destroy'])->name('estudante_delete');

    Route::get('cadeiras', [App\Http\Controllers\EstudanteController::class, 'showCadeiras'])->name('estudante_cadeiras');

    Route::get('{cadeira}/pauta', [App\Http\Controllers\PautaController::class, 'showPautaEstudante'])->name('estudante_pauta');
});

// ROUTA SOBRE O PROFESSOR 

Route::group(['prefix' => 'professor'], function () {
    Route::get('', [App\Http\Controllers\ProfessorController::class, 'index'])->name('professores');
    Route::get('create', [App\Http\Controllers\ProfessorController::class, 'create'])->name('professor_create');
    Route::post('store', [App\Http\Controllers\ProfessorController::class, 'store'])->name('professor_store');

    Route::get('{id}/editar', [App\Http\Controllers\ProfessorController::class, 'edit'])->name('professor_editar');
    Route::put('{id}/update', [App\Http\Controllers\ProfessorController::class, 'update'])->name('professor_update');

    Route::delete('{id}/delete', [App\Http\Controllers\ProfessorController::class, 'destroy'])->name('professor_delete');

    //ROUTA DAS PAUTAS

    Route::delete('pauta/{id}/delete', [App\Http\Controllers\PautaController::class, 'destroy'])->name('pauta_delete');
    Route::get('cadeira/{cadeira}/turma/{turma}/pauta/{curso}', [App\Http\Controllers\PautaController::class, 'show'])->name('pauta');
    Route::post('pauta/turma/cadeira/store', [App\Http\Controllers\PautaController::class, 'pautaTurmaStore'])->name('pauta_store');
    
   # Route::get('cadeira/{pauta}/pauta/editar', [App\Http\Controllers\PautaController::class, 'edit'])->name('pauta');

    Route::get('turmas', [App\Http\Controllers\ProfessorController::class, 'professorTurmas'])->name('professor_turmas');
    Route::get('pauta/{turma_id}/turma/{cadeira_id}/cadeira/{curso}/curso', [App\Http\Controllers\PautaController::class, 'pautaTurma'])->name('pauta_turma');
    //routar editar
    Route::get('pauta/{turma_id}/{cadeira_id}/{pauta}/editar', [App\Http\Controllers\PautaController::class, 'edit'])->name('pauta_edit');
});

//ROUTA De LANÇAMENTO

Route::group(['prefix' => 'controle-lancamento'], function () {
    Route::get('', [App\Http\Controllers\ControleLancacemnto::class, 'index'])->name('controle_lancamento_pauta');
    Route::get('atribuir', [App\Http\Controllers\ControleLancacemnto::class, 'atribuir'])->name('controle_lancamento');
    Route::get('create', [App\Http\Controllers\ControleLancacemnto::class, 'create'])->name('controle_lancamento_create');
    Route::post('store', [App\Http\Controllers\ControleLancacemnto::class, 'store'])->name('controle_lancamento_store');

    Route::get('{id}/editar', [App\Http\Controllers\ControleLancacemnto::class, 'edit'])->name('controle_lancamento_editar');
    Route::put('{id}/update', [App\Http\Controllers\ControleLancacemnto::class, 'update'])->name('controle_lancamento_update');

    Route::delete('{id}/delete', [App\Http\Controllers\ControleLancacemnto::class, 'destroy'])->name('controle_lancamento_delete');
});

//ROUTA DO CURSO

Route::group(['prefix' => 'curso'], function () {

    Route::get('', [App\Http\Controllers\CursoController::class, 'index'])->name('cursos');

    Route::get('create', function () {
        return view('admin.curso-form');
    })->name('curso_create');

    Route::post('store', [App\Http\Controllers\CursoController::class, 'store'])->name('curso_store');

    Route::get('{id}/editar', [App\Http\Controllers\CursoController::class, 'edit'])->name('curso_editar');

    Route::put('{id}/update', [App\Http\Controllers\CursoController::class, 'update'])->name('curso_update');

    Route::delete('{id}/delete', [App\Http\Controllers\CursoController::class, 'destroy'])->name('curso_delete');

    
});
