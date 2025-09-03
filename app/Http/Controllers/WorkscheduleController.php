<?php

namespace App\Http\Controllers;

use App\Models\Restday;
use App\Models\Employee;
use App\Models\WorkSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class WorkscheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = WorkSchedule::orderBy('id','DESC')->get();
        return view('attendance.workschedule.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = Employee::orderBy('id','ASC')->get();
        return view('attendance.workschedule.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        WorkSchedule::updateOrCreate(
            [
                'KeySchedule'=>$request->KeySchedule,
                'StartTime'=>$request->starttime,
                'EndTime'=>$request->endtime,
                'GracePeriodMins'=>$request->GracePeriod,
                'isActive'=>$request->isActive,
            ],
        );
        if($request->id){
            $msg = 'Work Schedule updated successfully.';
        }else{
            $msg = 'Work Schedule created successfully.';
        }
        return redirect()->route('attendance.workschedule.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(workschedule $workschedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = WorkSchedule::where('id',decrypt($id))->first();
      
        return view('attendance.workschedule.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, workschedule $workschedule)
    {
        //
        $request->validate([
            "KeySchedule"=>'required','string','max:255',
        ]);

        $skedday = WorkSchedule::find($request->id);
        $skedday->KeySchedule = $request->KeySchedule; 
        $skedday->StartTime = $request->starttime;
        $skedday->EndTime = $request->endtime;
        $skedday->GracePeriodMins = $request->GracePeriod;
        $skedday->isActive = $request->isActive;
        $skedday->save();
        
        return redirect()->route('attendance.workschedule.index')->with('Success','Restday updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        WorkSchedule::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','Schedule deleted successfully.');
    }
}
