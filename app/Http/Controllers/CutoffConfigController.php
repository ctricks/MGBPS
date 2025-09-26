<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CutOff;
use Carbon\Carbon;


class CutoffConfigController extends Controller
{
    //
    public function index()
    {
        $data = DB::select("
                    select c.*,u.name as 'OpenName',o.name as 'ClosedName' from cutoff c
                    left join users u on c.OpenBy = u.id
                    left join users o on c.ClosedBy = u.id
                    where 
                        StartDate between DATEFROMPARTS(YEAR(CURRENT_TIMESTAMP), 1, 1) and 
                        DATEFROMPARTS(YEAR(CURRENT_TIMESTAMP), 12, 31) 
                ");
        return view('cutoff.index', compact('data'));
    }

    public function open(Request $request,$id)
    {
        $dtrcor = Cutoff::find(decrypt($id));
        $dtrcor->status = "OPEN";
        $dtrcor->OpenBy =$request->user()->id;
        $dtrcor->OpenDate = Carbon::now()->timezone('Asia/Manila');
        $dtrcor->save();
       
        return redirect()->back()->with('success','Cut-off opened successfully.');
        // return view('cutoff.index');
    }
    public function close(Request $request,$id)
    {
        $dtrcor = DTRCorrection::find(decrypt($id));
        $dtrcor->status = "CLOSED";
        $dtrcor->ClosedBy =$request->user()->id;
        $dtrcor->CloseddDate = Carbon::now()->timezone('Asia/Manila');
        $dtrcor->save();
        return redirect()->back()->with('success','Cut-off closed successfully.');
       
        // return view('cutoff.index', compact('data'));
    }
}
