<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PeminjamanModel;
use Maatwebsite\Excel\Events\AfterSheet;

class DetailPeminjamanExport implements FromView, WithEvents, ShouldAutoSize
{
    private $tgl;
    public function __construct(string $tgl)
    {
        $this->tgl = $tgl;
    }

    public function view(): View
    {
        return view('admin.export-detail-laporan-peminjaman', [
            'detailLaporan' => PeminjamanModel::getDetailLaporanPeminjaman($this->tgl)
        ]);
    }   

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellRange = 'A1:H1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
