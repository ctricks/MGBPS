<x-admin>
    @section('title', 'View Deductions')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Loan</h3>
            <div class="card-tools"><a href="{{ route('deductions.loans.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Loan Type:*</label>
                            <select name="LoanType" id="LoanType" class="form-control" required>
                                <option value="" selected disabled>select loan type</option>
                            </select>
                            <x-error>loantype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="LoanType" class="form-label">Description:*</label>
                            <select name="description" id="description" class="form-control" required>
                            </select>
                            <x-error>loantype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-8"></div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="name">Employee Code:*</label>
                            <input class="form-control" id="empcode" name="empcode" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Employee" class="form-label">Employee:*</label>
                            <select name="Employee" id="Employee" class="form-control" required>
                                <option value="" selected disabled>Select Employee</option>
                            </select>
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
                            <input class="form-control" id="sssnumber" name="sssnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">PhilHealth Number:*</label>
                            <input class="form-control" id="phicnumber" name="phicnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">HDMF Number:*</label>
                            <input class="form-control" id="hdmfnumber" name="hdmfnumber" type="text" disabled>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        {{-- <a href="#" id="SearchEmployee" class="btn btn-primary">Search</a> --}}
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Select Date:</label>
                            <input type="text" class="form-control datepicker" id="date" name="date"
                                placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Loan Amount:</label>
                            <input type="number" class="form-control" id="loanAmount" value="0" name="loanAmount" placeholder="Enter Loan Amount">
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">No of Payments:</label>
                            <input type="number" class="form-control" id="installment" name="installment" placeholder="Enter No of Payments">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="date">Amount of Deduction:</label>
                            <input type="decimal" class="form-control" id="deductionAmount" name="deductionAmount" placeholder="Enter No of Payments">
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
                    {{-- <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div> --}}
                </div>
        </div>
    </div>
</x-admin>
<script>
    $(document).ready(function() {
        // Cutoff Change
        $('#LoanType').change(function() {
            // Cutoff id
            var lt = $(this).val();
            $('#description').find('option').remove().end();
            // AJAX request 
            $.ajax({
                url: '/deductions/getloandesc/' + lt,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response.length > 0) {
                        response.forEach(response => {
                            // Create a new option
                            const newOption = new Option(response.Description,
                                response.id);
                            // Append the new option to the dropdown
                            $('#description').append(newOption);
                        });
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#Employee').change(function() {
            var empID = $(this).val();
            $.ajax({
                url: '/getemployeelist/' + empID, // Replace with your server URL
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response[0].employeenumber);
                    const employeecode = document.getElementById("empcode");
                    const sssnumber = document.getElementById("sssnumber");
                    const phicnumber = document.getElementById("phicnumber");
                    const hdmfnumber = document.getElementById("hdmfnumber");
                    const loannumber = document.getElementById("loannumber");

                    loannumber.value = response[0].LoanNumber;
                    sssnumber.value = response[0].SSS_Number;
                    phicnumber.value = response[0].PHIC_Number;
                    hdmfnumber.value = response[0].HDMF_Number;
                    employeecode.value = response[0].employeenumber;

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
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