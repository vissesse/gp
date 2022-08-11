<?php

namespace App\Exports;

use App\Models\RelatorioModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class RelatorioExport implements FromCollection
{
    public function collection()
    {
        return RelatorioModel::all();
    }
}
