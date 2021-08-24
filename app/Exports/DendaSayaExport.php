<?php

namespace App\Exports;

use App\Models\PengembalianModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class DendaSayaExport implements FromView, WithEvents, ShouldAutoSize
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('anggota.export-denda-saya', [
            'denda' => PengembalianModel::getDendaAnggota($this->id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellrange = 'A1:F1';
                $event->sheet->getDelegate()->getStyle($cellrange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
