<?php

namespace App\Exports;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HarusDikembalikanExport implements FromView, WithHeadings, WithEvents, ShouldAutoSize
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('anggota.export-harus-dikembalikan', [
            'harusDikembalikan' => PeminjamanModel::getHarusDikembalikanAnggota($this->id)
        ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Peminjaman',
            'Judul',
            'Qty',
            'Harus Kembali',
            'Terlambat'
        ];
    }

    public function
}
