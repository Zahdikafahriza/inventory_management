<?php

namespace App\Services;

use App\Models\Barang;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BarangExport
{
    /**
     * Kolom yang diekspor — mengikuti kolom tabel Master Barang.
     * Key = kolom di model, value = header di Excel.
     */
    protected array $columns = [
        'kode_aset'     => 'Kode Aset',
        'nama_aset'     => 'Nama Aset',
        'kategori'      => 'Kategori',
        'sub_kategori'  => 'Sub Kategori',
        'merk'          => 'Merk',
        'tipe_spek'     => 'Tipe/Spek',
        'serial_number' => 'Serial Number',
        'mac_address'   => 'Mac Address',
        'satuan'        => 'Satuan',
        'kondisi'       => 'Kondisi',
        'lokasi'        => 'Lokasi',
        'stok'          => 'Stok',
        'status'        => 'Status',
        'pic'           => 'PIC',
        'keterangan'    => 'Keterangan',
    ];

    /**
     * Bangun file XLSX dan kirim sebagai streamed download.
     * Menghormati filter pencarian yang sedang aktif (opsional).
     */
    public function download(?string $search = null, ?string $stokFilter = null): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Master Barang');

        // Header
        $col = 1;
        foreach ($this->columns as $header) {
            $sheet->setCellValue([$col, 1], $header);
            $col++;
        }

        // Style header
        $lastColLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($this->columns));
        $headerRange = "A1:{$lastColLetter}1";
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('4F46E5');
        $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(22);

        // Data — query dengan filter yang sama seperti halaman index (kalau ada).
        $query = Barang::query()->orderBy('kode_aset');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_aset', 'like', "%{$search}%")
                    ->orWhere('nama_aset', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('pic', 'like', "%{$search}%");
            });
        }
        if ($stokFilter) {
            $query->stokStatus($stokFilter);
        }

        $row = 2;
        // chunk agar hemat memori untuk data besar
        $query->chunk(500, function ($barangs) use (&$row, $sheet) {
            foreach ($barangs as $barang) {
                $col = 1;
                foreach (array_keys($this->columns) as $key) {
                    $value = $barang->{$key};
                    // stok sebagai angka, sisanya string
                    $sheet->setCellValue([$col, $row], $key === 'stok' ? (int) $value : (string) ($value ?? ''));
                    $col++;
                }
                $row++;
            }
        });

        // Border seluruh tabel + auto width
        $lastRow = max($row - 1, 1);
        $sheet->getStyle("A1:{$lastColLetter}{$lastRow}")
            ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)
            ->getColor()->setRGB('E2E8F0');

        foreach (range(1, count($this->columns)) as $i) {
            $letter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
            $sheet->getColumnDimension($letter)->setAutoSize(true);
        }

        $sheet->freezePane('A2');

        $filename = 'master-barang-' . now()->format('Ymd-His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
