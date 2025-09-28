<x-admin>
    @section('title','View Payroll Summary')
    {{-- <style>
    input[type="text"] {
      border: none;
      outline: none; /* Removes focus outline */
      background: transparent; /* Optional: Makes background transparent */
      font-size: 16px; /* Optional: Adjust font size */
      padding: 5px; /* Optional: Add padding for better usability */
    }
  </style> --}}
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Payroll Table Period: {{ $cutoffDataSelected }}</h3><br>
            <h3 class="card-title">Total Working Days: {{ number_format($data[0]->WorkingDays,2) }}</h3>
            <div class="card-tools">
                <a href="{{ route('payroll.payroll.index') }}" class="btn btn-sm btn-info">Back</a>
            </div>
        </div>
    <div class="card-header">
  
            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession
  
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    <div class="card-body">
          <form class="needs-validation" novalidate action="{{ route('payroll.payroll.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Number:*</label>
                                <input type="text" class="form-control" name="employeenumber" required numeric
                                    value="{{ $data[0]->Employee_Code }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Name:*</label>
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="{{ $data[0]->EmployeeName }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>

                            <div class="form-group col-lg-4"></div>
                            <div class="form-group col-lg-2">EARNINGS</div>
                            <div class="form-group col-lg-2">HOUR/s</div>
                            <div class="form-group col-lg-2">AMOUNT</div>
                            <div class="form-group col-lg-2">DEDUCTIONS</div>
                            <div class="form-group col-lg-2">HOUR/s</div>
                            <div class="form-group col-lg-2">AMOUNT</div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="BASIC PAY:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="dailyrate" id="dailyrate"
                                    value="{{ number_format($data[0]->DailyRate,2) }} / day" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="basicpay" id="basicpay" 
                                    value="{{ number_format($data[0]->BasicPay,2) }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="ABSENCES:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentDay" required numeric
                                    value="{{ $data[0]->Absent }} day(s)" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="({{ $data[0]->AbsentPay }})" readonly>
                            </div>
                            {{-- second row --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Regular OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="regularOTHrs" id="regularOTHrs"
                                    value="{{ number_format($data[0]->RegularOTHrs,2) }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="regulartOTpay" id="regularOTPay" 
                                    value="{{ number_format($data[0]->RegularOTPay,2) }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Half Day:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="HalfdayHrs" required numeric
                                    value="{{ $data[0]->HalfdayHrs }} hrs" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->AbsentPay }}" readonly>
                            </div>     
                            {{-- Third Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Sunday/DayOff OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Late:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="{{ $data[0]->LateHrs }} hrs" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div> 
                            {{-- Fourth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Undertime:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="{{ $data[0]->LateHrs }} hrs" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div> 
                            {{-- Fifth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Legal OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="SSS:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="" required numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div> 
                            {{-- Sixth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="PhilHealth:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div> 
                            {{-- Seventh Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Special Non Working OT :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="HDMF :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div> 
                            {{-- Eighth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="TAX :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div>
                            {{-- Nineth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Day Off Legal OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="SSS Loans :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div>
                            {{-- Tenth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="HDMF Loans :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div>
                            {{-- Eleventh Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Day Off Special NW OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Other Loans :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="AbsentPay" required numeric
                                    value="{{ $data[0]->LatePay }}" readonly>
                            </div>
                            {{-- Twelveth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Thirteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Night Diff :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Fourteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Allowance (Taxable) :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Fifteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Allowance (E-Cola):" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Sixteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Others (Taxable):" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Seventeen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Other (Non Taxable 2) :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Eighteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Other (Non Taxable 3) :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Nineteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Adjustment :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->SundayOTHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->SundayOTPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="OTHERS:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="0.00" readonly>
                            </div>
                            <div class="form-group col-lg-12"></div>
                            {{-- Last Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Total Earnings :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="TotalEarnings" id="TotalEarnings"
                                    value="{{ $data[0]->TotalEarnings }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="Total Deduction :" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="0" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Net Pay :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="0.00" readonly>
                            </div>
                        <div class = "form-group col-lg-12">
                                <button type="submit" class="btn btn-primary float-left">Save</button>
                        </div>
            </form>  
    </div>
</x-admin>
<script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#monthfilter').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#cutoff').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-cutoff/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.StartDate +
                                            ' to ' + response.EndDate, response.id);
                                        // Append the new option to the dropdown
                                        $('#cutoff').append(newOption);
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Cutoff Change
                    $('#cutoff').change(function() {
                        // Cutoff id
                        var id = $(this).val();
                        $('#employeecode').find('option').remove().end();
                       
                        if(id > 0)
                        {
                        //$('#employeecode').find('option').remove().end();
                        // AJAX request 
                        $.ajax({
                            url: '/get-dtr-employee/' + id,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        const newOption = new Option(response.employee_code, response.id);
                                        // Append the new option to the dropdown
                                        $('#employeecode').append(newOption);
                                    });
                                }

                            }
                        });
                        }
                    });
                });
            </script>
    {{-- <script>
        function computeSum() {
            const BasicPay = parseFloat(document.getElementById('basicpay').value) || 0;
            const regulartOTpay = parseFloat(document.getElementById('regulartOTpay').value) || 0;

            document.getElementById('TotalEarnings').value = BasicPay + regulartOTpay;
        }
    </script> --}}