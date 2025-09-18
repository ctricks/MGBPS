<?php

namespace App\Imports;

use App\Models\SSSReference;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Auth;

class SSSTableImport implements ToModel,WithHeadingRow,WithChunkReading
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
        
        if (isset($row['compensation_from']) && isset($row['compensation_to'])) {
                return new SSSReference([
                    'StartRangeComp'=>$row['compensation_from'],
                    'EndRangeComp'=>$row['compensation_to'],
                    'EC'=>$row['monthly_salary_credit_ec'],
                    'MPF'=>$row['monthly_salary_credit_mpf'],
                    'MSC_TOTAL'=>$row['monthly_salary_credit_total'],
                    'EMPLOYERREGSSS'=>$row['employer_regular_ss'],
                    'EMPLOYERMPF'=>$row['employer_mpf'],
                    'EMPLOYEREC'=>$row['employer_ec'],
                    'EMPLOYERTOTAL'=>$row['employer_total'],
                    'EMPLOYERREGSSS'=>$row['employee_regular_ss'],
                    'EMPLOYERMPF'=>$row['employee_regular_mpf'],
                    'EMPLOYEETOTAL'=>$row['employee_regular_total'],
                    'TOTAL'=>$row['employee_total'],
                    'CreatedBy'=>Auth::id(),
                ]);
        
        }
        return null; // Ignore rows that are not valid data entries
    }

}
