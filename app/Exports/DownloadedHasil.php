<?php

namespace App\Exports;

use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DownloadedHasil implements ShouldAutoSize, WithEvents
{
    use Exportable;

    private $data;
    private $list;

    public function __construct(array $data = [])
    {
        $this->data = $data;

        $kode = $this->data['kode'];
        $customer = $this->data['customer'];
        $aplikasi = $this->data['aplikasi'];
        $status2 = $this->data['status2'];
        $tgl_start = $this->data['tgl_start'];
        $tgl_end = $this->data['tgl_end'];

        // $list = DB::table('bursa_transfer')
        //     ->select('id', 'transfer_status', 'kode_transfer', 'referensi', 'catatan', 'created_at')
        //     ->whereNull('deleted_at')
        //     ->orderBy('id', 'desc');

        $list = DB::table('pelaporan')
            ->select(
                'pelaporan.id as lapor_id',
                'pelaporan.kode',
                'pelaporan.screenshoot',
                'pelaporan.deskripsi',
                'pelaporan.created_at',
                'pelaporan.progres',
                'pelaporan.id_aplikasi',
                'aplikasi.nama as aplikasi',
                'pelaporan.id_customer',
                'pelanggan.nama as customer',
                'penanganan.id as tangani_id',
                'penanganan.kode_penanganan',
                'penanganan.updated_at',
                'penanganan.hasil_progres'
            )
            ->leftJoin('penanganan', 'penanganan.id_pelaporan', '=', 'pelaporan.id')
            ->leftJoin('pelanggan', 'pelaporan.id_customer', '=', 'pelanggan.id')
            ->leftJoin('aplikasi', 'pelaporan.id_aplikasi', '=', 'aplikasi.id')
            ->orderBy('penanganan.id', 'desc');

        if (isset($kode) && $kode != '') {
            $list->where('kode_transfer', '=', $kode);
        }
        if ($customer != null) {
            $list->where('customer', 'LIKE', '%' . $customer . '%');
        }
        if ($aplikasi != null) {
            $list->where('aplikasi', 'LIKE', '%' . $aplikasi . '%');
        }
        if ($status2 != null) {
            $list->where('hasil_progres', 'LIKE', '%' . $status2 . '%');
        }
        if ($tgl_end != null) {
            $start = $tgl_start . ' 00:00:01';
            $end = $tgl_end . ' 23:59:59';
            $list->where('date_header', '>=', $start);
            $list->where('date_header', '<=', $end);
        }

        $list =  $list->orderBy('penanganan.id')->get();

        $this->list = $list;
    }

    public function query()
    {
        return $this->list;
    }

    public function registerEvents(): array
    {

        $data = $this->list;

        return [
            AfterSheet::class => function (AfterSheet $event) use (
                $data
            ) {
                // Atur lebar kolom
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(25);
                $event->sheet->getColumnDimension('F')->setWidth(20);

                // Set borders for the header cells
                $event->sheet->getStyle('A2:F2')->getBorders()->applyFromArray([
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ]);

                // HEADER BARIS KE 1
                $event->sheet->setCellValue('A2', 'No');
                $event->sheet->setCellValue('B2', 'Kode');
                $event->sheet->setCellValue('C2', 'Customer');
                $event->sheet->setCellValue('D2', 'Aplikasi');
                $event->sheet->setCellValue('E2', 'Status');
                $event->sheet->setCellValue('F2', 'Tanggal');

                $row = 3;

                foreach ($data as $item) {
                    $event->sheet->setCellValue('A' . $row, $row - 2);
                    $event->sheet->setCellValue('B' . $row, $item->kode);
                    $event->sheet->setCellValue('C' . $row, $item->customer);
                    $event->sheet->setCellValue('D' . $row, $item->aplikasi);
                    $event->sheet->setCellValue('E' . $row, $item->hasil_progres);
                    $event->sheet->setCellValue('F' . $row, $item->updated_at);

                    $event->sheet->getStyle('A' . $row . ':F' . $row)->getBorders()->applyFromArray([
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ]);

                    $row++;
                }
            },
        ];

        return [];
    }
}
