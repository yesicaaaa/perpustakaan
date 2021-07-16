<?php

namespace App\Exports;

use App\Models\PetugasModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PetugasExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function view(): View
    {
        return view('admin.export-petugas', [
            'petugas'  => PetugasModel::all()
        ]);
    }
}
