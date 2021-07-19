<?php

namespace App\Exports;

use App\Models\AnggotaModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class AnggotaExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function view(): View
    {
        return view('admin.export-anggota', [
            'anggota'  => AnggotaModel::all()
        ]);
    }
}
