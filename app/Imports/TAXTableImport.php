<?php

namespace App\Imports;

use App\Models\Tax;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Auth;

class TAXTableImport implements ToModel,WithHeadingRow,WithChunkReading
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
        if (isset($row['startrange']) && isset($row['endrange'])) {
                return new TAX([
                    'StartRange'=>$row['startrange'],
                    'EndRange'=>$row['endrange'],
                    'OverMinimum'=>$row['overmin'],
                    'AddPercent'=>$row['addpercent'],
                    'AdditionalPay'=>$row['additonalpay'],
                    'PayType'=>$row['payout'],
                    'UploadedBy'=>Auth::id(),
                    'Year'=>$row['year'],
                ]);
        }
        return null; // Ignore rows that are not valid data entries
    }

}
