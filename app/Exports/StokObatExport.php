<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\LaporanStok;

class StokObatExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        return LaporanStok::query()
            ->orderBy('nama_obat', 'asc')
            ->get([
                'nama_obat',
                'dosis',
                'bentuk_sediaan',
                'stok_gudang',
                'stok_apotek',
                'stok_masuk_gudang',
                'stok_masuk_apotek',
                'stok_keluar_gudang',
                'stok_keluar_apotek'
            ]);
    }

    public function headings(): array
    {
        return [
            'Nama Obat',
            'Dosis',
            'Sediaan',
            'Stok Gudang',
            'Stok Apotek',
            'Stok masuk gudang',
            'Stok masuk apotek',
            'Stok keluar gudang',
            'Stok keluar apotek',

        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
