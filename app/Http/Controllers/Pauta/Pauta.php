<?php

namespace App\Http\Controllers\Pauta;

class Pauta
{
    private $id;
    private $estudante;
    private $notas = [];

    /** 
     * Id,
     * $estudante objecto estudante, array de nota
     */
    public function __construct($id, $estudante, $nota)
    {
        $this->id = $id;
        $this->estudante = $estudante;
        foreach ($nota as $nota) {
            if ($nota->tipo_avaliacao == 0) {
                $this->notas += ['AC' => $nota->nota];
            }
            if ($nota->tipo_avaliacao == 1) {
                $this->notas += ['P1' => $nota->nota];
            }
            if ($nota->tipo_avaliacao == 2) {
                $this->notas += ['P2' => $nota->nota];
            }
            if ($nota->tipo_avaliacao == 3) {
                $this->notas += ['EX' => $nota->nota];
            }
            if ($nota->tipo_avaliacao == 4) {
                $this->notas += ['REC' => $nota->nota];
            }
            if ($nota->tipo_avaliacao == 5) {
                $this->notas += ['EXE' => $nota->nota];
            }
        }
    }


    public function idPauta()
    {
        return $this->id;
    }


    public function estudanteNome()
    {
        return $this->estudante->nome;
    }

    public function estudanteProcesso()
    {
        return $this->estudante->processo;
    }

    public function getP1()
    {
        if (!empty($this->notas['P1']))
            return $this->notas['P1'];
        return '-';
    }

    public function getP2()
    {
        if (!empty($this->notas['P2']))
            return $this->notas['P2'];
        return '-';
    }

    public function getAC()
    {
        if (!empty($this->notas['AC']))
            return $this->notas['AC'];
        return '-';
    }


    public function getMedia()
    {
        if (!empty($this->notas['AC']) and !empty($this->notas['P1']) and !empty($this->notas['P2'])) {
            return round(($this->notas['AC'] + $this->notas['P1'] + $this->notas['P2']) / 3);
        }

        return '';
    }
    public function getExame()
    {
        if (!empty($this->notas['EX']))
            return $this->notas['EX'];
        return '-';
    }

    public function getRecurso()
    {
        if (!empty($this->notas['REC']))
            return $this->notas['REC'];
        return '-';
    }

    public function getEXE()
    {
        if (!empty($this->notas['EXE']))
            return $this->notas['EXE'];
        return '-';
    }

    public function resultado()
    {
        if ($this->getMedia() >= 14) {
            return $this->getMedia();
        } elseif (!empty($this->getMedia()) and  (is_numeric($this->getExame()) and $this->getExame() >= 10)) {
            return round(0.4 * $this->getMedia() + 0.6 * $this->getExame());
        } elseif (!empty($this->getMedia()) and  (is_numeric($this->getExame()) and $this->getExame() < 10)) {
            return round(0.4 * $this->getMedia() + 0.6 * $this->getExame());
        } elseif ($this->getEXE() >= 10 or $this->getRecurso() >= 10) {
            return $this->getEXE() > $this->getRecurso() ? $this->getEXE() : $this->getRecurso();
        }
        return "-";
    }

    public function getObs()
    {
        if ($this->getMedia() >= 14) {
            return "DISPENSADO";
        } elseif ($this->resultado() >= 10) {
            return "APROVADO";
        } elseif (($this->getMedia() >= 6.5) and ($this->getMedia() < 14) and !is_numeric($this->getExame())) {
            return "PENDENTE";
        }

        return 'REPROVADO';
    }
}
