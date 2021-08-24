<?php

namespace App\Exports;

use App\Models\PengembalianModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DetailDataDendaExport implements FromView, WithEvents, ShouldAutoSize
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('admin.export-detail-data-denda', [
            'denda' => PengembalianModel::getDetailDendaPetugas($this->id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
