<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;
use App\Imports\TAXTableImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TAXReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Tax::Select('tax.id','StartRange','EndRange','OverMinimum','AddPercent','AdditionalPay','PayType','Year','tax.updated_at','users.name as UploadedBy')
        ->LeftJoin('users','users.id','=','tax.UploadedBy')->orderby('id','ASC')->get();
        return view('admin.taxtable.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function import(Request $request)
    {
        $file = $request->file('file');
        // Get the file extension
        $extension = $file->getClientOriginalExtension();
   
        if($extension != 'xls')
            return back()->with('error', 'Data Imported Failed!\n'.'Invalid TAX Table-invalid extension. Please check or download the template first');    

        try{

        // Get the uploaded file
        $file = $request->file('file');

        // Step 1: Extract the headers
        $headings = (new HeadingRowImport)->toArray($file);

        // Step 2: Read the entire file to check for additional rows
        $rows = Excel::toArray(null, $file);
        
        //Validate if the excel file is for DTR Process
        if($rows[0][0] == null || Str::Upper($rows[0][0][0]) != Str::Upper('StartRange'))
            return back()->with('error', 'Data Imported Failed!\n'.'Invalid TAX Table File. Please check or download the template first');           
        
        // Check if there are no rows beyond the header
        if (count($rows[0]) <= 1) {
            // return response()->json([
            //     'message' => 'The file contains only the header row.',
            //     'headers' => $headings[0][0], // Return the headers for reference
            // ]);
            return back()->with('error', 'Data Imported Failed!\n'.'The file contains only the header row.');
        }
        
        Tax::truncate();

        $import = new TAXTableImport();

            Excel::import($import, $request->file('file'));

            return back()->with('success', 'Data Imported Successfully!');
            
            }catch(\Exception $e)
            {
                return back()->with('error', 'Data Imported Failed!'.$e->getMessage());
            }
    }
    public function downloadFileTemplate()
    {
        $filename = "TaxTable.xls";
        $path = storage_path("app/public/template/{$filename}");

        try {
            
            return response()->download($path, $filename, [
            'Content-Type' => 'application/text',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to download the file.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function computetax($Earnings)
    {
        $SQLQUERY = "select CAST(isnull((((".$Earnings." - OverMinimum) * AddPercent) + AdditionalPay),0.00) AS DECIMAL(10, 2)) as 'Tax' from tax
                     where ".$Earnings." between StartRange and EndRange and PayType = 'SEMI=MO' and Year = YEAR(getdate());";
        
        $data = DB::select($SQLQUERY);
        //dd(number_format($data[0]->Tax,2));
    }
}
