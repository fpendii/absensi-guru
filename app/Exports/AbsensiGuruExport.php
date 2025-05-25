<?php

namespace App\Exports;

use App\Models\AbsensiGuruModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiGuruExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return AbsensiGuruModel::where('id_guru', 2) // Ganti sesuai kebutuhan
            ->select('tanggal', 'waktu_masuk', 'status', 'keterangan')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Waktu Masuk',
            'Status',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style header
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4CAF50'], // Hijau header
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Style seluruh tabel (dari A1 sampai kolom terakhir dan baris terakhir)
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:D$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20, // Tanggal
            'B' => 20, // Waktu Masuk
            'C' => 15, // Status
            'D' => 30, // Keterangan
        ];
    }
}


