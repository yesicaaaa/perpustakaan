<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PeminjamanModel;
use Maatwebsite\Excel\Events\AfterSheet;

class DataPengembalianPetugasExport implements FromView, WithEvents, ShouldAutoSize
{
    public function view(): View
    {
        return view('petugas.export-data-pengembalian-petugas', [
            'pengembalian'  => PeminjamanModel::getDataPeminjaman()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $cellRange = 'A1:H1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
