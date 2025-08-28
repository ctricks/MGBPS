<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\CivilStatus;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Department;
use App\Models\EmployeeStatus;
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
            $employeestatus = EmployeeStatus::where('employeestatus',$row[11])->first();

            return new Employee([
                'employeenumber'=> $row[0],
                'lastname'=> $row[1],
                'firstname'=> $row[2],
                'middlename'=> $row[3],
                'Address'=> $row[4],
                'Telephone'=> $row[5],
                'birthday'=> $row[6],
                'civil_status_id'=> ($civilstatus->id),
                'gender_id'=> ($gender->id),
                'position_id'=> ($position->id),
                'department_id'=> ($department->id),
                'employee_status_id'=> ($employeestatus->id),
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
