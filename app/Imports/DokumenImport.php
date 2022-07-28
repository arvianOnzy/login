<?php

namespace App\Imports;

use App\Models\Dokumen_Master;
use Maatwebsite\Excel\Concerns\ToModel;

class DokumenImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dokumen_Master([
            'No' => $row[0],
            'Dokumen' => $row[1],
            'Nomor Dokumen' => $row[2],
            'Jenis' => $row[3],
            'Ruangan' => $row[4],
            'Rak' => $row[5],
            'Kardus' => $row[6],
            'Gambar' => $row[7],
            'Dibuat' => $row[8],
            'Diperbarui' => $row[9],
        ]);
    }
}
