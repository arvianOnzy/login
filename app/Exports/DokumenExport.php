<?php

namespace App\Exports;

use App\Models\Dokumen_Master;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DokumenExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Dokumen_Master::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Dokumen',
            'Nomor Dokumen',
            'Jenis',
            'Ruangan',
            'Rak',
            'Kardus',
            'Gambar',
            'Dibuat',
            'Diperbarui',
        ];
    }
    // public function drawings()
    // {
    //     $drawing = new Dokumen_Master();
    //     $drawing->setName('Logo');
    //     // $drawing->setDescription('This is my logo');
    //     $drawing->setPath();
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('H2');

    //     return $drawing;
    // }
    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:J1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');

                $event->sheet->getDelegate()->freezePane('A2');
            },


        ];
    }
}
