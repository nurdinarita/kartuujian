<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class MembersExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Tanggal Lahir',
            'Domisili',
            'Email',
            'Phone',
            'Tanggal Daftar'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::select('name', 'birth_date', 'domisili', 'email', 'phone', 'created_at')->get();
    }

    public function map($student): array
    {
        return [
            $student->name,
            Date::phpToExcel($student->birth_date),
            $student->domisili,
            $student->email,
            $student->phone,
            Date::dateTimeToExcel($student->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
