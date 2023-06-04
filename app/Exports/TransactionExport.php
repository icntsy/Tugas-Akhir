<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class TransactionExport implements
    FromCollection,
    WithMapping,
    WithHeadings,
    WithStyles,
    ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::all();
    }

    public function map($row): array
    {
        return [

            $row->queue->patient->name,
            Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->isoFormat('D MMMM Y'),
            $row->queue->doctor->name,
            $row->queue->service->name,
            $row->queue->jenis_rawat,
            $row->payment,

        ];
    }

    public function headings(): array
    {
        return [

            'Nama Lengkap',
            'Tanggal Periksa',
            'Dokter / Bidan',
            'Layanan',
            'Jenis Rawat',
            'Jumlah Pembayaran'

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => 'true']]
        ];
    }
}
