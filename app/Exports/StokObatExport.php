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
                'harga_satuan',
                'stok_gudang',
                'stok_loker',
                'jumlah',
                'harga'
            ]);
    }

    public function headings(): array
    {
        return [
            'Nama Obat',
            'Harga satuan',
            'stok gudang',
            'stok loker',
            'jumlah',
            'harga',
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
