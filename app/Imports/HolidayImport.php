<?php

namespace App\Imports;

use App\Models\Holiday;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Auth;

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
        return 2; // Start reading from the 5th row
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function model(array $row)
    {
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']);
        
        $keyvalue = $date->format('Y') . '_' . $row['event'];
        Holiday::where("HolidayKey",$keyvalue)->delete();

        if (isset($row['event']) && is_string($row['event']) && isset($date) && is_string($row['type'])) {
           
                return new Holiday([
                    'Year'=>$date->format('Y'),
                    'HolidayKey'=>$date->format('Y') . "_" . $row['event'],
                    'HolidayName'=>$row['event'],
                    'Date'=>$date,
                    'HolidayType'=>$row['type'],
                    'CreatedBy'=>Auth::id(),
                ]);
        
        }
        return null; // Ignore rows that are not valid data entries
    }

}
