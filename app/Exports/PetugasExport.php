<?php

namespace App\Exports;

use App\Models\PetugasModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PetugasExport implements FromView, ShouldAutoSize, WithEvents, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function view(): View
    {
        return view('admin.export-petugas', [
            'petugas'  => PetugasModel::select('users.*', 'roles.display_name')
                                        ->join('role_user', 'role_user.user_id', '=', 'users.id')
                                        ->join('roles', 'roles.id', '=', 'role_user.role_id')
                                        ->where('role_user.role_id' , '!=', 3)
                                        ->get()
        ]);
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Lengkap',
            'Email',
            'No.Telepon',
            'Alamat',
            'Role',
            'Created_at'
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
