<?php

namespace App\Exports;

use App\Models\AnggotaModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;

class AnggotaDitambahkanExport implements FromView, WithEvents, ShouldAutoSize
{
    private $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('petugas.export-anggota-ditambahkan-petugas', [
            'anggota'   => AnggotaModel::getAnggotaPetugas($this->id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellRange = 'A1:D1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
