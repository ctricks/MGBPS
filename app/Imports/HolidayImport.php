<?php

namespace App\Imports;

use App\Models\Holiday;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class HolidayImport implements ToModel,WithHeadingRow,WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $employeeCode;

    public function __construct()
    {
        $this->employeeCode = null;
    }

    public function startRow(): int
    {
        return 5; // Start reading from the 5th row
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function model(array $row)
    {
        dd($row);

        if (isset($row[0]) && is_string($row[0]) && is_date($row[1]) && is_string($row[1])) {
            
            // Convert Excel's date serial number to a PHP date object
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
           
            
            // Only create a model if at least one time entry exists and an employee code is set
            if ($this->employeeCode && ($in1 || $out1 || $in2 || $out2 || $in3)) {
                return new Holiday([
                    'year' => $this->employeeCode,
                    'date' => $date->format('Y-m-d'),
                    'in_1' => $in1,
                    'out_1' => $out1,
                    'in_2' => $in2,
                    'out_2' => $out2,
                    'in_3' => $in3,
                ]);
            }
        }
        return null; // Ignore rows that are not valid data entries
    }

}
