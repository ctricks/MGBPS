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
                                        {{ $lt->OvertimeType == old('LoanType') ? 'selected' : '' }}>{{ $lt->OvertimeType }}
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
                            <input type="date" id="date" name="date"
                              class="form-control" placeholder="YYYY-MM-DD" required>
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
                            <input type="text" id="TimeIN" name="TimeIN"
                              class="form-control" placeholder="00:00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Actual OUT:</label>
                            <input type="text" id="TimeOUT" name="TimeOUT"
                              class="form-control" placeholder="00:00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Schedule OUT:</label>
                            <input type="text" id="SchedOut" name="SchedOut"
                              class="form-control" placeholder="00:00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Actual OT Hours:</label>
                            <input type="text" id="ActualOTHours" name="ActualOTHours"
                              class="form-control" placeholder="0.00" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="date">Apply OT Hours:</label>
                            <input type="text" id="FiledOTHours" name="FiledOTHours"
                              class="form-control" placeholder="0.00" required>
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
</script>
<script>
    $(document).ready(function() {
        $('#Employee').change(function() 
        {
           var empCode = $(this).val(); 
           CheckOvertime(empCode);
        });
        $('#date').change(function() 
        {
           empCode = document.getElementById("empcode").value;
           CheckOvertime(empCode);
           console.log(empCode);
        });
        const CheckOvertime = (empCode) =>{
            // var empCode = document.getElementById("empcode").value;
            document.getElementById("empcode").value = empCode;
            var DateOT = document.getElementById("date").value;
            $.ajax({
                url: '/getemployeeovertime/' + empCode + '/' + DateOT, // Replace with your server URL
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
