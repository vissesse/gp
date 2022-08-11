<?php

namespace App\factory;


interface IUseCases
{
    public function estudante();
    public function professor();
    public function cadeira();
    public function turma();
    public function curso();
    public function classificacoes();

}
