<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Restday;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RestdayImport implements ToModel, WithStartRow, WithChunkReading
{
       private $employeeCode;

    public function __construct()
    {
        $this->employeeCode = null;
    }

    public function startRow(): int
    {
        return 2; // Start reading from the 5th row
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    public function model(array $row)
    {
        dd($this->$row[0]);

        // Check if the row contains an employee header (e.g., "AGOJO, GABRIELA MALAYO (0199)")
        if (isset($row[0]) && is_string($row[0]) && preg_match('/\((.*?)\)/', $row[0], $matches)) {
            $this->employeeCode = $matches[1];
            return null; // Don't insert this row.
        }

        // Check if the row contains a date, indicating it's a data row
        if (isset($row[0])) {
      
                return Restday::updateOrCreate([
                    'employee_id' => $this->employeeCode,
                    'date' => $formattedDate,
                    'in_1' => $in1,
                    'out_1' => $out1,
                    'in_2' => $in2,
                    'out_2' => $out2,
                    'in_3' => $in3,
                    'out_3' => $out3,
                ]);
            
        }
        return null; // Skip any other rows (e.g., empty rows).
    }
}