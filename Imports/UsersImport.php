<?php
namespace App\Imports;

use App\Imports\UsersSheetImport;
use App\Imports\DatapribadiSheetImport;
use App\Imports\IdentitasdanalamatSheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');  // Untuk Heading agar sesuai header excel


class UsersImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new UsersSheetImport(),
            1 => new DatapribadiSheetImport(),
            2 => new IdentitasdanalamatSheetImport(),
        ];
    }
}
