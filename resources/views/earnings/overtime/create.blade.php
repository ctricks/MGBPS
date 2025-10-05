<x-admin>
    @section('title', 'Create Overtime')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Overtime</h3>
            <div class="card-tools"><a href="{{ route('earnings.overtime.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
        </div>
        <div class="card-header">

            @session('success')
                <div class="alert alert-success" role="alert">
                    {{ $value }}
                </div>
            @endsession
            @session('failed')
                <div class="alert alert-danger" role="alert">
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
            <form action="{{ route('earnings.overtime.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="empnumber" class="form-label">Overtime Type:*</label>
                            <select name="OvertimeType" id="OvertimeType" class="form-control" required>
                                <option value="" selected disabled>select overtime type</option>
                                @foreach ($OvertimeType as $lt)
                                    <option value="{{ $lt->Description }}"
                                        {{ $lt->OvertimeType == old('LoanType') ? 'selected' : '' }}>
                                        {{ $lt->OvertimeType }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error>overtimetype</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="LoanType" class="form-label">Description:*</label>
                            <input class="form-control" id="overtime" name="overtime" type="text" readonly>
                            <x-error>overtime</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" class="form-control"
                                placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
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
                                @foreach ($employee as $emp)
                                    <option value="{{ $emp->employeenumber }}"
                                        {{ $emp->employeenumber == old('employee') ? 'selected' : '' }}>
                                        {{ $emp->lastname }} , {{ $emp->firstname }} {{ $emp->middlename }}</option>
                                @endforeach
                            </select>
                            <x-error>Employee</x-error>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Actual IN:</label>
                            <input type="text" id="TimeIN" name="TimeIN" class="form-control" placeholder="00:00"
                                required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Actual OUT:</label>
                            <input type="text" id="TimeOUT" name="TimeOUT" class="form-control" placeholder="00:00"
                                required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Schedule OUT:</label>
                            <input type="text" id="SchedOut" name="SchedOut" class="form-control"
                                placeholder="00:00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Actual OT Hours:</label>
                            <input type="text" id="ActualOTHours" name="ActualOTHours" class="form-control"
                                placeholder="0.00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Apply OT Hours:</label>
                            <input type="text" id="FiledOTHours" name="FiledOTHours" class="form-control"
                                placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="selectmonth">Month:</label>
                        <select name="monthfilter" id="monthfilter" class="form-control" required>
                            <option value="" selected disabled>select month</option>
                            @for ($month = 1; $month <= 12; $month++)
                                {{ $monthName = date('F', mktime(0, 0, 0, $month, 1)) }}
                                <option value="{{ $month }}">
                                    {{ $monthName }} </option>
                            @endfor
                        </select>
                        <x-error>monthfilter</x-error>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cutoff">Cut-off:</label>
                        <select name="cutoff" id="cutoff" class="form-control" required>
                            <option value="" selected disabled>select cutoff</option>
                        </select>
                        <x-error>cutoff</x-error>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="employee">Employee:*</label>
                        <select name="employeecode" id="employeecode" class="form-control" required>
                            <option value="" selected disabled>select employee</option>
                        </select>
                        <x-error>employeecode</x-error>
                    </div>
                </div>
                 <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Employee Number:</label>
                            <input type="text" id="EmployeeNumber" name="EmployeeNumber" class="form-control"
                                placeholder="" required readonly>
                        </div>
                    </div>
                <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Total Actual OT Hours:</label>
                            <input type="text" id="TotalOT" name="TotalOT" class="form-control"
                                placeholder="0.00" required readonly>
                        </div>
                    </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button id="checkovertime" name="checkovertime" class="btn btn-md btn-success">Check Overtime</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="overtimeTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Date Type</th>
                            <th>Cutoff Start Date</th>
                            <th>Cutoff End Date</th>
                            <th>Final In</th>
                            <th>Final Out</th>
                            <th>Schedule Out</th>
                            <th>Actual OT Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($data != null)
                    @foreach ($data as $empDTR) --}}
                        {{-- <tr>
                            <td>
                                {{-- <a href="{{ route('attendance.summaryattendance.view',['cutoff' => $empDTR->cutoffid, 'empcode' => $empDTR->employee_code]) }}"
                                    class="btn btn-sm btn-primary">View Details</a> --}}
                            {{-- </td> --}}
                            {{-- <td width="70px;">
                                {{-- <a href="{{ route('attendance.summaryattendance.view',['cutoff' => $empDTR->cutoffid, 'empcode' => $empDTR->employee_code]) }}"
                                    class="btn btn-sm btn-success">Payroll</a> --}}
                            {{-- </td> --}}
                        {{-- </tr>  --}}
                        {{-- @endforeach
                    @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
</x-admin>
<script>
    $(document).ready(function() {
        // Cutoff Change
        $('#OvertimeType').change(function() {
            // Cutoff id
            var lt = $(this).val();
            console.log(lt);
            const description = document.getElementById("overtime");
            description.value = lt;
        });
    });
     $(document).ready(function() {
        // Cutoff Change
        $('#employeecode').change(function() {
            // Cutoff id
            var lt = $(this).val().split(':')[1];
            const description = document.getElementById("EmployeeNumber");
            description.value = lt;
        });
    });
</script>
<script>
$(document).ready(function() {
        $('#checkovertime').click(function() {
            const cutoff = document.getElementById("cutoff").value;
            const empcode = document.getElementById("EmployeeNumber").value;
            console.log(empcode);
            CheckOvertimeCutoff(empcode);
        });
        const CheckOvertimeCutoff = (empCode) => {
            // var empCode = document.getElementById("empcode").value;
            const cutoff = document.getElementById("cutoff").value;
            var totalActualOT = 0;
            $.ajax({
                url: '/getemployeeovertimebycutoff/'+ cutoff + '/' + empCode.trim(), // Replace with your server URL
                type: 'GET',
                data: {},
                success: function(response) {
                    var otdata = '';
                    $("#overtimeTable").find("tbody").empty();
                     $.each(response, function (key, value) {
                            otdata += '<tr>';
                            otdata += '<td>' + 
                                value.id + '</td>';
                            otdata += '<td>' + 
                                value.Date + '</td>';
                            otdata += '<td>' + 
                                value.DType + '</td>';
                            otdata += '<td>' + 
                                value.StartDate + '</td>';
                            otdata += '<td>' + 
                                value.EndDate + '</td>';
                            otdata += '<td>' + 
                                value.FinalIN + '</td>';
                            otdata += '<td>' + 
                                value.FinalOUT + '</td>';        
                            otdata += '<td>' + 
                                value.EndTime + '</td>';
                            otdata += '<td>' + 
                                value.ActualOT + '</td>';
                            otdata += '<td>' + 
                                value.Status + '</td>';
                            if(value.Status == "")
                            {
                                otdata += '<td><a href="../overtimefile/'+ value.id +'" onclick="return ProcessOvertime(\'filing\');">Apply</a></td>';
                            }else
                            {
                                otdata += '<td><a href="../overtimefilecancel/'+ value.id +'" onclick="return ProcessOvertime(\'cancel\');">Cancel</a></td>';
                            }
                            otdata += '</tr>';
                            totalActualOT = totalActualOT + parseFloat(value.ActualOT);
                        });
                        $('#overtimeTable').append(otdata);
                        console.log(totalActualOT);
                        document.getElementById("TotalOT").value = totalActualOT.toFixed(2);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        // const ProcessOvertime = (id) => {
        //     let cont = confirm('Would you like to continue?');
        //     if(cont == true)
        //     {
                
        //     }
        // }
    });
</script>
<script type="text/javascript">
    function ProcessOvertime  (process) {
        let proc = process === 'filing'  ? 'Apply':'Cancel';
        let cont = confirm('Would you like to continue '+ proc +' process?');
            if(cont != true)
            {
                return false;
            }
    }
</script>
<script>
    $(document).ready(function() {
        $('#Employee').change(function() {
            var empCode = $(this).val();
            CheckOvertime(empCode);
        });
        $('#date').change(function() {
            empCode = document.getElementById("empcode").value;
            CheckOvertime(empCode);
            console.log(empCode);
        });
        const CheckOvertime = (empCode) => {
            // var empCode = document.getElementById("empcode").value;
            document.getElementById("empcode").value = empCode;
            var DateOT = document.getElementById("date").value;
            $.ajax({
                url: '/getemployeeovertime/' + empCode + '/' +
                    DateOT, // Replace with your server URL
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response[0].employeenumber);
                    const ActualIN = document.getElementById("TimeIN");
                    ActualIN.value = response[0].FinalIN;
                    const ActualOUT = document.getElementById("TimeOUT");
                    ActualOUT.value = response[0].FinalOUT;
                    const ScheduleOUT = document.getElementById("SchedOut");
                    ScheduleOUT.value = response[0].EndTime;
                    const ActualOTOUT = document.getElementById("ActualOTHours");
                    ActualOTOUT.value = response[0].ActualOT;

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
</script>
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

                        GetEmployeeNumber();
                    }
                }
            });
            const GetEmployeeNumber = () => {
                $('#employeecode').find('option').remove().end();
                const seletedCutoff = document.getElementById('cutoff').value;

                if (seletedCutoff > 0) {
                    //$('#employeecode').find('option').remove().end();
                    // AJAX request 
                    $.ajax({
                        url: '/get-dtr-employee/' + seletedCutoff,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var len = 0;
                            if (response.length > 0) {
                                response.forEach(response => {
                                    // Create a new option
                                    const EmpName = response.lastname + ',' +
                                        response.firstname + ' ' + response
                                        .middlename + ' : ' + response
                                        .employee_code;
                                    const EmployeeName = EmpName.replace('null',
                                        'No name yet').replace(',null null',
                                        '');
                                    console.log(EmpName);
                                    const newOption = new Option(EmployeeName,
                                        response.id);
                                    // Append the new option to the dropdown
                                    $('#employeecode').append(newOption);
                                    // $('#employeecode').append("<option value='"+response.id+"' selected>"+EmployeeName+"</option>");
                                });
                            }

                        }
                    });
                }
            }
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

            if (id > 0) {
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
                                const EmpName = response.lastname + ',' + response
                                    .firstname + ' ' + response.middlename + ' : ' +
                                    response.employee_code;
                                const EmployeeName = EmpName.replace('null',
                                    'No name yet').replace(',null null', '');
                                console.log(EmpName);
                                const newOption = new Option(EmployeeName, response
                                    .id);
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
