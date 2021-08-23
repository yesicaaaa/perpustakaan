<?php

namespace App\Exports;

use App\Models\PeminjamanModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class DetailPeminjamanPetugasExport implements FromView, WithHeadings, WithEvents, ShouldAutoSize
{
    private $id;

    public function __construct(int $id_anggota, int $id_petugas)
    {
        $this->id_anggota = $id_anggota;
        $this->id_petugas = $id_petugas;
    }

    public function view(): View
    {
        return view('petugas.export-detail-peminjaman-petugas', [
            'peminjaman'    => PeminjamanModel::getDetailPeminjamanPetugas($this->id_anggota, $this->id_petugas)
        ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode',
            'Judul',
            'Qty',
            'Peminjaman',
            'Perpanjangan',
            'Harus Kembali'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class   => function (AfterSheet $event) {
                $cellRange = 'A1:G1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
            }
        ];
    }
}
