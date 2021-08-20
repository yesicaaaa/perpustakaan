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

class DetailPengembalianExport implements FromView, WithHeadings, WithEvents, ShouldAutoSize
{
    private $tgl;
    public function __construct(String $tgl)
    {
        $this->tgl = $tgl;
    }

    public function view(): View
    {
        return view('admin.export-detail-laporan-pengembalian', [
            'detailLaporan' => PengembalianModel::getDetailLaporanPengembalian($this->tgl)
        ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode',
            'Nama',
            'Judul',
            'Jumlah',
            'Perpanjangan',
            'Harus Kembali',
            'Kembali',
            'Terlambat',
            'Denda'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellRange = 'A1:J1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
