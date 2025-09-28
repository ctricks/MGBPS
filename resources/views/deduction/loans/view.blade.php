<x-admin>
    @section('title', 'View Loan Details')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Loan</h3>
            <div class="card-tools"><a href="{{ route('deductions.loans.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card-body">
                    <table class="table table-striped" id="loanTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loan Date</th>
                                <th>Type of Loan</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Amount Paid</th>
                                <th>Balances</th>
                                <th>Date Deducted</th>
                                <th>Status</th>
                                <th>ProcessBy</th>
                                <th>Date Processed</th>
                                {{-- <th></th>
                        <th></th>
                        <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $ltDet)
                                <tr>
                                    {{-- <td>{{ $ltDet->id }}</td> --}}
                                    <td>{{ $ltDet->id }}</td>
                                    <td>{{ Carbon\Carbon::parse($ltDet->LoanDate)->format('m-d-Y') }}</td>
                                    <td>{{ $ltDet->LoanType }}</td>
                                    <td>{{ $ltDet->Description }} </td>
                                    <td>{{ number_format($ltDet->Amount,2) }}</td>
                                    <td>{{ number_format($ltDet->AmountPaid,2) }}</td>
                                    <td>{{ number_format($ltDet->Balances,2) }}</td>
                                    <td>{{ $ltDet->Status == -1 ? "No Payslip Yet":"PaySlip #: ".$ltDet->Status }}</td>
                                    <td>{{ $ltDet->DateDeducted }}</td>
                                    <td>{{ $ltDet->ProcessedBy }}</td>
                                    <td>{{ $ltDet->ProcessedDate }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script>
    var date = new Date();
    date.setDate(date.getDate() - 1);
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
    $(document).ready(function() {
        $('#installment').on('keypress', function(event) {
            const inputValue = $(this).val() + String.fromCharCode(event.which);

            const partNum = parseFloat(inputValue);
            const loanAmount = parseFloat(document.getElementById("loanAmount").value);
            const deductionAmount = document.getElementById("deductionAmount");

            const deducAmt = loanAmount / partNum;
            deductionAmount.value = deducAmt.toFixed(2);

        });
    });
</script>
