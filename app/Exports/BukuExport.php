<?php

namespace App\Exports;

use App\Models\Buku_model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class BukuExport implements FromView, WithHeadings, ShouldAutoSize, WithEvents
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

    public function headings(): array
    {
        return [
            '#',
            'Kode',
            'Judul',
            'Pengarang',
            'Penerbit',
            'Tahun Terbit',
            'Bahasa', 
            'Genre',
            'Jumlah Halaman',
            'Stok'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function(AfterSheet $event) {
                $cellRange = 'A1:J1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
                    // ->getFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
            }
        ];
    }
}
