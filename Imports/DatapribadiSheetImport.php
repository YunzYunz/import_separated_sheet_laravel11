<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Datapribadi;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');  // Untuk Heading agar sesuai header excel


class DatapribadiSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row);
        $user = User::where('email_karyawan', $row['Email Karyawan'])->first();

        if ($user) {
            $tanggal_lahir = Date::excelToDateTimeObject($row['Tanggal Lahir'])->format('Y-m-d');

            $datapribadi = Datapribadi::updateOrCreate(
                ['user_id' => $user->id], 
                [
                    'no_handphone' => $row['No Handphone'],
                    'no_telepon' => $row['No Telepon'],
                    'tempat_lahir' => $row['Tempat Lahir'],
                    'tanggal_lahir' => $tanggal_lahir,
                    'jk' => $row['Jenis Kelamin'],
                    'status_pernikahan' => $row['Status Pernikahan'],
                    'golongan_darah' => $row['Golongan Darah'],
                    'agama' => $row['Agama'],
                ]
            );
        }

        return null;
    }

    
}
