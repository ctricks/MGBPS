<x-admin>
    @section('title', 'Edit Loan')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Loan</h3>
            <div class="card-tools"><a href="{{ route('deductions.loans.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('deductions.loans.store') }}" method="POST" onsubmit="enableDropdown()">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Loan Type:*</label>
                            {{-- <input class="form-control" id="LoanType" name="LoanType" type="text" value="{{ $loanType->LoanType }}" readonly> --}}
                            <select name="LoanType" id="LoanType" class="form-control" required disabled>
                                <option value="" disabled>select loan type</option>
                                @foreach ($loanType as $lt)
                                    <option value="{{ $lt->LoanType }}"
                                        {{ $lt->LoanType ==  $loanTypeSelected->LoanType  ? 'selected' : '' }}>{{ $lt->LoanType }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error>loantype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="lbldesc" class="form-label">Description:*</label>
                            {{-- <input class="form-control" id="desciption" name="desciption" type="text" value="{{ $loanType->Description }}" readonly> --}}
                             <select name="description" id="description" class="form-control" required disabled>
                                <option value="" >Select Description</option>
                                @foreach ($loanType as $lt)
                                    <option value="{{ $lt->id }}"
                                        {{ $lt->id ==  $loanTypeSelected->id  ? 'selected' : '' }}>{{ $lt->Description }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error>description</x-error>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="name">Employee Code:*</label>
                            <input class="form-control" id="empcode" name="empcode" type="text" value="{{ $employee->employeenumber }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Employee" class="form-label">Employee:*</label>
                            <input class="form-control" id="empname" name="empname" type="text" value=" {{ $employee->lastname }} , {{ $employee->firstname }} {{ $employee->middlename }}" readonly>
                            <x-error>Employee</x-error>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Loan Number:*</label>
                            <input class="form-control" id="loannumber" name="loannumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">SSS Number:*</label>
                            <input class="form-control" id="sssnumber" name="sssnumber" type="text" value="{{ $employee->SSS_Number }}" disabled/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">PhilHealth Number:*</label>
                            <input class="form-control" id="phicnumber" name="phicnumber" type="text" value="{{ $employee->PHIC_Number }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">HDMF Number:*</label>
                            <input class="form-control" id="hdmfnumber" name="hdmfnumber" type="text" value="{{ $employee->HDMF_Number }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        {{-- <a href="#" id="SearchEmployee" class="btn btn-primary">Search</a> --}}
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Select Date:</label>
                            <input type="text" class="form-control datepicker" id="date" name="date"
                                placeholder="YYYY-MM-DD" value ="{{ \Carbon\Carbon::parse($loan->LoanDate)->format('m/d/Y')}}" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Loan Amount:</label>
                            <input type="number" class="form-control" id="loanAmount" value="{{ $loan->Amount }}" name="loanAmount" placeholder="Enter Loan Amount">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">No of Payments:</label>
                            <input type="number" class="form-control" id="installment" name="installment" value="{{ $loan->NoOfPayment }}" placeholder="Enter No of Payments"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Amount of Deduction:</label>
                            <input type="decimal" class="form-control" id="deductionAmount" name="deductionAmount" value={{ $loan->AmountDeduction }} placeholder="Enter No of Payments" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Semi-Monthly Interest(%):</label>
                            <input type="number" class="form-control" id="SemiInterest" name="SemiInterest" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Total Interest:</label>
                            <input type="number" class="form-control" id="TotalInterest" name="TotalInterest" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Interest Balanace:</label>
                            <input type="number" class="form-control" id="InterestBalance" name="InterestBalance" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Balance:</label>
                            <input type="number" class="form-control" id="Balance" name="Balance" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    {{-- <div class="col-lg-4">
                        <div class="form-group">
                            <label for="isActive" class="form-label">Active:*</label>
                            <select name="isActive" id="isActive" class="form-control" required>
                                <option value="" selected disabled>Select Record Status</option>
                                <option value="1" selected>Active</option>
                                <option value="0">In-active</option>
                            </select>
                            <x-error>isActive</x-error>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit" >Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script>
    var date = new Date();
    date.setDate(date.getDate()-1);
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Adjust format as needed
            autoclose: true,
            todayHighlight: true,
            minDate: date
        });
    });
</script>
<script>
        $(document).ready(function () {
            $('#installment').on('keypress', function (event) {
                const inputValue = $(this).val() + String.fromCharCode(event.which);
               
                const partNum = parseFloat(inputValue);
                const loanAmount = parseFloat(document.getElementById("loanAmount").value);
                const deductionAmount = document.getElementById("deductionAmount");
            
                const deducAmt =  loanAmount / partNum ;
                deductionAmount.value = deducAmt.toFixed(2);
               
            });
        });
    </script>
    <script>
  function enableDropdown() {
        document.getElementById("LoanType").disabled = false;
        document.getElementById("description").disabled = false;
  }
</script>