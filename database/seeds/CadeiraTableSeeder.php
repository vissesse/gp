<?php

use Illuminate\Database\Seeder;

class CadeiraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        #factory(App\Model\CursoAnoAcademicoCadeira::class, 2)->create();
        #factory(App\Model\Turma::class, 5)->create();
        #factory(App\Model\TipoAvaliacao::class, 4)->create();
        
        #factory(App\Model\Professor::class, 20)->create();
        #factory(App\Model\ProfessorLecionaTurma::class, 1)->create();
        #factory(App\User::class, 50)->create();
       #factory(App\Model\Estudante::class, 50)->create();
       
                   


       # factory(App\Model\Cadeira::class, 1)
       #     ->create()
       #     ->each(function ($Cadeira) {
       #         $Cadeira
       #             ->professore()
       #             ->save(factory(App\Model\ProfessorLecionaTurma::class)
       #                 ->make());
       #     });
    }
}
