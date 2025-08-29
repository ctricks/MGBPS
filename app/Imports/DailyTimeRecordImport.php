<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\DailyTimeRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DailyTimeRecordImport implements ToModel, WithStartRow, WithChunkReading
{
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
        // Check if the row contains an employee header (e.g., "AGOJO, GABRIELA MALAYO (0199)")
        if (isset($row[0]) && is_string($row[0]) && preg_match('/\((.*?)\)/', $row[0], $matches)) {
            $this->employeeCode = $matches[1];
            return null; // Don't insert this row.
        }

        // Check if the row contains a date, indicating it's a data row
        if (isset($row[0])) {
            $datestring = substr($row[0], 0, -2);
            
            $carbonDate = Carbon::parse($datestring);
            $formattedDate = $carbonDate->format('Y-m-d');
        
            $carbonIN_1 = Carbon::parse($row[3]);
            
            // Convert Excel time values to H:i:s format, or null if empty
            $in1 = $row[1] == "" ? null:Carbon::parse($row[1])->format('H:i');
            $out1 = $row[2] == "" ? null:Carbon::parse($row[2])->format('H:i');
            $in2 = $row[3] == "" ? null:Carbon::parse($row[3])->format('H:i');
            $out2 = $row[4] == "" ? null:Carbon::parse($row[4])->format('H:i');
            $in3 = $row[5] == "" ? null:Carbon::parse($row[5])->format('H:i');
            $out3 = $row[6] == "" ? null:Carbon::parse($row[6])->format('H:i');
    
            // Only create a model if we have an employee code and at least one time entry
            if ($this->employeeCode) {
                return DailyTimeRecord::updateOrCreate([
                    'employee_code' => $this->employeeCode,
                    'date' => $formattedDate,
                    'in_1' => $in1,
                    'out_1' => $out1,
                    'in_2' => $in2,
                    'out_2' => $out2,
                    'in_3' => $in3,
                    'out_3' => $out3,
                ]);
            }
        }
        return null; // Skip any other rows (e.g., empty rows).
    }
}