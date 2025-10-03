<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = User::count();
        view()->share('user',$user);
        
        $employee = Employee::count();
        view()->share('employee',$employee);
        
        $attendanceprocess = DB::select("select count(a.id) as 'AttendanceSummary' from summary_attendance a
                                      left join cutoff c on a.StartDateCutoff = c.StartDate and a.EndDateCutoff = c.EndDate
                                      --where CURRENT_TIMESTAMP between a.StartDateCutoff and a.EndDateCutoff
                                      where c.status = 'OPEN'
                                      "
                                    );

        $payrollprocess = DB::select("SELECT 
                                        COUNT(DISTINCT(dtr.employee_code)) as PayrollProcess
                                                FROM 
                                                    daily_time_records dtr
                                                left join employees emp on dtr.employee_code = emp.employeenumber
                                                left join cutoff cu on dtr.cutoff = cu.id 
                                                left join payroll pay on pay.EmployeeCode = emp.employeenumber and pay.Cutoff_id = cu.id
                                                left join users u on u.id = pay.PreparedBy 
                                                left join users a on a.id = pay.ApprovedBy
                                                where 
                                                    dtr.date between cu.StartDate and cu.EndDate and
                                                    cu.Status = 'OPEN' 
                                      "
                                    );

        $overtimeprocess = DB::select("select count(o.id) as 'OvertimeProcess' from overtime o
                                       left join cutoff c on o.OTDate between c.StartDate and c.EndDate
                                       where c.status = 'OPEN' and o.status = 'For Approval'
                                      "
                                    );

        $leaveprocess = DB::select("select count(l.id) as 'LeaveProcess' from Leaves l
                                       left join cutoff c on l.StartDate between c.StartDate and c.EndDate
                                       where c.status = 'OPEN' and l.status = 'For Approval'
                                      "
                                    );
        
        view()->share('processAttendance',$attendanceprocess[0]->AttendanceSummary);
        view()->share('processPayroll',$payrollprocess[0]->PayrollProcess);
        view()->share('processOvertime',$overtimeprocess[0]->OvertimeProcess);
        view()->share('processLeave',$leaveprocess[0]->LeaveProcess);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
