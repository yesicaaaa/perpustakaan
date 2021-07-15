<?php

namespace App\Exports;

use App\Models\Buku_model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class BukuExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View 
    {
        return view('admin.export-buku', [
            'buku'  => Buku_model::all()
        ]);
    }
}
