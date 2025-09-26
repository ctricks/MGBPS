<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\CivilStatus;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Department;
use App\Models\EmployeeStatus;
use App\Models\workschedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
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
        if($row[0]=="EmployeeNumber")
        {
            return null;
        }else
        {
            $civilstatus = CivilStatus::where('civilstatus',$row[7])->first();
            $gender = Gender::where('gender',$row[8])->first();
            $position = Position::where('PositionName',$row[9])->first();
            $department = Department::where('departmentname',$row[10])->first();
            $employeestatus = EmployeeStatus::where('employeestatus',$row[12])->first();
            $workshedule = workschedule::where('KeySchedule',$row[18])->first();
            
            $daily_rate = 0;

            if (is_numeric($row[13])) {
                // Cast the string to a double (float)
                $daily_rate = (double) $row[13];
            } else {
                // If conversion fails, use 0 as the default
                $daily_rate = 0.0;
            }
            
            $carbonDate = Carbon::parse($row[6]);
            $formattedDate = $carbonDate->format('Y-m-d');

            return new Employee([
                'employeenumber'=> $row[0],
                'lastname'=> $row[1],
                'firstname'=> $row[2],
                'middlename'=> $row[3],
                'Address'=> $row[4],
                'Telephone'=> $row[5],
                'birthday'=> $formattedDate,
                'civil_status_id'=> ($civilstatus->id),
                'gender_id'=> ($gender->id),
                'position_id'=> ($position->id),
                'department_id'=> ($department->id),
                'employee_status_id'=> ($employeestatus->id),
                'DailyRate'=>$daily_rate,
                'SubDepartment'=>$row[11],
                'PHIC_Number'=>$row[15], 
                'SSS_Number'=>$row[14],
                'HDMF_Number'=>$row[16],
                'TIN_Number'=>$row[17],
                'WorkDays'=>($workshedule->id),
            ]);
        }
    }
    // public function rules(): array
    // {
    //     return [
    //         'civil_status_id' => 'required|int',
    //         'gender_id'=> 'required|int',
    //         'position_id'=> 'required|int',
    //         'department_id'=> 'required|int',
    //         'employee_status_id'=> 'required|int',
    //     ];
    // }

    /**
     * Custom messages for validation errors (optional).
     */
    // public function customValidationMessages()
    // {
    //     return [
    //         'civil_status_id.required'   => 'Civil Status must be existing in record. Please check.',
    //         'gender_id.required'         => 'Gender must be existing in record. Please check.',
    //         'position_id.required'       => 'Position must be existing in record. Please check.',
    //         'department_id.required'     => 'Department must be existing in record. Please check.',
    //         'employee_status_id.required'=> 'Employee Status must be existing in record. Please check.',
    //     ];
    // }
}
