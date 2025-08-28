<?php

namespace App\Imports;

use App\Models\RawAttendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class RawAttendanceImport implements ToModel,WithHeadingRow,WithChunkReading
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
        // A row with a string in the first column is an employee header
        if (isset($row[0]) && is_string($row[0])) {
            // Check if the cell contains the pattern "(XXXX)"
            if (preg_match('/\((.*?)\)/', $row[0], $matches)) {
                $this->employeeCode = $matches[1];
            }
            // Skip the employee header row itself
            return null;
        }
        
        // A row with a numeric value in the first column is a date
        if (isset($row[0]) && is_numeric($row[0])) {
            
            // Convert Excel's date serial number to a PHP date object
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);
            dd($date);
            // Convert Excel's time serial numbers to PHP date/time objects
            $in1 = isset($row[1]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('H:i:s') : null;
            $out1 = isset($row[2]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2])->format('H:i:s') : null;
            $in2 = isset($row[3]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3])->format('H:i:s') : null;
            $out2 = isset($row[4]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('H:i:s') : null;
            $in3 = isset($row[5]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->format('H:i:s') : null;

            // Only create a model if at least one time entry exists and an employee code is set
            if ($this->employeeCode && ($in1 || $out1 || $in2 || $out2 || $in3)) {
                return new DailyTimeRecord([
                    'employee_code' => $this->employeeCode,
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
