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
                                <input type="text" class="form-control" name="empcode" id="empcode" required numeric
                                    value="{{ $data[0]->Employee_Code }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="employeenumber" class="form-label">Employee Name:*</label>
                                <input type="text" class="form-control" name="employeename" required numeric
                                    value="{{ $data[0]->EmployeeName }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="employeenumber" class="form-label">Cut-off:*</label>
                                <input type="text" class="form-control" width = "20" name="cutoffid" id="cutoffid" required numeric
                                    value="{{ $cutoff }}" hidden>
                                <input type="text" class="form-control" name="cutoffdetails" id="cutoffdetails" required numeric
                                    value="{{ $cutoffDataSelected }}" readonly>
                                    <x-error>employeenumber</x-error>
                            </div>
                            <div class="form-group col-lg-2"></div>
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
                                <input type="text" class="form-control" name="AbsentDay" id="AbsentDay" required numeric
                                    value="{{ $data[0]->Absent }} day(s)" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="Absents" id="Absents" required numeric
                                    value="{{ $data[0]->AbsentPay }}" readonly>
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
                                    value="{{ number_format($data[0]->HalfdayPay,2) }}" readonly>
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
                                    value="{{ number_format($data[0]->LatePay,2) }}" readonly>
                            </div> 
                            {{-- Fourth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->ExceedingHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->ExceedingHrsPay }}" readonly></div>
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
                                    value="{{ number_format($data[0]->LatePay,2) }}" readonly>
                            </div> 
                            {{-- Fifth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Legal OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ number_format($data[0]->LegalOTHrs,2) }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ number_format($data[0]->LegalOTPay,2) }}" readonly></div>
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
                                    value="{{ $data[0]->ExceedingHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ number_format($data[0]->ExceedingHrsPay,2) }}" readonly></div>
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
                                    value="{{ number_format($data[0]->SplNWOTHrs,2) }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ number_format($data[0]->SplNWOTPay,2) }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="HDMF :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" id="HDMF_P" name="HDMF_P" required numeric
                                    value="{{ number_format($data[0]->HDMF,2)}}" readonly>
                            </div> 
                            {{-- Eighth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Exceeding Hours:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ $data[0]->ExceedingHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->ExceedingHrsPay }}" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="TAX :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name=""  numeric
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" name="TaxPay" id = "TaxPay" required numeric
                                    value="{{ number_format($data[0]->TaxPay) }}" readonly>
                            </div>
                            {{-- Nineth Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Day Off Legal OT:" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="{{ number_format($data[0]->LGRDOTHrs,2) }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ number_format($data[0]->LGRDOTPay,2) }}" readonly></div>
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
                                    value="{{ $data[0]->ExceedingHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->ExceedingHrsPay }}" readonly></div>
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
                                    value="{{ number_format($data[0]->SplRDOTHrs,2) }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ number_format($data[0]->SplRDOTPay,2) }}" readonly></div>
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
                                    value="{{ $data[0]->ExceedingHrs }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ $data[0]->ExceedingHrsPay }}" readonly></div>
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
                                    value="{{ 0 }}" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="{{ 0.00 }}" readonly></div>
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
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="AllowansTax" id="AllowansTax" 
                                    value = "0" placeholder="0.00" oninput="handleTyping(event);"></div>
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
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="AllowanceECOLA" id="AllowanceECOLA" 
                                   value = "0" placeholder="0.00" oninput="handleTyping(event);"></div>
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
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="othnontax" id="othnontax" 
                                    value = "0" placeholder="0.00" oninput="handleTyping(event);"></div>
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
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="othnontax2" id="othnontax2" 
                                    value = "0" placeholder="0.00" oninput="handleTyping(event);"></div>
                            <div class="form-group col-lg-6">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            {{-- Eighteen Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Other(Non-Tax 3):" >
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="" id=""
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="othnontax3" id="othnontax3" 
                                   value = "0" placeholder="0.00" oninput="handleTyping(event);"></div>
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
                                    value="" readonly >
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="EarningsAdj" id="EarningsAdj" 
                                    value="0" placeholder="0.00" oninput="handleTyping(event);"></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="OTHERS:" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" id="DeducOTH" name="DeducOTH" 
                                   value="0" placeholder="0.00" oninput="handleTyping(event);" >
                            </div>
                            <div class="form-group col-lg-12"></div>
                            {{-- Last Lane --}}
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" 
                                    value="Total Earnings :" readonly>
                            </div>
                            <div class="form-group col-lg-2"> 
                                <input type="text" class="form-control" name="TotalEarnings" id="TotalEarnings"
                                    value="0.00" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                 <input type="text" class="form-control" name="" id="" 
                                    value="Total Deduction :" readonly></div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" id="TotalDeduction" name="TotalDeduction"
                                    value="0.00" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control"  
                                    value="Net Pay :" readonly>
                            </div>
                            <div class="form-group col-lg-2">
                                <input type="text" class="form-control" id="NetAmount" name="NetAmount" 
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
  <script>
    // Executes after the entire page has loaded
    window.onload = function () {
        computeSum();
        const ecode = document.getElementById('empcode');
        console.log(ecode);
        ecode.readOnly = true;
        
    };
  </script>
    <script>
        function handleTyping(event) {
            computeSum();
        }
        function computeSum() {

            const BasicPay = document.getElementById('basicpay').value.replace(/,/g, '');
            const regularOTpay = document.getElementById('regularOTPay').value.replace(/,/g, '');
            const AdjEarnings = document.getElementById('EarningsAdj').value.replace(/,/g, '');
            const NonTax3 = document.getElementById('othnontax3').value.replace(/,/g, '');
            const NonTax2 = document.getElementById('othnontax2').value.replace(/,/g, '');
            const NonTax = document.getElementById('othnontax').value.replace(/,/g, '');
            const AllowanceECOLA = document.getElementById('AllowanceECOLA').value.replace(/,/g, '');
            const AllowanceTax = document.getElementById('AllowansTax').value.replace(/,/g, '');
            const DeducOther = document.getElementById('DeducOTH').value.replace(/,/g, '');
            const Earnings = parseFloat(BasicPay) + parseFloat(regularOTpay) + parseFloat(AdjEarnings) 
                             + parseFloat(NonTax3) + parseFloat(NonTax2) + parseFloat(NonTax) + 
                             parseFloat(AllowanceECOLA) +parseFloat(AllowanceTax) + parseFloat(DeducOther);
            const AbsentPay = document.getElementById('Absents').value.replace(/,/g, '');
            const HDMF = document.getElementById('HDMF_P').value.replace(/,/g, '');
            
            
                        $.ajax({
                            url: '/computetax/' + Earnings,
                            type: 'get',
                            dataType: 'json',
                            success: function(response) {
                                var len = 0;
                                if (response.length > 0) {
                                    response.forEach(response => {
                                        // Create a new option
                                        // Append the new option to the dropdown
                                        console.log(response.Tax);
                                        document.getElementById('TaxPay').value = response.Tax.toFixed(2);
                                       
                                    });
                                }
                            }
                        });
            const TaxPay =  document.getElementById('TaxPay').value.replace(/,/g, '');
            const Deduction = parseFloat(HDMF) + parseFloat(AbsentPay)  + parseFloat(TaxPay);
            const NetAmount = Earnings - Deduction;
            
            
            document.getElementById('TotalEarnings').value = Earnings.toFixed(2);
            document.getElementById('TotalDeduction').value = Deduction.toFixed(2);
            document.getElementById('NetAmount').value = NetAmount.toFixed(2);
        }
    </script>
