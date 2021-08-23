<?php

namespace App\Exports;

use App\Models\Buku_model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class bukuDitambahkanExport implements FromView, WithHeadings, WithEvents, ShouldAutoSize
{
    public function view(): View
    {
        $id = Auth::user()->id;
        return view('petugas.export-buku-ditambahkan-petugas', [
            'buku'  => Buku_model::where('created_by', $id)->get()
        ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode',
            'Judul',
            'Pengarang',
            'Stok',
            'Created at'
        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class   => function(AfterSheet $event) {
                $cellRange = 'A1:F1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
