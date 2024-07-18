<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');  // Untuk Heading agar sesuai header excel


class UsersSheetImport implements ToModel, WithHeadingRow
{
   
    public function model(array $row)
    {
        // dd($row);
        $user = User::where('email_karyawan', $row['Email Karyawan'])->first();

        if ($user) {
            $user->update([
                'nama_karyawan' => $row['Nama Karyawan'],
                'status' => $row['Status'],
                'updated_at' => now(),
                'role_id' => $row['Role ID'],
            ]);
        } else {
            $user = User::create([
                'email_karyawan' => $row['Email Karyawan'],
                'nama_karyawan' => $row['Nama Karyawan'],
                'password' => Hash::make('medsa#karyawan312'),
                'status' => $row['Status'],
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => $row['Role ID'],
            ]);
        } 

        return $user;
    }

   
}
