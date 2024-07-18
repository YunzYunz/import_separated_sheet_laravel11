<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Datapribadi;
use App\Models\Identitasdanalamat;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');  // Untuk Heading agar sesuai header excel


class IdentitasdanalamatSheetImport implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
        // dd($row);
        $user = User::where('email_karyawan', $row['Email Karyawan'])->first();

        if ($user) {
            if (strtolower($row['Masa Berlaku Identitas']) === "seumur hidup") {
                $masa_berlaku_identitas = 'seumur hidup';
            } else {
                $masa_berlaku_identitas = Date::excelToDateTimeObject($row['Masa Berlaku Identitas'])->format('Y-m-d');
            }

            $datapribadi = Datapribadi::where('user_id', $user->id)->first();

            if ($datapribadi) { 
                Identitasdanalamat::updateOrCreate(
                    ['datapribadi_id' => $datapribadi->id],
                    [
                        'jenis_identitas' => $row['Jenis Identitas'],
                        'no_identitas' => $row['No Identitas'],
                        'masa_berlaku_identitas' => $masa_berlaku_identitas,
                        'kode_pos' => $row['Kode Pos'],
                        'alamat_identitas' => $row['Alamat Identitas'],
                        'alamat_tinggal_sekarang' => $row['Alamat Tinggal Sekarang'],
                    ]
                );
            }
        }

        return null; 
    }

    
}
